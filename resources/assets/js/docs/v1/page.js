(() => {
    window.app.docs.v1.page = () => {

        $('.ico-menu').on('click' , function () {
            $('.settings-row__list-items').toggleClass('active')
        });

    };
})();