        require('datatables.net/js/jquery.dataTables');
(function (){
    "use strict";
    window.app.user.dashboard.requests.plugins = () => {
        $('#requests-list').DataTable({
            // "paging":   false,
            // "ordering": false,
            // "info":     false
        });
    }
})();