(function () {
    window.func = {
        acceptedImageFormat : [
            'tiff',
            'tif',
            'bmp',
            'jpg',
            'jpeg',
            'webp',
            'png'
        ],
        acceptedImageSize : 2,
        isFile(fileEl) {
            if (fileEl.is('input[type="file"]') && Reflect.has(fileEl[0], 'files') && fileEl[0].files[0] != null) {
                return true;
            } else {
                return false;
            }
        },
        getFileSize(fileEl) {
            if (fileEl && this.isFile(fileEl)) {
                return fileEl[0].files[0].size ? (fileEl[0].files[0].size / 1024 / 1024).toFixed(2) : false;
            } else
                return false;
        },
        getFileSize(fileEl, fractionD) {
            if (fileEl && this.isFile(fileEl)) {
                return fileEl[0].files[0].size ? (fileEl[0].files[0].size / 1024 / 1024).toFixed(fractionD) : false;
            } else
                return false;
        },
        getFileName(fileEl) {
            if (fileEl && this.isFile(fileEl)) {
                return (fileEl.val().split("\\").pop()).split('.').slice(0, -1).join('.');
            } else
                return false;

        },
        getFileNameExt(fileEl) {
            if (fileEl && this.isFile(fileEl)) {
                return fileEl.val().split("\\");
            } else
                return false;
        }
        ,
        getFileExt(fileEl) {
            if (fileEl && this.isFile(fileEl)) {
                return (fileEl.val().split('.').pop()).toString().toLowerCase();
            } else
                return false;

        },
        getFileNameFromString(path) {
            return path.includes('/') ? path.substring(path.lastIndexOf('/') + 1, path.length) : false;
        },
        isValidImageExt(ext){
            return this.acceptedImageFormat.includes(ext);
        },
        isValidImageSize(size){
            return size <= this.acceptedImageSize;
        },
        isValidImage(ext , size){
            return this.isValidImageSize(size) && this.isValidImageExt(ext);
        },
        setClass(element, className, unwantedClassName) {
            if (element.hasClass(unwantedClassName)) {
                element.removeClass(unwantedClassName);
            }
            if (!element.hasClass(className)) {
                element.addClass(className);
            }
        },
        getSelectFirstOpt(element){
            if(element && element != ""){
                return  element.children().length > 0 ?  element.children()[0].text : false;
            }

        },
        isOptionValid(element, option) {
            if (element) {
                return element.find(`option[value='${option}']`).length === 0;
            }
        },
        setValidOption(element , option){
            if(this.isOptionValid(element , option)){
                element.val(option);
            }
           else{
                element.val(this.getSelectFirstOpt(element)).change();
            }
           return element;
        },
        preventScrolling(){
            let scrollY = window.scrollY;
            let scrollX = window.scrollX;
            window.onscroll = () => window.scrollTo(scrollX, scrollY);
        },
        resetScrolling(){
            window.onscroll = () => {};
        },
        reloadPageContent($url){
            setTimeout(function () {
                $('body').load($url);
                $('[data-toggle="minimize"]').click();
            }, 2000);
        },
        refreshPage(){
            $('body').load('/page/refresh');

        },
        lazy(){
            if ('IntersectionObserver' in window) {
                const targets = document.querySelectorAll("img");
                const lazyLoad = (target) => {
                    const io = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const img = entry.target;
                                const src = img.getAttribute("data-src");

                                img.setAttribute("src", src);
                                img.classList.add("lazy-load");
                                observer.disconnect();
                            }
                        })
                    }, {threshold: [0.7]});

                    io.observe(target);
                }
                targets.forEach(lazyLoad);

            } else {
                $('targets').each(function (){
                    $this = $(this);
                    $this.attr('src' , $this.attr('data-src'));
                });
            }
        }
    };




})();

