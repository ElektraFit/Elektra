// Dashboard view navigation
document.addEventListener('DOMContentLoaded', function() {
    function showView(viewName) {
        document.querySelectorAll('.content-view').forEach(view => {
            view.classList.remove('active');
        });
        
        const targetView = document.getElementById(viewName + '-view');
        if (targetView) {
            targetView.classList.add('active');
        }
        
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            link.classList.remove('active');
        });
        
        const activeLink = document.querySelector(`a[href*="${viewName}"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }
    
    function checkHash() {
        const hash = window.location.hash.substring(1);
        if (hash === 'instructors') {
            showView('instructors');
        } else {
            showView('dashboard');
        }
    }
    
    checkHash();
    window.addEventListener('hashchange', checkHash);
});
