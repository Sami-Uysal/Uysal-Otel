document.addEventListener('DOMContentLoaded', function () {
    var kayitForm = document.querySelector('#kayitModal form');
    var girisForm = document.querySelector('#girisModal form');

    kayitForm.addEventListener('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(kayitForm);

        fetch('../Project/php/kayit.php', {
            method: 'POST',
            body: formData
        })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            alert(data);
            document.getElementById('kayitModal').style.display = 'none';
            window.location.reload();
        })
        .catch(function (error) {
            console.error('Hata:', error);
        });
    });

    girisForm.addEventListener('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(girisForm);

        fetch('../Project/php/giris.php', {
            method: 'POST',
            body: formData
        })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            alert(data);
            document.getElementById('girisModal').style.display = 'none';
            window.location.reload();
        })
        .catch(function (error) {
            console.error('Hata:', error);
        });
    });
});
