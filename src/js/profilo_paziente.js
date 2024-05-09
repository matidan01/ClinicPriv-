// Esegue il pagamento di molteplici appuntamenti selezionati 
function inviaPrestazioniSelezionate() {
    const checkboxList = document.querySelectorAll('input[type="checkbox"]:checked');
    let data = new FormData();
    data.append('numero', checkboxList.length);
    i = 1;
    checkboxList.forEach(function(checkbox) {
        data.append(i, checkbox.id);
        i++;
        data.append(i, checkbox.value);
        i++; 
    });

    axios.post('../../api/receptionist/pagamento_appuntamento.php', data)
    .then(function (response) {
        if(response.data == 'OK') {
            alert('Pagamento effettuato!');
            location.reload();
        } else {
            alert('Mi dispiace, qualcosa è andato storto');

        }
    })
    .catch(function (error) {
        console.error(error);
    });
}

// Aggiorna il totale in base agli appuntamenti selezionati
function aggiornaTotale() {
    let totale = 0;
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    checkboxes.forEach(function(checkbox) {
        totale += parseFloat(checkbox.value); 
    });
    document.getElementById('totale').innerText = '$' + totale.toFixed(2);
}

document.addEventListener("DOMContentLoaded", function() {

    // Aggiunge righe per l'inserimento di un nuovo farmaco
    document.getElementById('aggiungiRighe').addEventListener('click', function() {
        var container = document.getElementById('farmaciContainer');
        var row = document.createElement('div');
        row.className = 'row mb-3';
        row.innerHTML = `
            <div class="col">
                <input type="text" class="form-control" name="nomeFarmaco[]" placeholder="Nome Farmaco" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="descrizione[]" placeholder="Descrizione">
            </div>
        `;
        container.appendChild(row);
    });
});
