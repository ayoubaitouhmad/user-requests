(() => {
    "use strict";
    window.app.admin.requests.parsleyJS = () => {
        const form = $('#handle-user-request');
        form.parsley();
    };
})();