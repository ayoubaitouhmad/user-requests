(()=>{
    "use strict";
    function validImage() {
        let $this = $('.custom-file-input');
        let fileSize = func.getFileSize($this);
        let fileFormat = func.getFileExt($this);
        return func.isValidImage(fileFormat, fileSize);
    }

    // parsley custom validator for image size
    window.Parsley.addValidator('checkImage', {
        validateString: function (value, maxSize, parsleyInstance) {
            return validImage();
        },
        messages: {
            en: 'sorry , image only accepted and its should be 2mb or less , try to increase image size.',
            fr: ''
        }
    });




})();