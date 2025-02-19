<?php
// Check if SEO variables are already defined; if not, use defaults.
$pageTitle = isset($pageTitle) ? $pageTitle : 'Acasă | Wartung';
$pageDescription = isset($pageDescription) ? $pageDescription : 'Descoperă produse de întreținere certificate și eco de la Wartung. Soluții eficiente pentru curățenie, lubrifiere, construcții și metalurgie.';
$pageKeywords = isset($pageKeywords) ? $pageKeywords : 'produse întreținere, curățenie eco, lubrifiere, construcții, metalurgie, Wartung';

if (!defined('ENVIRONMENT')) {
    require_once __DIR__ . '/configuration.php';
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords); ?>">
    <meta name="author" content="Wartung">
    <meta name="robots" content="index, follow">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.yourwebsite.com/<?php echo basename($_SERVER['PHP_SELF']); ?>" />
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:image" content="https://www.yourwebsite.com/resources/images/logo.png">
    <meta property="og:url" content="https://www.yourwebsite.com/<?php echo basename($_SERVER['PHP_SELF']); ?>">
    <meta property="og:type" content="website">
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="twitter:image" content="https://www.yourwebsite.com/resources/images/logo.png">

    <!-- RECAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- CSS Loading Logic -->
    <?php
    if (ENVIRONMENT === 'production') {
        // Production: load page-specific minified CSS files from /dist/styles/ and shared minified CSS files.
        $currentFile = basename($_SERVER['PHP_SELF']); // e.g., index.php, product.php, etc.
        $cssMap = [
            'index.php'     => 'home.min.css',
            'industrii.php' => 'industrii.min.css',
            'product.php'   => 'product.min.css',
            'rezultate.php' => 'rezultate.min.css',
        ];
        
        if (isset($cssMap[$currentFile])) {
            echo '<link rel="stylesheet" href="/dist/styles/' . htmlspecialchars($cssMap[$currentFile]) . '">';
        }
        
        // Always load shared CSS files (minified versions)
        echo '<link rel="stylesheet" href="/dist/styles/footer.min.css">';
        echo '<link rel="stylesheet" href="/dist/styles/navbar.min.css">';
    } else {
        // Staging/Development: load individual unminified CSS files from /styles/.
        $currentFile = basename($_SERVER['PHP_SELF']);
        $cssMap = [
            'index.php'     => 'home.css',
            'industrii.php' => 'industrii.css',
            'product.php'   => 'product.css',
            'rezultate.php' => 'rezultate.css',
        ];
        
        if (isset($cssMap[$currentFile])) {
            echo '<link rel="stylesheet" href="/styles/' . htmlspecialchars($cssMap[$currentFile]) . '">';
        }
        
        // Always load shared CSS files
        echo '<link rel="stylesheet" href="/styles/footer.css">';
        echo '<link rel="stylesheet" href="/styles/navbar.css">';
    }
    ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Reenie+Beanie&display=swap" rel="stylesheet">
    <!-- Preload Critical Resources -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="resources/images/favicon.png">
    <link rel="preload" href="/images/hero-bg-top-layer.webp" as="image">

    <style>
        #hero-section {
            background: url('/images/hero-bg.webp');
            background-size: cover;
            background-position: center;
            position: relative;
            width: 100%;
            height: 100vh;
            margin-top: 0 !important;
        }

        /* Overlay color layer */
        #hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(36, 36, 48, 0.8);
            z-index: 1;
        }

        #hero-section::after {
            content: "";
            position: absolute;
            bottom: -20%;
            left: 0;
            width: 100%;
            height: 1000px;
            background: url('/images/hero-bg-top-layer.webp') no-repeat center bottom;
            z-index: 1;
        }

        .hero-text-part {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -85%);
            z-index: 2; 
            padding: 20px;
            color: #fff;
            width: 70%;
            height: 30vh;
        }

        .hero-text-part button {
            margin-top: 50px;
        }

        .hero-text-part i {
            padding-left: 15px;
        }

        .hero-text-part span {
            color: var(--accent-text-color);
        }
    </style>

</head>
<body>