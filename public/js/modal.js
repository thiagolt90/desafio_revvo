document.addEventListener('DOMContentLoaded', function () {
    if (localStorage.getItem('welcomeModalShown') === '1') {
        return;
    }

    var modalEl = document.getElementById('welcomeModal');
    if (!modalEl || typeof bootstrap === 'undefined') return;

    var modal = new bootstrap.Modal(modalEl);
    modal.show();

    localStorage.setItem('welcomeModalShown', '1');
});