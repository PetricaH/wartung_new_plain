<!-- Navbar -->
<style>
    .navbar {
    background-color: var(--inside-cards-bg-color);
    height: 65px;
    padding: 10px 15px;
    display: flex;
    left: 50%;
    top: 30px;
    transform: translateX(-50%);
    align-items: center;
    justify-content: space-between;
    position: fixed;
    width: 90%;
    border-radius: 15px;
    z-index: 999;
}
#logo_image {
    width: 30px;
    position: relative;
    z-index: 999;
}
</style>
<div class="navbar">
    <div class="logo_div">
        <a href="index.php"><img src="/images/wartung-yellow-logo.svg" id="logo_image" alt="Logo"></a>
    </div>

    <button class="menu_toggle" id="menu_toggle" aria-label="Deschidere Meniu">
        <div class="bar bar1"></div>
        <div class="bar bar2"></div>
        <div class="bar bar3"></div>
    </button>

    <ul id="nav_menu">
        <li><a href="index.php">Acasă</a></li>
        <li><a href="industrii.php">Industrii</a></li>
        <li><a href="https://drive.google.com/file/d/1MIgspYcDoRG6Vr8GeBEtT7zO0SzA2L-C/view?usp=sharing">Catalog</a></li>
        <li><a href="cariere.php">Cariere</a></li>
        <li><a href="/pages/rezultate.php">Rezultate</a></li>
    </ul>
</div>