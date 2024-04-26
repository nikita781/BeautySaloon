document.addEventListener("DOMContentLoaded", function() {
    var openButtons = document.querySelectorAll('.openDialog');

    openButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var modal = button.nextElementSibling;
            modal.style.display = 'flex';
        });
    });

    document.addEventListener('click', function(event) {
        var target = event.target;
        if (target.id === 'closeDialog') {
            var modal = target.parentElement.parentElement.parentElement;
            modal.style.display = 'none';
        }
    });
});