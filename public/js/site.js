
window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);



    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

   
    // Seleciona todos os itens de menu
    var menuItems = document.querySelectorAll('nav ul li a');
    menuItems[0].classList.add('active');

    // Adiciona um evento de hashchange ao objeto window
    window.addEventListener('hashchange', function() {
        // Verifica qual section está ativa
        var activeSectionId = window.location.hash.replace('#', '');
        var activeSection = document.getElementById(activeSectionId);

        // Encontra o menu item correspondente à section ativa
        var activeMenuItem = null;
        for (var i = 0; i < menuItems.length; i++) {
            if (menuItems[i].getAttribute('href') === '#' + activeSectionId) {
            activeMenuItem = menuItems[i];
            break;
            }
        }

        // Adiciona a classe active ao menu item correspondente
        if (activeMenuItem) {
            // Remove a classe active de todos os outros menu items
            for (var i = 0; i < menuItems.length; i++) {
                menuItems[i].classList.remove('active');
            }

            // Adiciona a classe active ao menu item correspondente
            activeMenuItem.classList.add('active');
        }
    });
});
