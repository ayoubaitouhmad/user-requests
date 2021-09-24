
(() => {
    'use strict';
    window.app.admin.test = () => {

      $('#click').on('click' , function () {
          window.axios.get('/test/fb', {

          })
              .then(function (response) {
                  console.log(response);
              })
              .catch(function (error) {
                  console.log(error);
              });
      });




    };
})();