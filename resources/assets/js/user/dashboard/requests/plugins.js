
(function (){
    "use strict";
    window.app.user.dashboard.requests.plugins = () => {
        $('#requests-list').DataTable({
            'responsive' : true,
            // "paging":   false,
            // "ordering": false,
            // "info":     false
        });
        $('#new-request__form').parsley();
    }
})();