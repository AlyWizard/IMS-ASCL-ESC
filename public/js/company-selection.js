// Show/hide appropriate content based on selected company
document.addEventListener('DOMContentLoaded', function() {
    const escName = document.getElementById('esc-name');
    const allianceName = document.getElementById('alliance-name');
    const escEnter = document.getElementById('esc-enter');
    const allianceEnter = document.getElementById('alliance-enter');
    
    // New elements for the logo switching
    const escIcon = document.getElementById('esc-icon');
    const allianceIcon = document.getElementById('alliance-icon');
    //const escText = document.getElementById('esc-text');
   // const allianceText = document.getElementById('alliance-text');
    
    // Function to toggle content based on selected radio
    function toggleContent() {
        if (document.getElementById('item-1').checked) {
            // Show ESC content
            escName.style.display = 'block';
            allianceName.style.display = 'none';
            escEnter.style.display = 'inline-block';
            allianceEnter.style.display = 'none';
            
            // Show ESC logo elements
            escIcon.style.display = 'block';
            allianceIcon.style.display = 'none';
            escText.style.display = 'inline';
            allianceText.style.display = 'none';
        } else {
            // Show Alliance content
            escName.style.display = 'none';
            allianceName.style.display = 'block';
            escEnter.style.display = 'none';
            allianceEnter.style.display = 'inline-block';
            
            // Show Alliance logo elements
            escIcon.style.display = 'none';
            allianceIcon.style.display = 'block';
            escText.style.display = 'none';
            allianceText.style.display = 'inline';
        }
    }
    
    // Add change event listeners to radio buttons
    document.getElementById('item-1').addEventListener('change', toggleContent);
    document.getElementById('item-2').addEventListener('change', toggleContent);
    
    // Handle ESC key press
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' || event.key === 'Esc') {
            if (document.getElementById('item-1').checked) {
                document.getElementById('item-2').checked = true;
            } else {
                document.getElementById('item-1').checked = true;
            }
            toggleContent();
        }
    });
    
    // Initialize content
    toggleContent();
});