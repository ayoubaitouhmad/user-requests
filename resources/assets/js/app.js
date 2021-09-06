// dependency
require('jquery');
require('bootstrap/dist/js/bootstrap');
$('.dropdown-toggle').dropdown();

// jquery plugins
require('parsleyjs/dist/parsley');
require('datatables.net/js/jquery.dataTables');
require('chart.js/dist/chart');


// plugins
require('axios')

// functions
require('../js/functions/function');



// custom js file
require('../../assets/js/globals');
require('../../assets/js/globals/lazy-load');
require('../../assets/js/globals/ajax-requests');
require('../../assets/js/globals/sb-admin');
require('../../assets/js/admin/init');



// pages :

// users
require('./admin/users/datatable');
require('./admin/users/page');
require('./admin/users/ajax-requests');
require('./admin/users/charts');


// requests

require('./admin/requests/chart');
require('./admin/requests/datatable');
require('./admin/requests/parsley');
require('./admin/requests/page');
require('./admin/requests/ajax-requests');





// login
require('./admin/login/ajax-requests');