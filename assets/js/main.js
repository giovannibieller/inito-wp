document.addEventListener('DOMContentLoaded', () => {
    let toConsole = message => {
        console.log(message);
    };

    const mess = 'main js loaded';
    toConsole(mess);

    // Search Form Enhancement
    const searchForms = document.querySelectorAll('.search-form');
    
    searchForms.forEach(form => {
        const searchField = form.querySelector('.search-form__field');
        const submitButton = form.querySelector('.search-form__submit');
        
        if (searchField && submitButton) {
            // Add loading state functionality
            form.addEventListener('submit', (e) => {
                const query = searchField.value.trim();
                
                if (query.length < 2) {
                    e.preventDefault();
                    searchField.focus();
                    return false;
                }
                
                // Add loading state
                submitButton.disabled = true;
                submitButton.setAttribute('aria-label', 'Searching...');
                
                // Add loading class for CSS animations
                form.classList.add('search-form--loading');
            });
            
            // Enhanced keyboard navigation
            searchField.addEventListener('keydown', (e) => {
                switch(e.key) {
                    case 'Escape':
                        searchField.blur();
                        if (searchField.value) {
                            searchField.value = '';
                        }
                        break;
                    case 'Enter':
                        e.preventDefault();
                        form.dispatchEvent(new Event('submit'));
                        break;
                }
            });
            
            // Auto-focus behavior (optional)
            if (form.classList.contains('search-form--auto-focus')) {
                searchField.focus();
            }
            
            // Clear search on double click
            searchField.addEventListener('dblclick', () => {
                searchField.value = '';
                searchField.focus();
            });
        }
    });
    
    // Search suggestions (if you want to add AJAX search later)
    const initSearchSuggestions = () => {
        // Placeholder for future AJAX search functionality
        // You can expand this to add live search suggestions
    };
});
