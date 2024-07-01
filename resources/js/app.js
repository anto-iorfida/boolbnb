import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.js-confirm-delete');
    const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    const apartmentTitleElement = document.getElementById('apartment-title');
    const deleteForm = document.getElementById('delete-form');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const apartmentId = this.getAttribute('data-apartment-id');
            const apartmentTitle = this.getAttribute('data-apartment-title');

            apartmentTitleElement.textContent = apartmentTitle;
            deleteForm.action = `/admin/apartments/${apartmentId}`;

            confirmDeleteModal.show();
        });
    });
});





//  funzione che da risultati all'input del created.blade.php----------------------------------------
// aggiungiamo un listener per l'evento 'DOMContentLoaded', che viene eseguito quando il documento HTML è stato completamente caricato e analizzato.
document.addEventListener('DOMContentLoaded', function () {
    // selezioniamo l'elemento input con id 'address' dal DOM e lo assegna alla costante addressInput.
    const addressInput = document.getElementById('address');
    // selezioniamo l'elemento div con id 'addressSuggestions' dal DOM e lo assegna alla costante addressSuggestions.
    const addressSuggestions = document.getElementById('addressSuggestions');
    // selezioniamo l'elemento input hidden con id 'latitude' dal DOM e lo assegna alla costante latitudeInput.
    const latitudeInput = document.getElementById('latitude');
    // selezioniamo l'elemento input hidden con id 'longitude' dal DOM e lo assegna alla costante longitudeInput.
    const longitudeInput = document.getElementById('longitude');

    // aggiungiamo un listener per l'evento 'input' sull'elemento addressInput.
    addressInput.addEventListener('input', function () {
        // ottenuto il valore corrente dell'input addressInput e lo assegna alla variabile query.
        const query = addressInput.value;

        // controloo se la lunghezza del valore di input è maggiore di 2.
        if (query.length > 2) {
            // Esegue una richiesta fetch per ottenere suggerimenti di indirizzi dall'API di TomTom.chiave ***NON TOCCARE LA CHIAVE*****
            fetch(`https://api.tomtom.com/search/2/search/${query}.json?key=tNdeH4PSEGzxLQ1CKK0HdCagLd1BsXSc&countrySet=IT`)
                .then(response => response.json()) // Converte la risposta in formato JSON.
                .then(data => {
                    // pulisce i suggerimenti precedenti nell'elemento addressSuggestions.
                    addressSuggestions.innerHTML = '';
                    // Itera sui risultati dell'API.
                    data.results.forEach(result => {
                        // crea un nuovo elemento 'a' per ogni risultato.
                        const suggestion = document.createElement('a');
                        // impostiamo l'attributo href dell'elemento 'a' su '#'.
                        suggestion.href = "#";
                        // aggiungiamo le classi 'list-group-item' e 'list-group-item-action' all'elemento 'a'.
                        suggestion.classList.add('list-group-item', 'list-group-item-action');
                        // impostiamo il testo dell'elemento 'a' sull'indirizzo suggerito.
                        suggestion.textContent = result.address.freeformAddress;
                        // aggiungiamo un listener per l'evento 'click' sull'elemento 'a'.
                        suggestion.addEventListener('click', function (e) {
                            e.preventDefault(); // Previene il comportamento predefinito del link.
                            // impostiamo il valore dell'input addressInput sull'indirizzo suggerito.
                            addressInput.value = result.address.freeformAddress;
                            // impostiamo il valore dell'input hidden latitudeInput sulla latitudine del risultato.
                            latitudeInput.value = result.position.lat;
                            // impostiamo il valore dell'input hidden longitudeInput sulla longitudine del risultato.
                            longitudeInput.value = result.position.lon;
                            // pulisce i suggerimenti dopo la selezione.
                            addressSuggestions.innerHTML = '';
                        });
                        // aggiungiamo l'elemento 'a' ai suggerimenti.
                        addressSuggestions.appendChild(suggestion);
                    });
                })
                // Gestisce eventuali errori nella richiesta fetch.
                .catch(error => console.error('Error fetching address suggestions:', error));
        } else {
            // Se il valore di input è inferiore a 3 caratteri, pulisce i suggerimenti.
            addressSuggestions.innerHTML = '';
        }
    });
});
//  ///funzione che da risultati all'input del created.blade.php----------------------------------------


//     funzione che fa comparirele card sponsor al click del botton in show----------------------------------------
document.getElementById('toggleCardsButton').addEventListener('click', function () {
    const cardsContainer = document.getElementById('cardsContainer');
    cardsContainer.classList.toggle('d-none');
});
//  ///funzione che fa comparirele card sponsor al click del botton in show----------------------------------------
// -------------------------------------------FAR COMPARIRE PER 4 SECONDI MESSAGGIO SESSIONE------------------------------
// messaggio che compare per 3 secondi con conferma eliminazione 
setTimeout(function () {
    let messageElement = document.querySelector('.mess-info');
    if (messageElement) {
        messageElement.classList.add('fade-out');
    }
}, 3000); //  3 secondi
// ------------------------------------------/FAR COMPARIRE PER 4 SECONDI MESSAGGIO SESSIONE------------------------------
