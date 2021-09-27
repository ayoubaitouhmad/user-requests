(() => {
    "use strict";
    window.app.admin.users.page = function () {
        "use strict"; // Start of use strict
        // modals
        let addUserModalEl = $('#save-user-modal');
        let addUserFormEl = addUserModalEl.find('#user-save-form');
        // global var for => isUploadedImageValid
        const acceptedImageFormat = [
            'tiff',
            'tif',
            'bmp',
            'jpg',
            'jpeg',
            'webp',
            'png'
        ];
        const acceptedImageSize = 2;//2mb
        //global var for => custom inputs
        const inputs = $('.custom-form__control');
        let updateFormEl = $('#user-up-form');


        $('#btn-add-user').on('click' , function () {
            addUserModalEl.modal('show');
        })

        $('#submit-user-save-form').on('click', function () {

            $('#user-save-form').submit();
        });


        // change field style when its validate
        window.Parsley.on('parsley:field:success', function (parsleyField) {
            let currentInputEl = $(parsleyField.element);
            currentInputEl.siblings('.parsley-errors-list').hide();
        });

        // change field style when its has error
        window.Parsley.on('field:error', function (parsleyField) {
            let currentInputEl = $(parsleyField.element);
            currentInputEl.siblings('.parsley-errors-list').show();
            if (currentInputEl.is('.control-file__origin')) {
                var x = currentInputEl.parent().parent().siblings('.errors');
                var errors = currentInputEl.siblings('.parsley-errors-list');
                errors.appendTo(x);

            }

        });


        // check if uploaded image valid
        /*
            * check size
            * check image format
            * return different errors message
         */
        function isUploadedImageValid() {

            let inputFileEl = $('.control-file__origin')
            let _fileName = func.getFileName(inputFileEl);
            let _fileExt = func.getFileExt(inputFileEl);
            let _fileSize = func.getFileSize(inputFileEl);
            if (acceptedImageFormat.includes(_fileExt)) {
                return _fileSize <= acceptedImageSize;
            } else {
              return  false;
            }

        }

        // parsley custom validator for image size
        window.Parsley.addValidator('check', {
            validateString: function (value, maxSize, parsleyInstance) {
                let res = isUploadedImageValid();
                return res.valid;
            },
            messages: {
                en: 'sorry , image only accepted and its should be 2mb or less , try to increase image size.',
                fr: ''
            }
        });


        // custom inputs
        /*
                * move placeholder top of input
                * increase font size
        */
        inputs.on('change focus focusout keyup copy paste cut', function (event) {



            let el = $(event.target);
            if (el && el.is('input') || el.is('select') && el.val() != null) {
                let length = el.val().length;
                let move = el.siblings('.custom-control__label').children('.custom-control__label-placeholder');
                if (length > 0) {
                    move.css({
                        'transform': 'translateY(-120%)',
                        'font-size': '0.74rem'
                    });
                } else {
                    move.css({
                        'transform': 'translateY(0%)',
                        'font-size': '0.875rem'
                    });
                }
            }

        });
        inputs.on('click', function (event) {
            $(event.target).siblings('.custom-control__label').children('.custom-control__label-placeholder')
                .css({
                    'transform': 'translateY(-120%)',
                    'font-size': '0.74rem'
                });
        });


        // custom file input with checkbox
        /* We give user chose if he want to add  new photo or not
                * if yes
                    + make the file input required
                    + enable file input
                    + make input file active (style)
                * else
                    + make input file optional
                    * disabled file input
                    * make input file inactive (style)
                    * clear input file value
                    * remove the error message if shows
        */
        $('#dfdsfdd').on('change', function () {
            let inputCheckboxEl = $(this);
            let inputFileEl = inputCheckboxEl.parent().siblings('.custom-form__control-file').children('.control-file__origin');
            let inputFileContainer = inputFileEl.parent();
            let errorsContainer = $(this).parent().parent().siblings('.errors').children('.parsley-errors-list');
            if (inputCheckboxEl[0].checked) {
                inputFileEl.removeAttr('disabled');
                inputFileEl.attr('required', 'true');
                func.setClass(inputFileContainer, 'active-file', 'inactive-file');
                errorsContainer.show();

            } else {
                inputFileEl.attr('disabled', 'true');
                inputFileEl.removeAttr('required');
                func.setClass(inputFileContainer, 'inactive-file', 'active-file');
                inputFileEl
                    .siblings('.control-file__value-container')
                    .html('new image');

                errorsContainer.hide();

            }

        });


        // get file name
        /* if user select photo has long name
                * take just 30 character
         */
        $('#control-file__origin').on('change', function () {

            let path = func.getFileName($(this));
            if (path.toString().length > 10) {
                path = path.toString().substring(0, 5);
            }
            $(this).siblings('.control-file__value-container').html(path);
            $('#user-up-form').parsley().refresh();
            $('#user-save-form')[0].reset();


        });


        $('#update-user').on('hide.bs.modal', function (e) {
            $('#user-up-form')[0].reset();
            $('#user-up-form').parsley().reset();
            $('input[type="checkbox"]').removeAttr('checked').change();
            $('.modal-content__messages').addClass('d-none');

        })



        // when window loaded
        window.onload = () => {
            $('input[type="checkbox"]').removeAttr('checked');
        }
        var id;
        $('.ico-delete').on('click', function (e) {
            id = $(this).closest('tr').attr('row-id');
            $('#confirm').find('input[type="hidden"]').val(id)
            $('#confirm').modal('show');

        });





    };
})();