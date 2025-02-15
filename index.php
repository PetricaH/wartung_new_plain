<?php
// Define page-specific SEO variables
$pageTitle = "Acasă | Wartung";
$pageDescription = "Descoperă produse de întreținere certificate și eco de la Wartung. Soluții eficiente pentru curățenie, lubrifiere, construcții și metalurgie.";
$pageKeywords = "produse întreținere, curățenie eco, lubrifiere, construcții, metalurgie, Wartung";

include 'includes/header.php';
include 'includes/navbar.php';
?>
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
                  src="/images/303.png" 
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
              src="images/certificates-imgs/certificate-one.png" 
              alt="Certificat Acreditare NSF"
            >
            <img 
              src="images/certificates-imgs/certificate-two.png" 
              alt="Certificat Acreditare ISO 9001"
            >
            <img 
              src="images/certificates-imgs/certificate-three.png" 
              alt="Certificat Acreditare CE"
            >
            <img 
              src="images/certificates-imgs/certificate-four.png" 
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
                  class="do-something-btn"
                >
                  <i class="fa-solid fa-play"></i>
                </button>
            </div>
            <p>
                “Lorem Ipsum is simply dummy text of the printing and typesetting industry...
            </p>
            <span class="testi-bar"></span>
            <span class="testi-name">Mihai</span>
        </div>

        <div class="companies-we-worked-with-container">
            <p>Am livrat rezultate la</p>
            <div class="companies-carousel">
              <button class="carousel-control prev do-something-btn">
                <i class="fa-solid fa-caret-left"></i>
              </button>
              
              <div class="carousel-track-container">
                <div class="carousel-track">
                  <div class="carousel-item">
                    <img 
                      src="images/certificates-imgs/certificate-one.png" 
                      alt="Certificate One"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/certificates-imgs/certificate-two.png" 
                      alt="Certificate Two"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/certificates-imgs/certificate-three.png" 
                      alt="Certificate Three"
                    >
                  </div>
                  <div class="carousel-item">
                    <img 
                      src="images/certificates-imgs/certificate-four.png" 
                      alt="Certificate Four"
                    >
                  </div>
                </div>
              </div>
              
              <button class="carousel-control next do-something-btn">
                <i class="fa-solid fa-caret-right"></i>
              </button>
              
              <div class="carousel-dots"></div>
            </div>
        </div>

        <!-- Companies Showcase (infinite logos) -->
        <section class="companies-showcase">
          <div class="logo-carousel">
              <div class="logo-track">
                  <!-- 1st track of logos -->
                  <img 
                    src="images/companies-logos/company-1.png" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-2.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-3.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-4.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-5.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-6.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-7.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-8.png" 
                    class="company-logo" alt="Client"
                  >
              </div>
              <div class="logo-track">
                  <!-- 2nd track of logos -->
                  <img 
                    src="images/companies-logos/company-9.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-10.webp" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-11.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-12.png" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-13.svg" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-14.webp" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-15.png" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-16.webp" 
                    class="company-logo" alt="Client"
                  >
                  <img 
                    src="images/companies-logos/company-17.png" 
                    class="company-logo" alt="Client"
                  >
              </div>
          </div>
        </section>

        <!-- Video Testimonial IMOCON -->
        <div class="video-testimonial">
            <span class="business-name">IMOCON</span>
            <div class="video-container imocon">
                <button 
                  onclick="window.location.href='https://youtu.be/uCB06_QxqWA?si=HhGhDDuDzw1UDAw8';"
                  class="do-something-btn"
                >
                  <i class="fa-solid fa-play"></i>
                </button>  
            </div>
            <p>
                “Lorem Ipsum is simply dummy text of the printing and typesetting industry...
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
                        <button class="what-about-results-hover-button what-about-results-hover-button-left">
                            ALIMENTARĂ
                        </button>
                        <button class="what-about-results-hover-button what-about-results-hover-button-right">
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
                        <button class="what-about-results-hover-button what-about-results-hover-button-left">
                            ALIMENTARĂ
                        </button>
                        <button class="what-about-results-hover-button what-about-results-hover-button-right">
                            GENERALĂ
                        </button>
                    </div>
                </div>

                <!-- Card 3: CONSTRUCȚII -->
                <div class="what-about-results-card what-about-results-card-serv">
                    <div class="what-about-results-single-constructii-image"></div>
                    <span class="what-about-results-card-title">CONSTRUCȚII</span>
                    <div class="what-about-results-hover-buttons">
                        <button class="what-about-results-hover-button what-about-results-hover-button-bottom">
                            DETALII
                        </button>
                    </div>
                </div>

                <!-- Card 4: METALURGIE -->
                <div class="what-about-results-card what-about-results-card-serv">
                    <div class="what-about-results-single-metalurgie-image"></div>
                    <span class="what-about-results-card-title">METALURGIE</span>
                    <div class="what-about-results-hover-buttons">
                        <button class="what-about-results-hover-button what-about-results-hover-button-bottom">
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
              <button class="step-button active" data-step="1">Pasul 1</button>
              <button class="step-button" data-step="2">Pasul 2</button>
              <button class="step-button" data-step="3">Pasul 3</button>
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
                <button class="contact-industry-btn" data-industry="alimentara">
                    Vorbeste cu un consultant specializat
                </button>
            </div>
            
            <div class="industry-row">
                <i class="fa-solid fa-bed"></i>
                <span>Industria HORECA</span>
                <div class="industry-button-connector"></div>
                <button class="contact-industry-btn" data-industry="horeca">
                    Vorbeste cu un consultant specializat
                </button>
            </div>

            <div class="industry-row">
                <i class="fa-solid fa-person-digging"></i>
                <span>Industria Construcții</span>
                <div class="industry-button-connector"></div>
                <button class="contact-industry-btn" data-industry="construcții">
                    Vorbeste cu un consultant specializat
                </button>
            </div>

            <div class="industry-row">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <span>Industria Metalurgică</span>
                <div class="industry-button-connector"></div>
                <button class="contact-industry-btn" data-industry="metalurgica">
                    Vorbeste cu un consultant specializat
                </button>
            </div>

            <div class="industry-row">
                <i class="fa-solid fa-car-side"></i>
                <span>Industria Automotive</span>
                <div class="industry-button-connector"></div>
                <button class="contact-industry-btn" data-industry="automotive">
                    Vorbeste cu un consultant specializat
                </button>
            </div>

            <div class="industry-row">
                <i class="fa-solid fa-building-columns"></i>
                <span>Instituții Publice</span>
                <div class="industry-button-connector"></div>
                <button class="contact-industry-btn" data-industry="institutii-publice">
                    Vorbeste cu un consultant specializat
                </button>
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
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
<?php
include 'includes/footer.php';
?>