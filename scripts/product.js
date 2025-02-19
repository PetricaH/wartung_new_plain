// product-page.js

document.addEventListener('DOMContentLoaded', function() {
    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            closeModals();
        }
    };
});

function changeMainImage(newSrc) {
    const mainImage = document.getElementById('mainImage');
    if (mainImage) {
        mainImage.src = newSrc;
    }
}

function showDatasheetModal(productId, productName) {
    const modal = document.getElementById('datasheetModal');
    document.getElementById('datasheetProductId').value = productId;
    document.getElementById('datasheetProductName').value = productName;
    document.querySelector('#datasheetModal .product-name').textContent = productName;
    modal.style.display = 'block';
}

function showOfferModal(productId, productName) {
    const modal = document.getElementById('offerModal');
    document.getElementById('offerProductId').value = productId;
    document.getElementById('offerProductName').value = productName;
    document.querySelector('#offerModal .product-name').textContent = productName;
    modal.style.display = 'block';
}

function closeModals() {
    document.querySelectorAll('.modal').forEach(modal => {
        modal.style.display = 'none';
    });
}

function submitDatasheetForm(event) {
    event.preventDefault();
    submitForm(event.target, 'includes/process_requests/process_datasheet_request.php', true);
}

function submitOfferForm(event) {
    event.preventDefault();
    submitForm(event.target, 'includes/process_requests/process_offer_request.php', false);
}

// General form submission handler
async function submitOfferForm(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    
    try {
        const response = await fetch('includes/process_requests/process_offer_request.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        if (result.success) {
            if (result.needsVerification) {
                alert('Vă rugăm să verificați email-ul pentru a confirma solicitarea.');
            } else {
                alert('Solicitarea dumneavoastră a fost procesată cu succes!');
            }
            closeModals();
            form.reset();
        } else {
            alert('Eroare: ' + (result.error || 'Vă rugăm să încercați din nou.'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('A apărut o eroare. Vă rugăm să încercați din nou.');
    }
}

// General form submission handler
async function submitDatasheetForm(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    
    try {
        const response = await fetch('includes/process_requests/process_datasheet_request.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        if (result.success) {
            if (result.needsVerification) {
                alert('Vă rugăm să verificați email-ul pentru a confirma solicitarea.');
            } else {
                alert('Solicitarea dumneavoastră a fost procesată cu succes!');
            }
            closeModals();
            form.reset();
        } else {
            alert('Eroare: ' + (result.error || 'Vă rugăm să încercați din nou.'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('A apărut o eroare. Vă rugăm să încercați din nou.');
    }
}