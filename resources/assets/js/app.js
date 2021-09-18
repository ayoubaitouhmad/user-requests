// dependency
require('jquery');
require('bootstrap/dist/js/bootstrap');

// js plugins plugins
require('axios')
require('pusher-js/dist/web/pusher.min');




// jquery plugins
require('parsleyjs/dist/parsley');
require('datatables.net/js/jquery.dataTables');
require('chart.js/dist/chart');
require('jquery.cookie/jquery.cookie');




// functions
require('../js/functions/function');


// main content
require('../../assets/js/globals');



// custom js file
require('../../assets/js/globals/plugins');
require('../../assets/js/globals/sb-admin');
require('../../assets/js/globals/lazy-load');
require('../../assets/js/globals/ajax-requests');
require('../../assets/js/globals/notify');


require('./init');



// pages :

/*******************       admin    *************************/
require('./admin/all');


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

/*******************       user    *************************/

// sign up
require('./user/signup/signup');
require('./user/signup/profile');
require('./user/signup/plugins');
require('./user/signin/signin');
require('./user/signin/plugins');
require('./user/signup/email');




// dashboard
// requests
require('./user/dashboard/requests/ajax-requests');
require('./user/dashboard/requests/page');
require('./user/dashboard/requests/charts');

require('./user/all');

