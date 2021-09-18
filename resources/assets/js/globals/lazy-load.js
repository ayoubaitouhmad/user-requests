
(function (){
        if ('IntersectionObserver' in window) {
            const targets = document.querySelectorAll(".preload-img");
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


})();
