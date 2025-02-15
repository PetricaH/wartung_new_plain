// Encapsulate the script in an IIFE (Immediately Invoked Function Expression)
(function () {
    // Store commonly accessed DOM elements to reduce repetitive queries
    const domElements = {
        menuToggle: document.getElementById('menu_toggle'), // Button to toggle menu
        navMenu: document.getElementById('nav_menu'), // The navigation menu
    };

    const menuItems = domElements.navMenu ? Array.from(domElements.navMenu.querySelectorAll('li')) : [];

    /**
     * Toggles the visibility of the navigation menu
     * Triggered when the menu toggle button is clicked
     */
    function initMenuToggle() {
        const { menuToggle, navMenu } = domElements;
    
        if (menuToggle && navMenu) {
            const menuItems = navMenu.querySelectorAll('a'); // select all <a> elements from the menu
            const forms = navMenu.querySelectorAll('form'); // select all the forms from the menu

            menuToggle.addEventListener('click', () => {
                const isOpening = !navMenu.classList.contains('active');
                navMenu.classList.toggle('active'); // Show/hide the menu
                menuToggle.classList.toggle('open'); // Change button appearance
    
                if (isOpening) {
                    // Add animations to menu items when the menu opens
                    menuItems.forEach((item, index) => {
                        item.style.animation = `fadeInUp 0.5s ease forwards ${0.5 + index * 0.1}s`;
                    });
                }
            });

            // close menu when any menu item is clicked
            menuItems.forEach((item) => {
                item.addEventListener('click', () => {
                    navMenu.classList.remove('active');
                    menuToggle.classList.remove('open');
                });
            });

            // prevent menu from closing when interacting with forms
            forms.forEach((form) => {
                form.addEventListener('click', (event) => {
                    event.stopPropagation(); // stop event from bubbling to parent <li>
                });

                // close menu when the form is submitted 
                form.addEventListener('submit', () => {
                    navMenu.classList.remove('active');
                    menuToggle.classList.remove('open');
                });
            });
        } else {
            console.error('Menu toggle or navigation menu is not defined.');
        }
    }    

    function init() {
        initMenuToggle(); // Set up menu toggle functionality
    };
    // Run the initialization function when the DOM content is loaded
    document.addEventListener('DOMContentLoaded', init);
})();