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
        $('.navbar-menu-wrapper').addClass('hide-for-animition');
        $('body').toggleClass('sidebar-icon-only');
        setTimeout(() => {
            $('.navbar-menu-wrapper').removeClass('hide-for-animition')
        }, 1000);
    });

    // show side bar in mobile phone
    $('[data-toggle="offcanvas"]').on("click", function () {
        $('.sidebar-offcanvas').toggleClass('active')
    });


    // switch right navbar
    $('#navbar-toggler').on('click', function () {

        let $this = $(this);
        console.log('fdfd');
        $this.hasClass('toggle') ? $this.removeClass('toggle') : $this.addClass('toggle');

        console.log($('.navbar-menu-wrapper'));


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
        let shower = $this.closest('.image-shower').find('#image-preview');
        let labelEl =$this.closest('.image-shower').find('.custom-file-label');
        if(func.isValidImageExt(func.getFileExt($this))){
            shower.attr('src', URL.createObjectURL(e.target.files[0]));
            let fileName = func.getFileName($this);
            if (fileName.toString().length > 10) {
                fileName = fileName.toString().substring(0, 10);
            }
            labelEl.text(fileName);
        }else {
            shower.attr('src','/img/unknown.png');
            labelEl.text('');
            $this.val('');
        }
    });


    $('.modal').on('hide.bs.modal', function (e) {
        let $this = $(e.target);
        let form = $this.find('form');
        if (form.length > 0) form.get(0).reset();
        let labelEl = $this.find('.custom-file-label');
        if (labelEl.length > 0) labelEl.html('');

    })

    // toggle (show/hide) input password
    $('.password-container .toggle-password').on('click', function () {
        console.log('fdgfdg');
        let $this = $(this);
        let inputEl = $this.siblings('input');
        if (inputEl.prop('type') === 'text') {
            $this.text('visibility_off');
            inputEl.prop("type", "password");
        } else {
            inputEl.prop("type", "text");
            $this.text('visibility');
        }

    });

    // time show
    setInterval(() => {
        let date = new Date();
        let time = date.toLocaleString('en-us', {weekday: 'long'}) + ' ';
        time += date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
        $('.current-datetime').html(time);
    }, 1000)


    if ($('window').width() < 1000) {
        $('body').removeClass('sidebar-icon-only');
        $('.sidebar').removeClass('active');
    }



    // show button (save new avatar)
    $('.custom-file-uploader-input').on('change', function () {

        let $this = $(this);
        $this.closest('.profile-content__avatar').find('#save-user-avatar').addClass('active-btn');
        let imgShower = $this.closest('.custom-uploader').find('.custom-uploader__img');
        if (func.isValidImageExt(func.getFileExt($this))) {
            imgShower.attr('data-src', URL.createObjectURL($this.get(0).files[0]));
            func.lazy();
        }else {
            imgShower.attr('data-src','/img/unknown.png');
            func.lazy();
            $this.val('');
        console.log($this);
        }
    });



})();
