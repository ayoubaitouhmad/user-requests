(function () {
    "use strict";
    window.app.admin.requests.page = () => {
        // variable global
        const modals = $('.modal');
        const form = $('#handle-user-request');


        $(document).click(function(){
            $('.cell-menu__submenu').addClass('d-none');
        });

        // modals.modal('show');
        $(".cell-menu__ico").on('click' , function () {
            $('.cell-menu__submenu').addClass('d-none');
            let $this = $(this);
            let cellMenuSubmenuEl = $this.siblings('.cell-menu__submenu');
            cellMenuSubmenuEl.removeClass('d-none').addClass('active');
        });




         // open modal to read full requests message
        $('.read-more').on('click', function () {
            let modalEl = $('.modal-request__message');
            let $this = $(this);
            let requestMessageContainerEl = $this.siblings('input[type="hidden"]');
            let modalTextAreEl = modalEl.find('textarea');
            modalEl.modal('show');
            modalTextAreEl.val(requestMessageContainerEl.val());
        });

         // prevent scroll when modal is open
        modals.on('show.bs.modal', function () {
          func.preventScrolling();
        });

         // password onscroll to default
        modals.on('hide.bs.modal', function () {
            func.resetScrolling();
            $('select').get(0).selectedIndex = 1;
            $('textarea').val('');

        });





        // get request all data
        $(document.body).on('click', '.dropdown-menu__check-request', function (e) {
            let $this = $(this);
            let thisParent = $this.closest('tr');
            let modalEl = $('.modal-requests__full-data');
            modalEl.modal('show');



            $("#encContainer").val(thisParent.attr('row-id'));
            console.log( $("#encContainer").val())
            // get the data stored in hidden input in current line
            let fullNameContainerEl = thisParent.find('.requests-list__user-name__hide');
            let dateContainerEl = thisParent.find('.requests-list__date__hide');
            let typeContainerEl = thisParent.find('.requests-list__type__hide');
            let reasonContainerEl = thisParent.find('.requests-list__reason__hide');
            let statusContainerEl = thisParent.find('.requests-list__status__hide');
            let responseContainerEl = thisParent.find('input.requests-list__response__hide');

            // get the fields inside the modal
            // using find to tell jq to search inside modal not all the dom
            let fullNameDestinationEl = modalEl.find('.data-body__user-name');
            let dateDestinationEl = modalEl.find('.data-body__request-date');
            let typeDestinationEl = modalEl.find('.data-body__request-type');
            let reasonDestinationEl = modalEl.find('.data-body__request-reason');
            let statusDestinationEl = modalEl.find('.data-body__request-status');
            let responseDestinationEl = modalEl.find('.data-body__request-response');

            // fill the fields
            fullNameDestinationEl.text(fullNameContainerEl.val());
            dateDestinationEl.text(dateContainerEl.val());
            reasonDestinationEl.text(reasonContainerEl.val());
            typeDestinationEl.text(typeContainerEl.val());
            responseDestinationEl.val(responseContainerEl.val());
            statusDestinationEl.val(statusContainerEl.val());


        });


        // delete request
        $('.dropdown-menu__delete-request').on('click', function () {

        });

        // submit button exist out side form , so when btn clicked this func call submit event and handle it in ajax requests file
        $('#modal-btn__save').on('click', function (e) {
            form.submit();
        });











    };
})();


