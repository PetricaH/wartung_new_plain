<div class="footer">
  <div class="footer-container">
    <!-- Link-uri Utile Box -->
    <div class="link-uri-utile-box">
      <ul>
        <li class="box-title">Link-uri Utile</li>
        <li>
          <ul>
            <li><a href="/index.php">Acasă</a></li>
            <li><a href="{{ route('industrii') }}">Industrii</a></li>
            <li>
              <a href="https://drive.google.com/file/d/1MIgspYcDoRG6Vr8GeBEtT7zO0SzA2L-C/view" target="_blank">
                Catalog
              </a>
            </li>
            <li><a href="{{ route('careers') }}">Cariere</a></li>
            <li><a href="{{ route('product-results') }}">Rezultate</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Socials Box -->
    <div class="socials-box">
      <ul>
        <li class="box-title">Urmărește-ne</li>
        <li>
          <ul>
            <li>
              <a href="https://www.instagram.com/wartungtratamentespeciale/?hl=en" target="_blank">
                Instagram
              </a>
            </li>
            <li>
              <a href="https://www.facebook.com/wartung.ro" target="_blank">
                Facebook
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/company/wartung-tratamente-speciale/?viewAsMember=true" target="_blank">
                LinkedIn
              </a>
            </li>
            <li>
              <a href="https://www.tiktok.com/@wartungchem" target="_blank">
                TikTok
              </a>
            </li>
            <li>
              <a href="https://www.youtube.com/@WartungTratamenteSpecialee/videos" target="_blank">
                YouTube
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Legal & Contact Box -->
    <div class="legal-contact-box">
      <ul>
        <li class="box-title">Legal</li>
        <li>
          <ul>
            <li>
              <a href="{{ route('privacy-policy') }}">Politica de Confidențialitate</a>
            </li>
            <li>
              <a href="{{ route('cookies-policy') }}">Politica Cookies</a>
            </li>
            <li>
              <a href="{{ route('cookies-policy') }}">Actualizează Politica Cookies</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul>
        <li class="box-title">Contact</li>
        <li>
          <ul>
            <li>FIX: 0377703160</li>
            <li>MOBIL: 0774 663 896</li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Subscribe to Newsletter Box -->
    <div class="subscribe-to-newsletter-box">
      <h3>Abonează-te la Newsletter</h3>
      <p>Vrei să fii la zi cu ultimele noutăți din lumea întreținerii?</p>
      <form class="subscribe-form">
        <input type="email" placeholder="Emailul tău" required>
        <button type="submit">Abonează-te</button>
      </form>
    </div>

    <!-- Credits Box -->
    <div class="credits-box">
      <p>© 2025 Wartung Tratamente Speciale SRL. Toate drepturile rezervate.</p>
    </div>
  </div>

  <!-- Certificates Section -->
  <div class="certificates">
    <a href="https://anpc.ro/ce-este-sal/" target="_blank" rel="nofollow">
      <img style="width:250px;margin:5px;" src="images/anpc-sal.webp" loading="lazy" alt="Solutionarea Alternativa a Litigiilor">
    </a><br/>
    <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="nofollow">
      <img style="width:250px;margin:5px;" src="images/anpc-sol.webp" loading="lazy" alt="Solutionarea Online a Litigiilor">
    </a>
  </div>
</div>

<?php
if (ENVIRONMENT === 'production') {
    // Production: load page-specific minified JS files from /dist/scripts/ and shared minified JS files.
    $currentFile = basename($_SERVER['PHP_SELF']); // e.g., index.php, product.php, etc.
    $jsMap = [
        'index.php'     => 'home.min.js',
        'industrii.php' => 'industrii.min.js',
        'product.php'   => 'product.min.js',
        'rezultate.php' => 'rezultate.min.js',
    ];
    
    if (isset($jsMap[$currentFile])) {
        echo '<script src="/dist/scripts/' . htmlspecialchars($jsMap[$currentFile]) . '"></script>';
    }
    
    // Always load shared JS files (minified versions)
    echo '<script src="/dist/scripts/navbar.min.js"></script>';
} else {
    // Staging/Development: load individual unminified JS files from /scripts/.
    $currentFile = basename($_SERVER['PHP_SELF']);
    $jsMap = [
        'index.php'     => 'home.js',
        'industrii.php' => 'industrii.js',
        'product.php'   => 'product.js',
        'rezultate.php' => 'rezultate.js',
    ];
    
    if (isset($jsMap[$currentFile])) {
        echo '<script src="/scripts/' . htmlspecialchars($jsMap[$currentFile]) . '"></script>';
    }
    
    // Always load shared JS files (unminified versions)
    echo '<script src="/scripts/navbar.js"></script>';
}
?>
</html>
</body>