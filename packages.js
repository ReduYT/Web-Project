document.addEventListener('DOMContentLoaded', () => {
    let buttons = Array.from(document.getElementsByClassName('btn'));
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            window.location.href = 'booking.html';
        });
    });
});