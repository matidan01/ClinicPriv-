// Aggiunge la data consegna e aggiorna le quantità del materiale in magazzino  
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