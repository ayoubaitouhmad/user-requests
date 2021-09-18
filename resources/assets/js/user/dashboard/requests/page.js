(()=>{
    'use strict';
    window.app.user.dashboard.page = () =>  {
        // open modal to read full requests message
        $('.requests-list__read-request_btn').on('click', function () {
            let modalEl = $('.modal-request__message');
            let $this = $(this);
            let requestMessageContainerEl = $this.siblings('input[type="hidden"]');
            let modalTextAreEl = modalEl.find('textarea');
            modalEl.modal('show');
            modalTextAreEl.val(requestMessageContainerEl.val());
        });


        // open modal (add new request)
        $('.header__add-request').on('click', function () {
            $('.modal-request__new-request').modal('show');
        })
            // $('.modal-request__new-request').modal('show');



    };
})();