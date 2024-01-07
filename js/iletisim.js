
document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('.contact-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(form);

        fetch('php/iletisimmail.php', {
            method: 'POST',
            body: formData
        })
        .then(function (response) {
                return response.text();
        })
        .then(function (data) {
            alert(data);
        })
        .catch(function (error) {
                console.error('Hata:', error);
        });
    });
});