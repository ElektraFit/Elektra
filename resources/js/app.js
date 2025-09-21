import './bootstrap';

// Animate content on page load
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const content = document.getElementById('main-content');
        content.classList.remove('content-hide');
        content.classList.add('content-show');
            }, 300);
 });
