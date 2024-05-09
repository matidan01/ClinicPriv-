// Invia il prezzo di una specifica prestazione
function riceviCosto() {
    let data = new FormData();
    data.append('id', document.getElementById('id').value);
    axios.post('../../api/receptionist/ricevi_costo.php', data)
    .then(function (response) {
        if(confirm("Il costo totale della prestazione è: " + response.data)) {
            pagaPrestazione(response.data);
        }
    })
    .catch(function (error) {
        console.error(error);
    });
}

// Esegure il pagamento di una prestazione
function pagaPrestazione(costo) {
    if(window.confirm('Conferma il pagamento?')) {
        let data = new FormData();
        data.append("risorsa","appuntamento");
        data.append('id', document.getElementById('id').value);
        data.append('costo', costo);
        axios.post('../../api/receptionist/pagamento_appuntamento.php', data)
        .then(function (response) {
            if(response.data == 'OK') {
                alert('Pagamento effettuato!');
            } else {
                alert('Mi dispiace, qualcosa è andato storto!');
            }
        })
        .catch(function (error) {
            console.error(error);
        });
    }
}

// Esegue la cancellazione di un appuntamento
function deleteAppointment() {
    if(window.confirm("Sicuro di voler eliminare l'appuntamento?")) {
        let data = new FormData();
        data.append('id', document.getElementById('id').value);
        axios.post('../../api/receptionist/elimina_appuntamento.php', data)
        .then(function (response) {
            if(response.data == 'OK') {
                alert('Cancellazione effettuata!');
                window.location.href = "gestione_appuntamenti.php";
            } else {
                alert('Appuntamento già pagato non si può cancellare');
            }
        })
        .catch(function (error) {
            console.error(error);
        });
    }
}
