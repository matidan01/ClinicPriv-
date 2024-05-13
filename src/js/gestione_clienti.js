document.addEventListener("DOMContentLoaded", function() {

    // Permette di accedere al profilo di un cliente 
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