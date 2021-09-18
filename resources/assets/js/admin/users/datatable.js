(function (){
    "use strict";
    window.app.admin.users.dataTable = function (){
        //generate data table from current html table
        $('#users-list').DataTable({
            "info":     false,
            "fixedColumns": {
                leftColumns: 1
            },
        });
        // frontend validator lib
        $('#user_form').parsley(); //adding frm
        $('#user-up-form').parsley(); // update form
        $('#user-save-form').parsley(); //adding frm

    };

})();