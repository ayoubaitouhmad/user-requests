(() => {
    "use strict";


    $('.btn-close').on('click', function () {
        let $this = $(this);
        let modalEl = $this.closest('.modal');
        if (modalEl) {
            modalEl.modal('hide');
        }
    });

    // change sidebar : show only icons
    $('[data-toggle="minimize"]').on("click", function () {
        $('body').toggleClass('sidebar-icon-only');
    });

    // show side bar in mobile phone
    $('[data-toggle="offcanvas"]').on("click", function () {
        $('.sidebar-offcanvas').toggleClass('active')
    });


    // switch right navbar
    $('#navbar-toggler').on('click', function () {
        let $this = $(this);
        console.log('fdfd');
        $this.hasClass('toggle') ? $this.removeClass('toggle')  : $this.addClass('toggle');

    });



    $(document).on('mouseenter mouseleave', '.sidebar .nav-item', function (ev) {
        let body = $('body');
        let sidebarIconOnly = body.hasClass("sidebar-icon-only");
        let sidebarFixed = body.hasClass("sidebar-fixed");
        if (!('ontouchstart' in document.documentElement)) {
            if (sidebarIconOnly) {
                if (sidebarFixed) {
                    if (ev.type === 'mouseenter') {
                        body.removeClass('sidebar-icon-only');
                    }
                } else {
                    var $menuItem = $(this);
                    if (ev.type === 'mouseenter') {
                        $menuItem.addClass('hover-open')
                    } else {
                        $menuItem.removeClass('hover-open')
                    }
                }
            }
        }





    });


    // make user to see user he choose
    $('.custom-file-input').on('change', function (e) {

        let $this = $(this);
        let shower = $this.closest('.card').find('#card-image');
        shower.attr('src', URL.createObjectURL(e.target.files[0]));
        let labelEl = $this.siblings('.custom-file-label');
        let fileName = func.getFileName($this);
        if (fileName.toString().length > 10) {
            fileName = fileName.toString().substring(0, 10);
        }
        labelEl.text(fileName);
    });


    $('.modal').on('hide.bs.modal', function (e) {
        let $this = $(e.target);
        let form =  $this.find('form');
        if (form.length>0) form.get(0).reset();
        let labelEl = $this.find('.custom-file-label');
        if (labelEl.length>0)  labelEl.html('');

    })

    // toggle (show/hide) input password
    $('.password-container .toggle-password').on('click' , function () {
        console.log('fdgfdg');
        let $this = $(this);
        let inputEl = $this.siblings('input');
        if(inputEl.prop('type') === 'text') {
            $this.text('visibility_off');
            inputEl.prop("type", "password");
        }
        else {
            inputEl.prop("type", "text");
            $this.text('visibility');
        }

    });


})();
