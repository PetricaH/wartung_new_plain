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

             <!-- Products Section -->
        <section id="products-section" aria-labelledby="products-heading" hidden>
            <div class="section-header">
                <h2 id="products-heading" class="section-heading">Produse disponibile</h2>
                <div id="filter-controls" class="filter-container"></div>
            </div>

            <div class="loading-state" aria-live="polite">
                <div class="loading-spinner"></div>
                <p>Se încarcă produsele...</p>
            </div>

            <div id="products-container" class="products-grid" role="list"></div>

            <div id="error-state" class="error-message" aria-live="assertive" hidden>
                <p>⚠️ A apărut o eroare la încărcarea produselor. Vă rugăm încercați din nou.</p>
                <button class="retry-button">Reîncarcă</button>
            </div>
        </section>

        <!-- Contact Modal -->
        <div id="contact-modal" class="modal" aria-modal="true" role="dialog">
            <div class="modal-content">
                <button class="modal-close" aria-label="Închide formularul">&times;</button>
                <h3>Solicită ofertă</h3>
                <form id="contact-form" action="includes/send_inquiry.php" method="POST">
                    <input type="hidden" id="modal-product-name" name="product_name">
                    <div class="form-group">
                        <label for="company-name">Nume companie</label>
                        <input type="text" id="company-name" name="company_name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-name">Persoană de contact</label>
                        <input type="text" id="contact-name" name="contact_name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-email">Email</label>
                        <input type="email" id="contact-email" name="contact_email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-phone">Telefon</label>
                        <input type="tel" id="contact-phone" name="contact_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Mesaj (opțional)</label>
                        <textarea id="message" name="message" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Trimite cererea</button>
                </form>
            </div>
        </div>
    </div>
            </section>
        </main>
    </div>
<?php
include 'includes/footer.php';
?>