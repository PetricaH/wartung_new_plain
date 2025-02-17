<?php
// Define page-specific SEO variables
$pageTitle = "Industrii | Wartung";
$pageDescription = "Descoperă produse de întreținere certificate și eco de la Wartung. Soluții eficiente pentru curățenie, lubrifiere, construcții și metalurgie.";
$pageKeywords = "produse întreținere, curățenie eco, lubrifiere, construcții, metalurgie, Wartung";

include 'includes/header.php';
include 'includes/navbar.php';
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Industrie - Wartung.ro</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Basic styles for demo purposes */
        .industry-cards { display: flex; gap: 20px; margin: 20px 0; }
        .industry-card { border: 1px solid #ccc; padding: 20px; text-align: center; cursor: pointer; }
        .industry-card h3 { margin: 0 0 10px; }
        .product-card { border: 1px solid #aaa; padding: 15px; margin: 10px 0; }
        .breadcrumb { margin: 20px 0; font-size: 0.9em; }
        .breadcrumb a { text-decoration: none; color: #007BFF; }
    </style>
</head>
<body>
    <header>
      <!-- Your header content -->
      <h1>Industrie</h1>
    </header>
    <main>
        <!-- Industry Selection Section -->
        <section id="industry-selection">
            <div class="industry-cards">
                <!-- Example cards – adjust images and hover effects as needed -->
                <div class="industry-card" data-industry="Curatenie">
                    <h3>CURĂȚENIE</h3>
                    <button class="industry-select-btn">Alimentară / Generală</button>
                </div>
                <div class="industry-card" data-industry="Lubrifiere">
                    <h3>LUBRIFIERE</h3>
                    <button class="industry-select-btn">Alimentară / Generală</button>
                </div>
                <div class="industry-card" data-industry="Constructii">
                    <h3>CONSTRUCȚII</h3>
                    <button class="industry-select-btn">Detalii</button>
                </div>
                <div class="industry-card" data-industry="Metalurgie">
                    <h3>METALURGIE</h3>
                    <button class="industry-select-btn">Detalii</button>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products-section">
            <!-- Breadcrumb Navigation -->
            <div class="breadcrumb">
                <a href="index.php">Home</a> <span>/</span>
                <span id="breadcrumb-category"></span>
                <span id="breadcrumb-subcategory"></span>
            </div>
            <!-- Container for dynamically loaded product cards -->
            <div id="products-container">
                <!-- Products will be inserted here via JavaScript -->
            </div>
        </section>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const industryButtons = document.querySelectorAll('.industry-select-btn');
        const productsContainer = document.getElementById('products-container');
        const breadcrumbCategory = document.getElementById('breadcrumb-category');
        const breadcrumbSubcategory = document.getElementById('breadcrumb-subcategory');

        industryButtons.forEach(button => {
            button.addEventListener('click', function(){
                // Get the selected industry from the parent card’s data attribute
                const industry = this.parentElement.getAttribute('data-industry');
                // Update breadcrumb (for demo, we just set the category; subcategory can be set later based on product detail)
                breadcrumbCategory.textContent = industry;
                breadcrumbSubcategory.textContent = '';
                // Fetch products filtered by industry via AJAX
                fetch('api/fetch_products.php?industry=' + encodeURIComponent(industry))
                    .then(response => response.json())
                    .then(data => {
                        productsContainer.innerHTML = '';
                        if(data && data.length > 0) {
                            data.forEach(product => {
                                // Create a product card element
                                const card = document.createElement('div');
                                card.classList.add('product-card');
                                card.innerHTML = `
                                    <h4>${product.name}</h4>
                                    <p>${product.short_description}</p>
                                    <p><strong>Categorie:</strong> ${product.category_name || 'N/A'}</p>
                                    ${product.subcategory_name ? `<p><strong>Subcategorie:</strong> ${product.subcategory_name}</p>` : ''}
                                    <a href="product.php?id=${product.product_id}" class="btn-vezi-produs">Vezi produs</a>
                                `;
                                productsContainer.appendChild(card);
                            });
                        } else {
                            productsContainer.innerHTML = '<p>Nu există produse pentru această industrie.</p>';
                        }
                    })
                    .catch(error => console.error('Error fetching products:', error));
            });
        });
    });
    </script>
</body>
</html>
