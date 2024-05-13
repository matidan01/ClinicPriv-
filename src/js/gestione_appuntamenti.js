document.addEventListener("DOMContentLoaded", function() {

    // Permette di accedere al dettaglio appuntamento 
    const rows = document.querySelectorAll(".clickable-row"); 
    rows.forEach(row => {
        row.addEventListener("click", function() {
            const url = row.getAttribute("data-href"); 
            if (url) {
                window.location.href = url; 
            }
        });
    });

});
