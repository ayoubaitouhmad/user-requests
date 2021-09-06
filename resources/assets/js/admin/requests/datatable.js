(function (){
    "use strict";
    window.app.admin.requests.datatable = () => {
        $('#requests-list').DataTable({
            // "paging":   false,
            // "ordering": false,
            "info":     false
        });
    }
})();