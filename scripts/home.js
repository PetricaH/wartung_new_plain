document.addEventListener('DOMContentLoaded', function() {
    /* ---------------- Carousel Code ---------------- */
    const track = document.querySelector('.carousel-track');
    const items = Array.from(document.querySelectorAll('.carousel-item'));
    const prevButton = document.querySelector('.carousel-control.prev');
    const nextButton = document.querySelector('.carousel-control.next');
    const trackContainer = document.querySelector('.carousel-track-container');
  
    let currentPage = 0;
    let totalItems = items.length;
  
    function getItemsPerView() {
      return window.innerWidth >= 768 ? 3 : 1;
    }
    function getTotalPages() {
      return Math.ceil(totalItems / getItemsPerView());
    }
    let totalPages = getTotalPages();
  
    function updateCarousel() {
      const itemsPerView = getItemsPerView();
      totalPages = getTotalPages();
      if (currentPage > totalPages - 1) {
        currentPage = totalPages - 1;
      }
      const containerWidth = trackContainer.getBoundingClientRect().width;
      const shift = currentPage * containerWidth;
      track.style.transform = `translateX(-${shift}px)`;
    }
    prevButton.addEventListener('click', function() {
      if (currentPage > 0) {
        currentPage--;
        updateCarousel();
      }
    });
    nextButton.addEventListener('click', function() {
      if (currentPage < totalPages - 1) {
        currentPage++;
        updateCarousel();
      }
    });
    window.addEventListener('resize', function() {
      updateCarousel();
    });
    updateCarousel();
  
    /* --------------- Animate Numbers Code --------------- */
    const employeeCountElement = document.querySelector('.wartung-team .number-container span');
    const salesAmountElement = document.querySelector('.sales-last-year .number-container span');
    const averageDailySalesElement = document.getElementById('average-daily-sales');
  
    const targetEmployeeCount = 51;
    const targetSalesAmount = 14086044;
    const targetAverageDailySales = 38486;
  
    const animationDuration = 30000; // in ms
    const salesIncrement = 1000;
    const employeeIncrement = 1;
    const averageDailySalesIncrement = 10;
  
    let employeeCount = 0;
    let salesAmount = 0;
    let averageDailySales = 0;
  
    const employeeSteps = Math.ceil(targetEmployeeCount / (animationDuration / 60));
    const salesSteps = Math.ceil(targetSalesAmount / salesIncrement / (animationDuration / 60));
    const averageDailySalesSteps = Math.ceil(targetAverageDailySales / averageDailySalesIncrement / (animationDuration / 60));
  
    function animateNumbers() {
      if (employeeCount < targetEmployeeCount) {
        employeeCount += employeeSteps;
        if (employeeCount > targetEmployeeCount) employeeCount = targetEmployeeCount;
        employeeCountElement.textContent = employeeCount;
      }
      if (salesAmount < targetSalesAmount) {
        salesAmount += salesSteps * salesIncrement;
        if (salesAmount > targetSalesAmount) salesAmount = targetSalesAmount;
        salesAmountElement.textContent = (salesAmount / 1000000).toFixed(0) + '.000.000';
      }
      if (averageDailySales < targetAverageDailySales) {
        averageDailySales += averageDailySalesSteps * averageDailySalesIncrement;
        if (averageDailySales > targetAverageDailySales) averageDailySales = targetAverageDailySales;
        averageDailySalesElement.textContent = averageDailySales.toLocaleString('ro-RO');
      }
      if (employeeCount < targetEmployeeCount || salesAmount < targetSalesAmount || averageDailySales < targetAverageDailySales) {
        requestAnimationFrame(animateNumbers);
      } else {
        setTimeout(() => {
          employeeCount = 0;
          salesAmount = 0;
          averageDailySales = 0;
          employeeCountElement.textContent = employeeCount;
          salesAmountElement.textContent = salesAmount;
          averageDailySalesElement.textContent = averageDailySales;
          animateNumbers();
        }, 10000);
      }
    }
    animateNumbers();
  
    /* --------------- Steps Section & Contact Modal --------------- */
    const stepButtons = document.querySelectorAll('.step-button');
    const stepContents = document.querySelectorAll('.step-content');
  
    stepButtons.forEach(button => {
      button.addEventListener('click', () => {
        const step = button.getAttribute('data-step');
        stepButtons.forEach(btn => btn.classList.remove('active'));
        stepContents.forEach(content => content.classList.remove('active'));
        button.classList.add('active');
        document.querySelector(`.step-content[data-step="${step}"]`).classList.add('active');
        updateConnector(); // Update blob connector when step changes
      });
    });
  
    const contactButtons = document.querySelectorAll('.contact-industry-btn');
    const modal = document.querySelector('.contact-modal');
    const closeModal = document.querySelector('.close-modal');
    const selectedIndustryInput = document.getElementById('selected-industry');
  
    contactButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const industry = btn.getAttribute('data-industry');
        selectedIndustryInput.value = industry;
        modal.style.display = 'flex';
      });
    });
    closeModal.addEventListener('click', () => {
      modal.style.display = 'none';
    });
    window.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  
    /* --------------- Blob Connector for Steps Section --------------- */
    // Assumes you have a .steps-connector element in your HTML between the buttons and content
    const connector = document.querySelector('.steps-connector');
    const stepsSection = document.querySelector('#steps-to-success-section');
    const buttonsContainer = document.querySelector('.steps-buttons-container');
    const contentContainer = document.querySelector('.steps-content-container');
  
    function updateConnector() {
      const activeButton = document.querySelector('.step-button.active');
      if (!activeButton || !connector) return;
      
      // Calculate positions relative to the entire steps section
      const sectionRect = stepsSection.getBoundingClientRect();
      const buttonRect = activeButton.getBoundingClientRect();
      const buttonsRect = buttonsContainer.getBoundingClientRect();
      const contentRect = contentContainer.getBoundingClientRect();
      
      // Determine the horizontal center of the active button relative to the section
      const buttonCenter = buttonRect.left + buttonRect.width / 2 - sectionRect.left;
      connector.style.setProperty('--connector-left', `${buttonCenter}px`);
      
      // Position the connector between the bottom of the buttons and the top of the content
      const gapTop = buttonsRect.bottom - sectionRect.top;
      const gapBottom = contentRect.top - sectionRect.top;
      const gapHeight = gapBottom - gapTop;
      
      connector.style.top = `${gapTop}px`;
      connector.style.height = `${gapHeight}px`;
    }
    updateConnector();
    window.addEventListener('resize', updateConnector);
  });
  