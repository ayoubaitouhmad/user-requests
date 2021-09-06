( () => {
        // close modal => current modal
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
        $('.navbar-toggler span').on('click', function () {
            let $this = $(this);
            $this.text() === 'switch_right' ? $this.text('switch_left') : $this.text('switch_right');

        });


        //
         $(document).on('mouseenter mouseleave', '.sidebar .nav-item', function (ev) {
        var body = $('body');
        var sidebarIconOnly = body.hasClass("sidebar-icon-only");
        var sidebarFixed = body.hasClass("sidebar-fixed");
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

})();
