function aggiungiRighe() {
    var container = document.getElementById('materialeContainer');
    var row = document.createElement('div');
    row.className = 'mb-3';
    row.innerHTML = `
            <input list="materiali" class="form-control" name="materiali[]">
            <datalist id="materiali">
                <?php
                    foreach($materiali as $materiale) {
                        $str = $materiale['idMateriale'] . ' - ' . $materiale['nome'] . ' ' . $materiale['quantita'];
                        echo '<option value="' . $str . '">';
                    };
                ?>
            </datalist>
    `;
    container.appendChild(row);

    var container = document.getElementById('quantitaContainer');
    var row = document.createElement('div');
    row.className = 'mb-3';
    row.innerHTML = `
        <input type="number" class="form-control" name="quantita[]">
    `;
    container.appendChild(row);
}
    
document.addEventListener("DOMContentLoaded", function() {
    let buttons = document.getElementsByClassName('btn btn-primary aggiungiConsegna');

    let buttonsArray = Array.from(buttons);

    buttonsArray.forEach(e => {
        e.addEventListener('click', function() {
            if(confirm("Sicuro di voler aggiungere la consegna?")) {
                let data = new FormData();
                data.append('idOrdine', this.value);

                axios.post('../../api/receptionist/aggiungi_consegna_ordine.php', data)
                .then(function (response) {
                    location.reload();
                })
                .catch(function (error) {
                    console.error(error);
                });
            }
        });
    });
});