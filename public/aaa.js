document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('[data-confirm]');
    deleteLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            if (!confirm(link.getAttribute('data-confirm'))) {
                e.preventDefault();
            }
        });
    });

    const cards = document.querySelectorAll('.card');
    cards.forEach(function (card, index) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        setTimeout(function () {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 80);
    });

    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (alert) {
        alert.style.cursor = 'pointer';
        alert.addEventListener('click', function () {
            alert.style.opacity = '0';
            setTimeout(function () { alert.remove(); }, 300);
        });
    });
});
