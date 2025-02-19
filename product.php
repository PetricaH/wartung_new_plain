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

        <div class="product-container">
        <div class="product-header">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <div class="category-info">
                <?php if (!empty($product['category_name'])): ?>
                    <span><?php echo htmlspecialchars($product['category_name']); ?></span>
                    <?php if (!empty($product['subcategory_name'])): ?>
                        <span> / <?php echo htmlspecialchars($product['subcategory_name']); ?></span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="product-grid">
            <div class="product-gallery">
                <div class="main-image-container">
                    <?php if (!empty($product['primary_image'])): ?>
                        <img id="mainImage" src="<?php echo htmlspecialchars($baseImageUrl . $product['primary_image']); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <?php else: ?>
                        <div class="placeholder-image">
                            📷
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (count($allImages) > 1): ?>
                    <div class="thumbnail-grid">
                        <?php foreach ($allImages as $img): ?>
                            <div class="thumbnail" onclick="changeMainImage('<?php echo htmlspecialchars($baseImageUrl . $img); ?>')">
                                <img src="<?php echo htmlspecialchars($baseImageUrl . $img); ?>" 
                                     alt="Thumbnail of <?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="product-info">
                <?php if (!empty($characteristics)): ?>
                    <div class="characteristics">
                        <?php foreach ($characteristics as $char): ?>
                            <span class="characteristic"><?php echo htmlspecialchars($char); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="product-description">
                    <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                </div>

                <div class="product-actions">
                    <button class="btn-fisa" onclick="showDatasheetModal('<?php echo $productId; ?>', '<?php echo htmlspecialchars($product['name']); ?>')">
                        <span class="icon">📄</span>
                        Descarcă fișa tehnică
                    </button>
                    <button class="btn-oferta" onclick="showOfferModal('<?php echo $productId; ?>', '<?php echo htmlspecialchars($product['name']); ?>')">
                        <span class="icon">💬</span>
                        Cere o ofertă
                    </button>
                </div>
            </div>
        </div>

        <?php if (!empty($product['blog_content'])): ?>
            <div class="blog-content">
                <?php echo $product['blog_content']; ?>
            </div>
        <?php endif; ?>
    </div>

<!-- Datasheet Request Modal -->
<div id="datasheetModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModals()">&times;</span>
        <h2>Solicitare Fișă Tehnică</h2>
        <p>Produs: <span class="product-name"></span></p>
        <form id="datasheetForm" onsubmit="submitDatasheetForm(event)">
            <input type="hidden" id="datasheetProductId" name="productId">
            <input type="hidden" id="datasheetProductName" name="productName">
            <input type="hidden" name="agreement_text" value="Accept să primesc newslettere și politica de confidențialitate">
            <input type="hidden" name="ip_address" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
            <input type="hidden" name="agreement_timestamp" value="<?php echo date('Y-m-d H:i:s'); ?>">
            
            <div class="form-group">
                <label for="datasheet-email">Email:</label>
                <input type="email" id="datasheet-email" name="email" required>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="acceptNewsletter" required>
                    Accept să primesc newslettere și politica de confidențialitate
                </label>
            </div>

            <div class="g-recaptcha" data-sitekey="6LdS-dsqAAAAAMgdYbeANtunCO2x1Eqd9ChD_EMh"></div>
            
            <button type="submit" class="form-submit">Trimite solicitarea</button>
        </form>
    </div>
</div>

<!-- Offer Request Modal -->
<div id="offerModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModals()">&times;</span>
        <h2>Solicitare Ofertă</h2>
        <p>Produs: <span class="product-name"></span></p>
        <form id="offerForm" onsubmit="submitOfferForm(event)">
            <input type="hidden" id="offerProductId" name="productId">
            <input type="hidden" id="offerProductName" name="productName">
            
            <div class="form-group">
                <label for="offer-company">Nume firmă:</label>
                <input type="text" id="offer-company" name="company" required>
            </div>

            <div class="form-group">
                <label for="offer-cui">CUI:</label>
                <input type="text" id="offer-cui" name="cui" required>
            </div>
            
            <div class="form-group">
                <label for="offer-name">Nume contact:</label>
                <input type="text" id="offer-name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="offer-email">Email:</label>
                <input type="email" id="offer-email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="offer-phone">Telefon:</label>
                <input type="tel" id="offer-phone" name="phone" required>
            </div>
            
            <div class="form-group">
                <label for="offer-message">Mesaj:</label>
                <textarea id="offer-message" name="message" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="acceptNewsletter" required>
                    Accept să primesc newslettere și politica de confidențialitate
                </label>
            </div>

            <input type="hidden" name="agreement_text" value="Accept să primesc newslettere și politica de confidențialitate">
            <input type="hidden" name="ip_address" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
            <input type="hidden" name="agreement_timestamp" value="<?php echo date('Y-m-d H:i:s'); ?>">

            <div class="g-recaptcha" data-sitekey="6LdS-dsqAAAAAMgdYbeANtunCO2x1Eqd9ChD_EMh"></div>
            
            <button type="submit" class="form-submit">Trimite solicitarea</button>
        </form>
    </div> 
</div>
<?php include 'includes/footer.php'; ?>