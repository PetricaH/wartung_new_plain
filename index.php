<?php
// Define page-specific SEO variables
$pageTitle = "Acasă | Wartung";
$pageDescription = "Descoperă produse de întreținere certificate și eco de la Wartung. Soluții eficiente pentru curățenie, lubrifiere, construcții și metalurgie.";
$pageKeywords = "produse întreținere, curățenie eco, lubrifiere, construcții, metalurgie, Wartung";

include 'includes/header.php';
include 'includes/navbar.php';
?>
<style>
  /* ----------------------------- */
/*   WHAT ABOUT RESULTS CARDS    */
/* ----------------------------- */

/* General Styles (mobile-first) */
.what-about-results-cards-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding: 20px;
    align-items: stretch; /* Stretch cards to full width */
    justify-content: center;
    width: 100%; /* Ensure container takes full width */
}
  
  .what-about-results-card {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--inside-cards-bg-color);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  @media (max-width: 768px) {

    .what-about-results-card-title {
        position: relative;
        z-index: 2;
        font-size: 2.5rem;
        color: var(--accent-text-color);
        text-transform: uppercase;
        font-weight: bold;
        text-align: center;
        transition: transform 0.3s ease;
        top: -15%;
      }

        /* Hover Buttons */
    .what-about-results-hover-buttons {
        position: absolute;
        top: 70% !important;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: space-around !important;
        transform: translateY(-50%);
        opacity: 1; 
        z-index: 2;
    }
    
    .what-about-results-hover-button {
        padding: 8px 15px;
        background-color: var(--accent-text-color);
        color: var(--main-btn-txt-color);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        z-index: 2;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
    
    .what-about-results-hover-button-bottom {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        opacity: 1;
    }
  }

  /* Desktop hover effects */
  @media (min-width: 768px) {
    .what-about-results-cards-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin: 0 auto;
    }
  
    .what-about-results-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }
  }
  
  /* Dual Image Background for CURATENIE Cards */
  .what-about-results-dual-images {
    position: absolute;
    inset: 0;
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
  
  .what-about-results-curatenie-image-left,
  .what-about-results-curatenie-image-right,
  .what-about-results-lubrifiere-image-left,
  .what-about-results-lubrifiere-image-right {
    background-size: cover;
    background-position: center;
    width: 100%;
    height: 100%;
    position: relative;
  }

  /* Add color filter overlay to images */
.what-about-results-curatenie-image-left::before,
.what-about-results-curatenie-image-right::before,
.what-about-results-lubrifiere-image-left::before,
.what-about-results-lubrifiere-image-right::before,
.what-about-results-single-constructii-image::before,
.what-about-results-single-metalurgie-image::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: rgba(36, 36, 48, 0.5); /* Subtle color filter */
    z-index: 1;
}
  
  .what-about-results-curatenie-image-left {
    background-image: url('/images/product-cards-imgs/left-curatenie.webp');
  }
  
  .what-about-results-curatenie-image-right {
    background-image: url('/images/product-cards-imgs/right-curatenie.webp');
  }

  .what-about-results-lubrifiere-image-left {
    background-image: url('/images/product-cards-imgs/left-lubrifiere.webp');
  }
  
  .what-about-results-lubrifiere-image-right {
    background-image: url('/images/product-cards-imgs/right-lubrifiere.webp');
  }
  
  
  /* Single Image Background for SERVICII Cards */
  .what-about-results-single-constructii-image,
  .what-about-results-single-metalurgie-image {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
  }
  
  .what-about-results-card-serv .what-about-results-single-constructii-image {
    background-image: url('/images/product-cards-imgs/constructii.webp');
  }

  .what-about-results-card-serv .what-about-results-single-metalurgie-image {
    background-image: url('/images/product-cards-imgs/metalurgie.webp');
  }
  
  /* Card Title */
  .what-about-results-card-title {
    position: relative;
    z-index: 2;
    font-size: 2.5rem;
    color: var(--accent-text-color);
    text-transform: uppercase;
    font-weight: bold;
    text-align: center;
    transition: transform 0.3s ease;
  }
  
  /* Hover Buttons */
  .what-about-results-hover-buttons {
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    opacity: 1; 
    z-index: 2;
  }
  
  .what-about-results-hover-button {
    padding: 8px 15px;
    background-color: var(--accent-text-color);
    color: var(--main-btn-txt-color);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    z-index: 2;
    transition: transform 0.3s ease, opacity 0.3s ease;
  }
  
  .what-about-results-hover-button-bottom {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    opacity: 1;
  }
  
  /* Desktop Hover Effects for Buttons */
  @media (min-width: 768px) {
    .what-about-results-hover-buttons {
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    .what-about-results-card:hover .what-about-results-hover-buttons {
      opacity: 1;
    }
    .what-about-results-card:hover .what-about-results-card-title {
      transform: translateY(-50px);
    }
    .what-about-results-card:hover .what-about-results-hover-button-left {
      transform: translateX(20px);
    }
    .what-about-results-card:hover .what-about-results-hover-button-right {
      transform: translateX(-20px);
    }
  }
</style>
    <section id="hero-section">
        <div class="hero-text-part">
            <h1>Produse de Întreținere Certificate și Eco</h1>
            <p>
                <span>Rezolvă problemele</span> tale de 
                <span>curățare</span> și 
                <span>întreținere</span> 
                <span>azi</span> fără să creezi altele mâine.
            </p>
            <button class="do-something-btn" href="#certificates">
                Vezi Mai Multe
                <i class="fa-solid fa-arrow-down"></i>
            </button>
        </div>
    </section>

    <div class="body-inside">
        <div class="dynamic-stats-container">
            <div class="wartung-team">
                <h2>Echipa Wartung</h2>
                <div class="number-container">
                    <svg class="line-graph" viewBox="0 0 100 20" preserveAspectRatio="none">
                        <path class="graph-line" d="M0 20 Q25 5, 50 15 T100 20" />
                    </svg>
                    <p><i class="fa-solid fa-people-group"></i><span id="employee-count">0</span></p>
                </div>
            </div>

            <div class="preffered-product">
                <h2>Produsul Preferat de Clienți</h2>
                <p>Crema cu MicroSfere</p>
                <span>WA 303</span>
                <!-- Updated to use plain PHP for asset paths -->
                <img 
                  src="/images/303.webp" 
                  alt="Imagine Produs Preferat - MANS 303"
                >
            </div>

            <div class="average-daily-sales">
                <h2>Valoare medie comenzi/zi</h2>
                <div class="number-container">
                    <svg class="line-graph" viewBox="0 0 100 20" preserveAspectRatio="none">
                        <path class="graph-line" d="M0 20 Q25 5, 50 15 T100 20" />
                    </svg>
                    <p><i class="fa-solid fa-coins"></i><span id="average-daily-sales">38,486</span>Lei</p>
                </div>
            </div>

            <div class="sales-last-year">
                <h2>Vânzări Totale 2024</h2>
                <div class="number-container">
                    <svg class="line-graph" viewBox="0 0 100 20" preserveAspectRatio="none">
                        <path class="graph-line" d="M0 20 Q25 5, 50 15 T100 20" />
                    </svg>
                    <p><i class="fa-solid fa-coins"></i><span id="sales-amount">0</span>Lei</p>
                </div>
            </div>
        </div>

        <section id="research-case-study">
            <p>Research Colorado University despre poluarea prin produsele de curățenie</p>
            <div class="case-study-card">
                <button class="do-something-btn" onclick="window.location.href='https://cires.colorado.edu/news/consumer-industrial-products-now-dominant-urban-air-pollution-source';">
                    Citește Tot
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </section>
    </div>

    <section id="certificates">
        <p>
            <span>Menține curată</span> afacerea 
            <span>eliminând probleme</span> de <span>sănătate, mediu, și siguranță alimentară</span> 
            cu produse <span>certificate</span>
        </p>
        <div class="certificates-carousel">
            <!-- All images use plain PHP for asset paths -->
            <img 
              src="images/certificates-imgs/certificate-one.webp" loading="lazy" width="150" height="100"
              alt="Certificat Acreditare NSF"
            >
            <img 
              src="images/certificates-imgs/certificate-two.webp" loading="lazy" width="150" height="100"
              alt="Certificat Acreditare ISO 9001"
            >
            <img 
              src="images/certificates-imgs/certificate-three.webp" loading="lazy" width="150" height="100"
              alt="Certificat Acreditare CE"
            >
            <img 
              src="images/certificates-imgs/certificate-four.webp" loading="lazy" width="150" height="100"
              alt="Certificat Acreditare ISO 14001"
            >
        </div>
    </section>

    <div class="body-inside">
        <!-- Video Testimonial XIMENA -->
        <div class="video-testimonial">
            <span class="business-name">XIMENA FOOD</span>
            <div class="video-container ximena">
                <button 
                  onclick="window.location.href='https://youtu.be/I0aUt9monsY';" 
                  class="do-something-btn" aria-label="Vezi Videoclip XIMENA FOOD"
                >
                  <i class="fa-solid fa-play"></i>
                </button>
            </div>
            <p>
            „Am testat produsul și sunt foarte mulțumit de rezultat. 
            Curățarea s-a făcut eficient, iar tot procesul a decurs rapid și fără probleme. 
            Mulțumesc pentru produsul oferit, cu siguranță îl 
            vom folosi în continuare!”
            </p>
            <span class="testi-bar"></span>
            <span class="testi-name">Mihai</span>
        </div>

        <div class="companies-we-worked-with-container">
            <p>Am livrat rezultate la</p>
            <div class="companies-carousel">
              <button class="carousel-control prev do-something-btn" aria-label="Vezi Certificate Stânga">
                <i class="fa-solid fa-caret-left"></i>
              </button>
              
              <div class="carousel-track-container">
                <div class="carousel-track">
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/complex-muzeal-bistrita-nasaud.webp" loading="lazy" width="150" height="100"
                      alt="Certificate One"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/elcen.webp" loading="lazy" width="150" height="100"
                      alt="Certificate Two"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/mapn.webp" loading="lazy" width="150" height="100"
                      alt="Certificate Three"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/municipiul-lupeni.webp" loading="lazy" width="150" height="100"
                      alt="Certificate Four"
                    >
                  </div>
                  <div class="carousel-track">
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/nustiu.webp" loading="lazy" width="150" height="100"
                      alt="Certificate One"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/primaria-bolintin.webp" loading="lazy" width="150" height="100"
                      alt="Certificate Two"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/primaria-comarnic.webp" loading="lazy" width="150" height="100"
                      alt="Certificate Three"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/primaria-negresti-oas.webp" loading="lazy" width="150" height="100"
                      alt="Certificate Four"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/ratbv.webp" loading="lazy" width="150" height="100"
                      alt="Certificate Three"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/companii_cu_care_am_lucrat/salubritate-craiova.webp" loading="lazy" width="150" height="100"
                      alt="Certificate Four"
                    >
                  </div>
                </div>
              </div>
            </div>
              
              <button class="carousel-control next do-something-btn" aria-label="Vezi Certificate Dreapta">
                <i class="fa-solid fa-caret-right"></i>
              </button>
              
            </div>
        </div>

        
        <!-- Video Testimonial IMOCON -->
        <div class="video-testimonial">
          <span class="business-name">IMOCON</span>
          <div class="video-container imocon">
            <button 
            onclick="window.location.href='https://youtu.be/uCB06_QxqWA?si=HhGhDDuDzw1UDAw8';"
            class="do-something-btn" aria-label="Vezi Videoclip IMOCON"
            >
            <i class="fa-solid fa-play"></i>
          </button>  
        </div>
        <p>
        „Am testat produsul și rezultatele au fost excelente. 
        Curățarea s-a făcut rapid și fără probleme, iar efectul a fost vizibil imediat. 
        Suntem foarte mulțumiți și cu siguranță vom folosi această soluție și pe viitor!”
        </p>
        <span class="testi-bar"></span>
        <span class="testi-name">Lazlo</span>
      </div>
      
      <section id="what-about-prices-section">
        <div class="what-about-prices-container">
          <div class="text-part">
            <span>Nu îți vom insulta inteligența</span> spunându-ți că avem <span>“cea mai bună calitate 
              la cel mai bun preț”</span> și <span>“cea mai variată gamă de produse”</span>, și <span>nu</span> îți vom oferi <span>o reducere 
                de 15%</span> la prima ta comandă (pentru ceva ce probabil nu te interesează).
              </div>
              <div class="graphic-part">
                <span>DAR ÎȚI OFERIM</span>
                <span>Mostră Gratuită</span>
                <i class="fa-solid fa-vial"></i>
                <div class="disclaimers">
                  <p>*daca îndeplinești criteriile noastre;</p>
                  <p>*garanția de rambursare completă fără întrebări dacă nu ești mulțumit 100%;</p>
                </div>
              </div>
            </div>
          </section>
          
          <section id="what-about-results-section">
            <div class="what-about-results-cards-container">
              <!-- Card 1: CURATENIE -->
              <div class="what-about-results-card what-about-results-card-curat">
                <div class="what-about-results-dual-images">
                  <div class="what-about-results-curatenie-image-left"></div>
                  <div class="what-about-results-curatenie-image-right"></div>
                </div>
                <span class="what-about-results-card-title">CURĂȚENIE</span>
                <div class="what-about-results-hover-buttons">
                  <button class="what-about-results-hover-button what-about-results-hover-button-left" aria-label="Detalii Despre Industria Curățenie Alimentară">
                    ALIMENTARĂ
                  </button>
                  <button class="what-about-results-hover-button what-about-results-hover-button-right" aria-label="Detalii Despre Industria Curățenie Generală">
                    GENERALĂ
                  </button>
                </div>
              </div>
              
              <!-- Card 2: LUBRIFIERE -->
              <div class="what-about-results-card what-about-results-card-curat">
                <div class="what-about-results-dual-images">
                  <div class="what-about-results-lubrifiere-image-left"></div>
                  <div class="what-about-results-lubrifiere-image-right"></div>
                </div>
                <span class="what-about-results-card-title">LUBRIFIERE</span>
                <div class="what-about-results-hover-buttons">
                  <button class="what-about-results-hover-button what-about-results-hover-button-left" aria-label="Detalii Despre Industria Lubrifiere Alimentară">
                    ALIMENTARĂ
                  </button>
                  <button class="what-about-results-hover-button what-about-results-hover-button-right" aria-label="Detalii Despre Industria Lubrifiere Generală">
                    GENERALĂ
                  </button>
                </div>
              </div>
              
              <!-- Card 3: CONSTRUCȚII -->
              <div class="what-about-results-card what-about-results-card-serv">
                <div class="what-about-results-single-constructii-image"></div>
                <span class="what-about-results-card-title">CONSTRUCȚII</span>
                <div class="what-about-results-hover-buttons">
                  <button class="what-about-results-hover-button what-about-results-hover-button-bottom" aria-label="Detalii Despre Industria Construcții">
                    DETALII
                  </button>
                </div>
              </div>
              
              <!-- Card 4: METALURGIE -->
              <div class="what-about-results-card what-about-results-card-serv">
                <div class="what-about-results-single-metalurgie-image"></div>
                <span class="what-about-results-card-title">METALURGIE</span>
                <div class="what-about-results-hover-buttons">
                  <button class="what-about-results-hover-button what-about-results-hover-button-bottom" aria-label="Detalii Despre Industria Metalurgie">
                    DETALII
                  </button>
                </div>
              </div>
            </div>
          </section>
          
          <section id="steps-to-success-section" class="steps-to-success-section">
            <h2>Dar Cum Îți Putem Garanta Rezultate?</h2>
            <h3>PRIN 3 PAȘI SIMPLI</h3>
            <div class="steps-buttons-container">
              <button class="step-button active" data-step="1" aria-label="Pasul 1 în garantarea rezultatelor">Pasul 1</button>
              <button class="step-button" data-step="2" aria-label="Pasul 2 în garantarea rezultatelor">Pasul 2</button>
              <button class="step-button" data-step="3" aria-label="Pasul 3 în garantarea rezultatelor">Pasul 3</button>
            </div>
            
            <!-- Connector element for the blob effect -->
            <div class="steps-connector"></div>
            
            <div class="steps-content-container">
              <div class="step-content active" data-step="1">
                <i class="fa-solid fa-question"></i>
                <p>
                  Ne informăm de problema care trebuie rezolvată și dacă trebuie să facturăm un produs, facem asta doar dacă considerăm că firma va implementa corect soluțiile noaste și vor obține rezultate excelente.                </p>
                </div>
                <div class="step-content" data-step="2">
                  <i class="fa-solid fa-lightbulb"></i>
                  <p>
                    In mod normal cu pasul 1 deja vom sti ce produsul poate rezolva probme dar daca este necesar unul dintre inginerii noștri de presales, specializat in domeniul va studia nevoia deplasându-se la locația ta, dacă este necesar.                </p>
                  </div>
                  <div class="step-content" data-step="3">
                    <i class="fa-solid fa-circle-check"></i>
                    <p>
                      Recomandă soluția sau setul de soluții specifice pentru cazul concret se trimit și se fac testele. Nu trebuie să plătești nimic până când nu ești de acord cu soluția.                 </p>
                    </div>
                  </div>
                </section>
                
                <!-- Contact Industries Section -->
                <section class="contact-industries-section">
                  <h2>Vrei să afli mai mult?</h2>
                  <div class="industry-row">
                    <i class="fas fa-utensils"></i>
                    <span>Industria Alimentară</span>
                    <div class="industry-button-connector"></div>
                    <button class="contact-industry-btn" data-industry="alimentara" aria-label="Vorbește cu un consultant pentru Industria Alimentară">
                      Vorbeste cu un consultant specializat
                    </button>
                  </div>
                  
                  <div class="industry-row">
                    <i class="fa-solid fa-bed"></i>
                    <span>Industria HORECA</span>
                    <div class="industry-button-connector"></div>
                    <button class="contact-industry-btn" data-industry="horeca" aria-label="Vorbește cu un consultant pentru Industria HORECA">
                      Vorbeste cu un consultant specializat
                    </button>
                  </div>
                  
                  <div class="industry-row">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span>Industria Construcții</span>
                    <div class="industry-button-connector"></div>
                    <button class="contact-industry-btn" data-industry="construcții" aria-label="Vorbește cu un consultant pentru Industria Construcții">
                      Vorbeste cu un consultant specializat
                    </button>
                  </div>
                  
                  <div class="industry-row">
                    <i class="fa-solid fa-screwdriver"></i>
                    <span>Industria Metalurgică</span>
                    <div class="industry-button-connector"></div>
                    <button class="contact-industry-btn" data-industry="metalurgica" aria-label="Vorbește cu un consultant pentru Industria Metalurgie">
                      Vorbeste cu un consultant specializat
                    </button>
                  </div>
                  
                  <div class="industry-row">
                    <i class="fa-solid fa-car-side"></i>
                    <span>Industria Automotive</span>
                    <div class="industry-button-connector"></div>
                    <button class="contact-industry-btn" data-industry="automotive" aria-label="Vorbește cu un consultant pentru Industria Automotive">
                      Vorbeste cu un consultant specializat
                    </button>
                  </div>
                  
                  <div class="industry-row">
                    <i class="fa-solid fa-building-columns"></i>
                    <span>Instituții Publice</span>
                    <div class="industry-button-connector"></div>
                    <button class="contact-industry-btn" data-industry="institutii-publice" aria-label="Vorbește cu un consultant pentru Instituții Publice">
                      Vorbeste cu un consultant specializat
                    </button>
                  </div>
                </section>
                <!-- Companies Showcase (infinite logos) -->
                <section class="companies-showcase">
                  <div class="logo-carousel">
                      <div class="logo-track">
                          <!-- 1st track of logos -->
                          <img 
                            src="images/companies-logos/company-1.webp" 
                            class="company-logo" alt="Client" width="150" height="100" loading="lazy"
                          >
                          <img 
                            src="images/companies-logos/company-2.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-3.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-4.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client" 
                          >
                          <img 
                            src="images/companies-logos/company-5.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-6.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-7.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-8.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                      </div>
                      <div class="logo-track">
                          <!-- 2nd track of logos -->
                          <img 
                            src="images/companies-logos/company-9.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-10.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-11.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-12.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-13.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-14.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-15.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-16.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                          <img 
                            src="images/companies-logos/company-17.webp" width="150" height="100" loading="lazy"
                            class="company-logo" alt="Client"
                          >
                      </div>
                  </div>
                </section>
              </div>
              
              <!-- Contact Form Modal -->
              <div class="contact-modal">
                <div class="modal-content">
                  <span class="close-modal">&times;</span>
                  <h2>Contact Form</h2>
                  <form id="industry-contact-form">
                    <input type="hidden" id="selected-industry" name="industry">
                    <div class="form-group">
                      <label>Name:</label>
                      <input type="text" required>
                    </div>
                    <div class="form-group">
                      <label>Email:</label>
                      <input type="email" required>
                    </div>
                    <div class="form-group">
                      <label>Message:</label>
                      <textarea required></textarea>
                    </div>
                    <button type="submit" aria-label="Trimite Formular Abonare la Newsletter">Send</button>
                  </form>
                </div>
              </div>
              
              <?php
include 'includes/footer.php';
?>