/* public/js/company-selection.js */

document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const allianceCard = document.querySelector('.alliance-card');
    const escCard = document.querySelector('.esc-card');
    const allianceRadio = document.getElementById('alliance-radio');
    const escRadio = document.getElementById('esc-radio');
    
    // Add highlight animation when hovering over cards
    allianceCard.addEventListener('mouseenter', function() {
        if (!allianceRadio.checked) {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.3)';
        }
    });
    
    allianceCard.addEventListener('mouseleave', function() {
        if (!allianceRadio.checked) {
            this.style.transform = '';
            this.style.boxShadow = '';
        }
    });
    
    escCard.addEventListener('mouseenter', function() {
        if (!escRadio.checked) {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.3)';
        }
    });
    
    escCard.addEventListener('mouseleave', function() {
        if (!escRadio.checked) {
            this.style.transform = '';
            this.style.boxShadow = '';
        }
    });
    
    // Prevent form submission when clicking on the card (but not the enter button)
    document.querySelectorAll('.directory-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Don't interfere with the Enter button click
            if (!e.target.classList.contains('enter-btn') && 
                !e.target.closest('.enter-btn')) {
                e.preventDefault();
                
                // Find the radio input within this card and check it
                const radio = this.getAttribute('for');
                document.getElementById(radio).checked = true;
                
                // Add a small animation to show selection
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            }
        });
    });
    
    // Handle Enter button clicks to navigate properly
    document.querySelectorAll('.enter-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Allow the default anchor behavior 
            // This is just to prevent the event from bubbling up to the card
            e.stopPropagation();
        });
    });
});