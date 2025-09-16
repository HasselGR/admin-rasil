// Laravel Admin-Rasil JavaScript
console.log('Admin-Rasil Hotel Management System loaded');

// Bootstrap Laravel app
document.addEventListener('DOMContentLoaded', function() {
    // Initialize any admin-specific functionality
    console.log('Hotel Rasil admin panel ready');
    
    // Add any custom JavaScript for the hotel management system
    if (typeof window.Laravel === 'undefined') {
        window.Laravel = {};
    }
    
    // Set CSRF token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        window.Laravel.csrfToken = csrfToken.getAttribute('content');
        
        // Set up axios defaults if axios is available
        if (typeof axios !== 'undefined') {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
        }
        
        // Set up jQuery AJAX defaults if jQuery is available
        if (typeof $ !== 'undefined') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                }
            });
        }
    }
    
    // Initialize DataTables if available
    if (typeof $.fn.DataTable !== 'undefined') {
        $('.data-table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
    }
});