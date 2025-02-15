<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Acasă | Wartung'; ?></title>
    <meta name="description" content="<?php echo $pageDescription ?? 'Descoperă produse de întreținere certificate și eco de la Wartung. Soluții eficiente pentru curățenie, lubrifiere, construcții și metalurgie.'; ?>">
    <meta name="keywords" content="<?php echo $pageKeywords ?? 'produse întreținere, curățenie eco, lubrifiere, construcții, metalurgie, Wartung'; ?>">
    <meta name="author" content="Wartung">
    <meta name="robots" content="index, follow">
    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.yourwebsite.com/<?php echo basename($_SERVER['PHP_SELF']); ?>" />
    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo $pageTitle ?? 'Acasă | Wartung'; ?>">
    <meta property="og:description" content="<?php echo $pageDescription ?? 'Descoperă produse de întreținere certificate și eco de la Wartung. Soluții eficiente pentru curățenie, lubrifiere, construcții și metalurgie.'; ?>">
    <meta property="og:image" content="https://www.yourwebsite.com/resources/images/logo.png">
    <meta property="og:url" content="https://www.yourwebsite.com/<?php echo basename($_SERVER['PHP_SELF']); ?>">
    <meta property="og:type" content="website">
    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $pageTitle ?? 'Acasă | Wartung'; ?>">
    <meta name="twitter:description" content="<?php echo $pageDescription ?? 'Descoperă produse de întreținere certificate și eco de la Wartung. Soluții eficiente pentru curățenie, lubrifiere, construcții și metalurgie.'; ?>">
    <meta name="twitter:image" content="https://www.yourwebsite.com/resources/images/logo.png">
    <!-- Load CSS -->
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Reenie+Beanie&display=swap" rel="stylesheet">
    <!-- Preload Critical Resources -->
    <link rel="preload" href="styles/home.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" as="style">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="resources/images/favicon.png">
</head>
<body>