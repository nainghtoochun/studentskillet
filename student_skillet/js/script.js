// js/script.js
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Live Search (Bonus)
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('.recipe-card').forEach(card => {
                const title = card.getAttribute('data-title');
                card.style.display = title.includes(term) ? 'block' : 'none';
            });
        });
    }

    // 2. Form Validation
    const form = document.getElementById('recipeForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const title = document.querySelector('[name="title"]').value;
            const prep = document.querySelector('[name="prep_time"]').value;
            
            if (title.trim() === "") {
                alert("Title is required!");
                e.preventDefault();
            } else if (prep < 1 || isNaN(prep)) {
                alert("Prep time must be a positive number!");
                e.preventDefault();
            }
        });
    }
});
