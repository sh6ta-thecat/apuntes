document.addEventListener('DOMContentLoaded', function () {
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContent = document.querySelector('.tab-content');
    const username = window.location.pathname.split('@')[1]?.split('/')[0]; // Obtiene el nombre de usuario de la URL

    // Function to load content for a given tab
    function loadTabContent(tab) {
        fetch(`app/views/profile/${tab}.php`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                tabContent.innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading tab content:', error);
                tabContent.innerHTML = '<p>Error loading content. Please try again later.</p>';
            });
    }

    // Function to set the active tab
    function setActiveTab(tab) {
        tabLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('data-tab') === tab) {
                link.classList.add('active');
            }
        });
    }

    // Event listener for tab links
    tabLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const tab = this.getAttribute('data-tab');

            // Remove active class from all links
            setActiveTab(tab);

            // Load the content for the selected tab
            loadTabContent(tab);

            // Update the URL
            const newUrl = `/conecter/@${username}/${tab}`;
            history.pushState(null, '', newUrl);
        });
    });

    // Handle back/forward navigation
    window.addEventListener('popstate', function () {
        const currentTab = window.location.pathname.split('/').pop();
        setActiveTab(currentTab);
        loadTabContent(currentTab);
    });

    // Load the content for the initial tab or default to 'info'
    const pathParts = window.location.pathname.split('/');
    const initialTab = pathParts.length > 1 ? pathParts.pop() : 'info';
    setActiveTab(initialTab);
    loadTabContent(initialTab);
});
