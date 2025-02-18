<?php
require_once 'includes/configuration.php';
require_once 'includes/functions.php';

/*
 * Table: admin_products
 *
 * Columns:
 * - product_id (int, auto_increment, primary key): Unique identifier for the product.
 * - name (varchar(255)): The name or title of the product.
 * - subtitle (varchar(255)): An optional subtitle for the product.
 * - description (text): A short description or detailed information about the product.
 * - seo_title (varchar(255)): The title used for SEO purposes.
 * - seo_description (text): The meta description used for SEO.
 * - seo_keywords (varchar(255)): SEO keywords, typically separated by commas.
 * - created_at (timestamp): The date and time when the product was created (defaults to CURRENT_TIMESTAMP).
 * - updated_at (timestamp): The date and time when the product was last updated (auto-updated on modification).
 * - category_id (int): Foreign key linking to admin_categories(id), indicating the product's category.
 * - subcategory_id (int): Foreign key linking to admin_subcategories(subcategory_id), indicating the product's subcategory.
 * - slug (varchar(255)): A URL-friendly version of the product name.
 */

// Check if the product ID is provided via the URL; if not, exit with an error message
if (!isset($_GET['id'])) {
    die("Product id is missing.");
}

// Sanitize and store the product ID from the URL parameter
$productId = intval($_GET['id']);

// Updated query to fetch all the necessary product information
$query = "
    SELECT 
        p.*, 
        c.name AS category_name, 
        s.name AS subcategory_name, 
        MAX(CASE WHEN i.is_primary = 1 THEN i.image_path END) AS primary_image,
        GROUP_CONCAT(DISTINCT i.image_path ORDER BY i.is_primary DESC, i.display_order ASC SEPARATOR ',') AS all_images,
        GROUP_CONCAT(DISTINCT apc.name SEPARATOR '||') AS characteristics,
        MAX(pc.content_html) AS blog_content
    FROM admin_products p
    LEFT JOIN admin_categories c ON c.id = p.category_id
    LEFT JOIN admin_subcategories s ON s.subcategory_id = p.subcategory_id
    LEFT JOIN admin_product_images i ON i.product_id = p.product_id
    LEFT JOIN admin_product_characteristics apc ON apc.product_id = p.product_id
    LEFT JOIN admin_product_content pc ON pc.product_id = p.product_id
    WHERE p.product_id = ?
    GROUP BY p.product_id
";

// Prepare and execute the SQL statement
$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $connection->error);
}
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the product data as an associative array; if not found, exit with an error message
$product = $result->fetch_assoc();
if (!$product) {
    die("Product not found.");
}
$stmt->close();

// Base URL for product images (adjust as needed)
$baseImageUrl = "/shared_images/product_images/";

// Convert aggregated fields (all_images and characteristics) into arrays
$allImages = !empty($product['all_images']) ? explode(",", $product['all_images']) : [];
$characteristics = !empty($product['characteristics']) ? explode("||", $product['characteristics']) : [];

// Set SEO values based on product data with fallbacks
$seoTitle = !empty($product['seo_title']) ? $product['seo_title'] : $product['name'];
$seoDescription = !empty($product['seo_description']) 
    ? $product['seo_description'] 
    : substr(strip_tags($product['description']), 0, 160);
$seoKeywords = !empty($product['seo_keywords']) ? $product['seo_keywords'] : '';

// Set the SEO variables to be used in header.php
$pageTitle = $seoTitle;
$pageDescription = $seoDescription;
$pageKeywords = $seoKeywords;
if (ENVIRONMENT === 'staging') {
    $pageCSS = '/styles/product.css'; // Path to your product-specific CSS file
}
include 'includes/header.php';
include 'includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <!-- Note: The SEO meta tags here will be overridden by header.php -->
    <!-- Link to additional CSS for product-specific styling if needed -->
    <link rel="stylesheet" href="/path/to/your/style.css">
</head>
<body>
    <div class="body-container">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb">
            <a href="index.php">Home</a> <span>/</span>
            <a href="industrii.php?industry=<?php echo urlencode($product['category_name']); ?>">
                <?php echo htmlspecialchars($product['category_name'] ?? 'N/A'); ?>
            </a> <span>/</span>
            <span><?php echo htmlspecialchars($product['name']); ?></span>
        </div>

        <div class="product-card">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <p><strong>Categorie:</strong> <?php echo htmlspecialchars($product['category_name'] ?? 'N/A'); ?></p>
            <p><strong>Subcategorie:</strong> <?php echo htmlspecialchars($product['subcategory_name'] ?? 'N/A'); ?></p>

            <!-- Desktop Product Image -->
            <?php if (!empty($product['primary_image'])): ?>
                <img src="<?php echo htmlspecialchars($baseImageUrl . $product['primary_image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <?php else: ?>
                <p>No image available.</p>
            <?php endif; ?>

            <!-- Mobile Gallery -->
            <div class="mobile-gallery">
                <div class="big-image">
                    <?php 
                    // Default image: primary image if available, or the first image from all_images
                    $defaultImage = !empty($product['primary_image'])
                        ? $baseImageUrl . $product['primary_image']
                        : (isset($allImages[0]) ? $baseImageUrl . $allImages[0] : '');
                    ?>
                    <?php if ($defaultImage): ?>
                        <img src="<?php echo htmlspecialchars($defaultImage); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" id="main-mobile-image">
                    <?php else: ?>
                        <p>No image available.</p>
                    <?php endif; ?>
                </div>
                <?php if (count($allImages) > 1): ?>
                    <div class="thumbnail-container">
                        <?php foreach ($allImages as $img): ?>
                            <div class="thumbnail" onclick="document.getElementById('main-mobile-image').src='<?php echo htmlspecialchars($baseImageUrl . $img); ?>'">
                                <img src="<?php echo htmlspecialchars($baseImageUrl . $img); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Product Characteristics -->
            <?php if (!empty($characteristics)): ?>
                <div class="product-characteristics">
                    <?php foreach ($characteristics as $char): ?>
                        <div class="characteristic"><?php echo htmlspecialchars($char); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Short Product Description -->
            <div class="short-description">
                <?php echo nl2br(htmlspecialchars($product['description'])); ?>
            </div>

            <!-- Blog Content -->
            <?php if (!empty($product['blog_content'])): ?>
                <div class="blog-content">
                    <?php 
                        // Display blog content with HTML formatting
                        echo $product['blog_content']; 
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>