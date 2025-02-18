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
    <title><?= $pageTitle ?></title>
    <meta name="description" content="<?= $pageDescription ?>">
    <meta name="keywords" content="<?= $pageKeywords ?>">
</head>
<body>
    <div class="body-container">
        <!-- Improved Breadcrumb Navigation -->
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li aria-current="page" id="breadcrumb-category"></li>
            </ol>
        </nav>

        <main>
            <!-- Industry Selection Section -->
            <section id="industry-selection" aria-labelledby="industry-heading">
                <h2 id="industry-heading" class="section-heading">Selectează industria ta</h2>
                <div class="industry-cards">
                    <!-- Interactive Industry Cards -->
                    <button class="industry-card" data-industry="Curatenie" aria-label="Vezi produse pentru Curățenie">
                        <div class="card-content">
                            <div class="industry-icon">🧼</div>
                            <h3>CURĂȚENIE</h3>
                            <p class="industry-subtypes">Alimentară / Generală</p>
                        </div>
                    </button>

                    <button class="industry-card" data-industry="Lubrifiere" aria-label="Vezi produse pentru Lubrifiere">
                        <div class="card-content">
                            <div class="industry-icon">⚙️</div>
                            <h3>LUBRIFIERE</h3>
                            <p class="industry-subtypes">Alimentară / Generală</p>
                        </div>
                    </button>

                    <button class="industry-card" data-industry="Constructii" aria-label="Vezi produse pentru Construcții">
                        <div class="card-content">
                            <div class="industry-icon">🏗️</div>
                            <h3>CONSTRUCȚII</h3>
                            <p class="industry-subtypes">Materiale / Unelte</p>
                        </div>
                    </button>

                    <button class="industry-card" data-industry="Metalurgie" aria-label="Vezi produse pentru Metalurgie">
                        <div class="card-content">
                            <div class="industry-icon">🔩</div>
                            <h3>METALURGIE</h3>
                            <p class="industry-subtypes">Piese / Echipamente</p>
                        </div>
                    </button>
                </div>
            </section>

            <!-- Products Section with Loading State -->
            <section id="products-section" aria-labelledby="products-heading" hidden>
                <div class="section-header">
                    <h2 id="products-heading" class="section-heading">Produse disponibile</h2>
                    <div id="filter-controls" class="filter-container">
                        <!-- Dynamic filters will be added here -->
                    </div>
                </div>

                <!-- Loading State -->
                <div class="loading-state" aria-live="polite">
                    <div class="loading-spinner"></div>
                    <p>Se încarcă produsele...</p>
                </div>

                <!-- Product Grid -->
                <div id="products-container" class="products-grid" role="list"></div>

                <!-- Error State -->
                <div id="error-state" class="error-message" aria-live="assertive" hidden>
                    <p>⚠️ A apărut o eroare la încărcarea produselor. Vă rugăm încercați din nou.</p>
                    <button class="retry-button">Reîncarcă</button>
                </div>
            </section>
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const industryCards = document.querySelectorAll('.industry-card');
        const productsSection = document.getElementById('products-section');
        const productsContainer = document.getElementById('products-container');
        const loadingState = document.querySelector('.loading-state');
        const errorState = document.getElementById('error-state');
        const filterControls = document.getElementById('filter-controls');
        const breadcrumbCategory = document.getElementById('breadcrumb-category');
        const baseImageUrl = "/shared_images/product_images/";

        // Improved Product Card Template
        const productCardTemplate = (product) => `
            <article class="product-card" role="listitem">
                <div class="product-image-container">
                    ${product.primary_image ? 
                        `<img src="${baseImageUrl}${product.primary_image}" 
                             alt="${product.name}" 
                             class="product-image"
                             loading="lazy">` : 
                        '<div class="image-placeholder">Fără imagine</div>'}
                </div>
                <div class="product-info">
                    <h4 class="product-title">${product.name}</h4>
                    <p class="product-description">${product.short_description}</p>
                    <div class="product-meta">
                        <span class="product-category">${product.category_name}</span>
                        ${product.subcategory_name ? 
                            `<span class="product-subcategory">${product.subcategory_name}</span>` : ''}
                    </div>
                    <a href="product.php?id=${product.product_id}" 
                       class="btn-vezi-produs"
                       aria-label="Vezi detalii pentru ${product.name}">
                        Detalii produs
                    </a>
                </div>
            </article>
        `;

        // Improved Fetch with Error Handling
        async function fetchProducts(industry) {
            try {
                productsSection.hidden = false;
                loadingState.hidden = false;
                loadingState.style.display = 'block'; // Ensure it's visible at start
                errorState.hidden = true;
                
                const response = await fetch(`includes/api/fetch_products.php?industry=${encodeURIComponent(industry)}`);
                if (!response.ok) throw new Error('Network response was not ok');
                
                const data = await response.json();
                displayProducts(data);
            } catch (error) {
                console.error('Fetch error:', error);
                errorState.hidden = false;
            } finally {
                // Hide the loader after fetching, whether success or error
                loadingState.hidden = true;
                loadingState.style.display = 'none';
            }
        }


        // Enhanced Product Display with Filtering
        function displayProducts(products) {
            productsContainer.innerHTML = products.length ? 
                products.map(productCardTemplate).join('') : 
                '<p class="no-products">Nu există produse în această categorie.</p>';
            
            updateFilters(products);
        }

        // Dynamic Filter Generation
        function updateFilters(products) {
            const subcategories = [...new Set(products.map(p => p.subcategory_name).filter(Boolean))];
            
            filterControls.innerHTML = subcategories.length ? `
                <label for="subcategory-filter">Filtrează după subcategorie:</label>
                <select id="subcategory-filter" class="filter-dropdown">
                    <option value="">Toate</option>
                    ${subcategories.map(sc => `<option value="${sc}">${sc}</option>`).join('')}
                </select>
            ` : '';
            
            document.getElementById('subcategory-filter')?.addEventListener('change', function(e) {
                const filtered = products.filter(p => 
                    !e.target.value || p.subcategory_name === e.target.value
                );
                productsContainer.innerHTML = filtered.map(productCardTemplate).join('');
            });
        }

        // Event Listeners
        industryCards.forEach(card => {
            card.addEventListener('click', function() {
                const industry = this.dataset.industry;
                breadcrumbCategory.innerHTML = `<span aria-current="page">${industry}</span>`;
                productsSection.hidden = false;
                window.scrollTo({ top: productsSection.offsetTop - 100, behavior: 'smooth' });
                fetchProducts(industry);
            });
        });

        document.querySelector('.retry-button')?.addEventListener('click', () => {
            const currentIndustry = document.querySelector('.industry-card[aria-current]')?.dataset.industry;
            if (currentIndustry) fetchProducts(currentIndustry);
        });
    });
    </script>
<?php
include 'includes/footer.php';
?>

