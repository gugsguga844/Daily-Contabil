document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const subcategoryCards = document.querySelectorAll('.bg-white.rounded-lg.shadow-sm');

    if (!searchInput) return;

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        subcategoryCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('p').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
}); 