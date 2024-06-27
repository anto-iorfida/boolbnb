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

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function () {
            const apartmentId = this.getAttribute('data-apartment-id');
            const apartmentTitle = this.getAttribute('data-apartment-title');

            apartmentTitleElement.textContent = apartmentTitle;
            deleteForm.action = `/admin/apartments/${apartmentId}`;

            confirmDeleteModal.show();
        });
    });
});