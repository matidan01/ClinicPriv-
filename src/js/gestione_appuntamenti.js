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

    // Aggiunge righe per responsabili nel form di inserimento di un nuovo appuntamento  
    document.getElementById('aggiungiRigheMedici').addEventListener('click', function() {
        var container = document.getElementById('mediciContainer');
        var row = document.createElement('div');
        row.className = 'mb-3';
        row.innerHTML = `
                <input list="medici" name="medici[]">
                <datalist id="medici">
                    <?php
                        foreach($medici as $medico) {
                            $str = $medico['nBadge'] . ' ' . $medico['nome'] . ' ' . $medico['cognome'];
                            echo '<option value="' . $str . '">';
                        };
                    ?>
                </datalist>
        `;
        container.appendChild(row);
    });

    // Aggiunge righe per assistenti nel form di inserimento di un nuovo appuntamento 
    document.getElementById('aggiungiRigheOperatori').addEventListener('click', function() {
        var container = document.getElementById('operatoriContainer');
        var row = document.createElement('div');
        row.className = 'mb-3';
        row.innerHTML = `
                <input list="operatori" name="operatori[]">
                <datalist id="operatori">
                    <?php
                        foreach($operatori as $operatore) {
                            $str = $operatore['nBadge'] . ' ' . $operatore['nome'] . ' ' . $operatore['cognome'];
                            echo '<option value="' . $str . '">';
                        };
                    ?>
                </datalist>
        `;
        container.appendChild(row);
    });

});
