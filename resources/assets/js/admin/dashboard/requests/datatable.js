(function (){
    "use strict";
    window.app.admin.requests.datatable = () => {
        let dt = $('#requests-list').DataTable({
            // "paging":   false,
            // "ordering": false,
            "info":     true,
            "pageLength": 8,
            'responsive' : true,
            'scrollY': 564,
            'scrollX': 564,
            'select' : true,
            'scrollCollapse': true,
        });

    }
})();