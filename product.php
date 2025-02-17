<?php
require_once 'includes/configuration.php';
require_once 'includes/functions.php';

// Get URL parameters
$category_slug = isset($_GET['cat']) ? $_GET['cat'] : '';
$subcategory_slug = isset($_GET['sub']) ? $_GET['sub'] : '';
$product_slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Get product details with joins for category and subcategory
$query = "SELECT p.*, c.name as category_name, c.slug as category_slug, 
          s.name as subcategory_name, s.slug as subcategory_slug,
          pc.content_html as blog_content
          FROM admin_products p
          LEFT JOIN admin_categories c ON p.category_id = c.id
          LEFT JOIN admin_subcategories s ON p.subcategory_id = s.id
          LEFT JOIN admin_product_content pc ON p.product_id = pc.product_id
          WHERE p.slug = ?";

$stmt = $connection->prepare($query);
$stmt->bind_param("s", $product_slug);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Get product images
$img_query = "SELECT * FROM admin_product_images 
              WHERE product_id = ? 
              ORDER BY is_primary DESC, display_order ASC";
$img_stmt = $connection->prepare($img_query);
$img_stmt->bind_param("i", $product['product_id']);
$img_stmt->execute();
$images = $img_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Get product characteristics
$char_query = "SELECT * FROM admin_product_characteristics 
               WHERE product_id = ?";
$char_stmt = $connection->prepare($char_query);
$char_stmt->bind_param("i", $product['product_id']);
$char_stmt->execute();
$characteristics = $char_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Set meta tags for SEO
$pageTitle = $product['seo_title'] ?: $product['name'];
$pageDescription = $product['seo_description'];
$pageKeywords = $product['seo_keywords'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords); ?>">
    <link rel="stylesheet" href="/styles/product.css">
</head>
<body>
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <nav class="breadcrumb-nav" aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <?php if ($product['category_name']): ?>
                <li><a href="/<?php echo htmlspecialchars($product['category_slug']); ?>/">
                    <?php echo htmlspecialchars($product['category_name']); ?>
                </a></li>
                <?php endif; ?>
                
                <?php if ($product['subcategory_name']): ?>
                <li><a href="/<?php echo htmlspecialchars($product['category_slug']); ?>/<?php echo htmlspecialchars($product['subcategory_slug']); ?>/">
                    <?php echo htmlspecialchars($product['subcategory_name']); ?>
                </a></li>
                <?php endif; ?>
                
                <li aria-current="page"><?php echo htmlspecialchars($product['name']); ?></li>
            </ol>
        </nav>

        <!-- Product Header -->
        <header class="product-header">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <?php if ($product['subtitle']): ?>
            <p class="subtitle"><?php echo htmlspecialchars($product['subtitle']); ?></p>
            <?php endif; ?>
        </header>

        <!-- Product Content -->
        <div class="product-content">
            <!-- Image Gallery -->
            <div class="product-gallery">
                <div class="main-image">
                    <?php if (!empty($images)): ?>
                    <img src="/product_images/<?php echo htmlspecialchars($images[0]['image_path']); ?>"
                         alt="<?php echo htmlspecialchars($images[0]['alt_text']); ?>"
                         id="main-product-image">
                    <?php endif; ?>
                </div>
                
                <?php if (count($images) > 1): ?>
                <div class="thumbnail-gallery">
                    <?php foreach ($images as $index => $image): ?>
                    <img src="/product_images/<?php echo htmlspecialchars($image['image_path']); ?>"
                         alt="<?php echo htmlspecialchars($image['alt_text']); ?>"
                         onclick="updateMainImage(this.src, this.alt)"
                         class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <?php if ($product['description']): ?>
                <div class="description">
                    <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($characteristics)): ?>
                <div class="characteristics">
                    <h2>Product Characteristics</h2>
                    <div class="characteristics-grid">
                        <?php foreach ($characteristics as $char): ?>
                        <div class="characteristic-item">
                            <span class="char-name"><?php echo htmlspecialchars($char['name']); ?></span>
                            <span class="char-value"><?php echo htmlspecialchars($char['value']); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Blog Content -->
        <?php if ($product['blog_content']): ?>
        <div class="blog-content">
            <?php echo $product['blog_content']; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    function updateMainImage(src, alt) {
        const mainImage = document.getElementById('main-product-image');
        mainImage.src = src;
        mainImage.alt = alt;
        
        // Update thumbnail active state
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
            if (thumb.src === src) {
                thumb.classList.add('active');
            }
        });
    }
    </script>
</body>
</html>