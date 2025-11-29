/**
 * Main JavaScript file for Botica
 */

// Function to filter products in the table or grid
function filterProducts() {
    const searchInput = document.getElementById('searchInput');
    if (!searchInput) return;

    const filter = searchInput.value.toLowerCase();
    
    // Filter Table Rows (Productos)
    const productRows = document.querySelectorAll('.product-row');
    productRows.forEach(row => {
        const name = row.getAttribute('data-name');
        const category = row.getAttribute('data-category');
        
        if (name.includes(filter) || category.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });

    // Filter Cards (Ventas)
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        const name = card.getAttribute('data-name');
        const category = card.getAttribute('data-category');
        
        if (name.includes(filter) || category.includes(filter)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

// Initialize tooltips or other global JS if needed
document.addEventListener('DOMContentLoaded', function() {
    // Example: Enable Bootstrap tooltips if used
    // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    //   return new bootstrap.Tooltip(tooltipTriggerEl)
    // })
});
