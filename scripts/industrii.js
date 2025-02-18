// industrii.js
document.addEventListener('DOMContentLoaded', function(){
    const industryCards = document.querySelectorAll('.industry-card');
    const productsSection = document.getElementById('products-section');
    const productsContainer = document.getElementById('products-container');
    const loadingState = document.querySelector('.loading-state');
    const errorState = document.getElementById('error-state');
    const filterControls = document.getElementById('filter-controls');
    const breadcrumbCategory = document.getElementById('breadcrumb-category');
    const baseImageUrl = "/shared_images/product_images/";
    const contactModal = document.getElementById('contact-modal');
    const modalClose = document.querySelector('.modal-close');

    // Product Card Template
    const productCardTemplate = (product) => `
        <article class="product-card" role="listitem">
            <div class="product-header">
                ${product.primary_image ? 
                    `<img src="${baseImageUrl}${product.primary_image}" 
                         alt="${product.name}" 
                         class="product-image"
                         loading="lazy">` : 
                    '<div class="image-placeholder">Fără imagine</div>'}
                <div class="product-badges">
                    ${product.subcategory_name ? 
                        `<span class="badge subcategory-badge">${product.subcategory_name}</span>` : ''}
                    <span class="badge category-badge">${product.category_name}</span>
                </div>
            </div>
            <div class="product-content">
                <h4 class="product-title">${product.name}</h4>
                
                ${product.short_description ? 
                    `<p class="product-description">${product.short_description}</p>` : ''}
                
                <div class="product-specs">
                    ${product.specifications ? 
                        Object.entries(product.specifications)
                            .map(([key, value]) => `
                                <div class="spec-item">
                                    <span class="spec-label">${key}:</span>
                                    <span class="spec-value">${value}</span>
                                </div>
                            `).join('') : ''}
                </div>
                
                ${product.key_features ? `
                    <ul class="features-list">
                        ${product.key_features
                            .map(feature => `<li class="feature-item">✓ ${feature}</li>`)
                            .join('')}
                    </ul>` : ''}
                
                <div class="product-actions">
                    <a href="product.php?id=${product.product_id}" 
                       class="btn-detalii"
                       aria-label="Vezi specificații complete pentru ${product.name}">
                        <span class="icon">📋</span>
                        Specificații complete
                    </a>
                    <button class="btn-contact" 
                            onclick="showContactModal('${product.product_id}', '${product.name}')"
                            aria-label="Solicită ofertă pentru ${product.name}">
                        <span class="icon">💬</span>
                        Solicită ofertă
                    </button>
                </div>
            </div>
        </article>
    `;

    // Modal Functions
    window.showContactModal = function(productId, productName) {
        const productInput = document.getElementById('modal-product-name');
        if (contactModal && productInput) {
            productInput.value = productName;
            contactModal.classList.add('modal-open');
            document.body.style.overflow = 'hidden';
        }
    };

    function closeModal() {
        if (contactModal) {
            contactModal.classList.remove('modal-open');
            document.body.style.overflow = '';
        }
    }

    // Fetch Products
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

    // Display Products
    function displayProducts(products) {
        productsContainer.innerHTML = products.length ? 
            products.map(productCardTemplate).join('') : 
            '<p class="no-products">Nu există produse în această categorie.</p>';
        
        updateFilters(products);
    }

    // Update Filters
    function updateFilters(products) {
        const subcategories = [...new Set(products.map(p => p.subcategory_name).filter(Boolean))];
        
        filterControls.innerHTML = subcategories.length ? `
            <label for="subcategory-filter">Filtrează după subcategorie:</label>
            <select id="subcategory-filter" class="filter-dropdown">
                <option value="">Toate subcategoriile</option>
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
            breadcrumbCategory.textContent = industry;
            document.querySelectorAll('.industry-card').forEach(c => 
                c.classList.remove('active'));
            this.classList.add('active');
            productsSection.hidden = false;
            window.scrollTo({ top: productsSection.offsetTop - 100, behavior: 'smooth' });
            fetchProducts(industry);
        });
    });

    modalClose?.addEventListener('click', closeModal);
    contactModal?.addEventListener('click', (e) => {
        if (e.target === contactModal) closeModal();
    });

    document.querySelector('.retry-button')?.addEventListener('click', () => {
        const currentIndustry = document.querySelector('.industry-card.active')?.dataset.industry;
        if (currentIndustry) fetchProducts(currentIndustry);
    });

    // Form submission
    const contactForm = document.getElementById('contact-form');
    contactForm?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        
        try {
            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });
            
            if (!response.ok) throw new Error('Network response was not ok');
            
            const result = await response.json();
            if (result.success) {
                alert('Cererea dvs. a fost trimisă cu succes!');
                this.reset();
                closeModal();
            } else {
                throw new Error(result.message || 'Error sending inquiry');
            }
        } catch (error) {
            alert('A apărut o eroare. Vă rugăm încercați din nou.');
            console.error('Form submission error:', error);
        } finally {
            submitButton.disabled = false;
        }
    });
});