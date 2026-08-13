// Services page — accordion + scroll reveal
// Loads after the theme's own scripts (plugins.js, main.js, contact-modal.js)

document.addEventListener('DOMContentLoaded', function () {

    /* accordion: expertise list */
    var triggers = document.querySelectorAll('.mj-service-trigger');
    triggers.forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            var item = trigger.closest('.mj-service-item');
            if (!item) return;
            var content = item.querySelector('.mj-service-content');
            var isOpen = item.classList.contains('is-open');

            // close any other open item (accordion behaviour)
            document.querySelectorAll('.mj-service-item.is-open').forEach(function (openItem) {
                if (openItem !== item) {
                    openItem.classList.remove('is-open');
                    var openTrigger = openItem.querySelector('.mj-service-trigger');
                    var openContent = openItem.querySelector('.mj-service-content');
                    if (openTrigger) openTrigger.setAttribute('aria-expanded', 'false');
                    if (openContent) openContent.style.maxHeight = '';
                }
            });

            if (isOpen) {
                item.classList.remove('is-open');
                trigger.setAttribute('aria-expanded', 'false');
                if (content) content.style.maxHeight = '';
            } else {
                item.classList.add('is-open');
                trigger.setAttribute('aria-expanded', 'true');
                if (content) content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });

    /* scroll reveal for .mj-reveal / .mj-reveal-right */
    var revealEls = document.querySelectorAll('.mj-reveal, .mj-reveal-right');
    if (revealEls.length) {
        if ('IntersectionObserver' in window) {
            var revealObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

            revealEls.forEach(function (el) {
                revealObserver.observe(el);
            });
        } else {
            // no IntersectionObserver support — just show everything
            revealEls.forEach(function (el) {
                el.classList.add('is-visible');
            });
        }
    }

});

/* =========================================
   SERVICES ACCORDION
========================================= */

document.addEventListener("DOMContentLoaded", function () {

    const serviceItems = document.querySelectorAll(
        ".mj-service-item"
    );

    serviceItems.forEach(function (item) {

        const trigger = item.querySelector(
            ".mj-service-trigger"
        );

        const content = item.querySelector(
            ".mj-service-content"
        );

        const contentInner = item.querySelector(
            ".mj-service-content-inner"
        );

        if (!trigger || !content || !contentInner) {
            return;
        }


        trigger.addEventListener("click", function (event) {

            event.preventDefault();
            event.stopPropagation();


            const isCurrentlyOpen =
                item.classList.contains("is-active");


            /* =====================================
               CLOSE ALL SERVICES
            ===================================== */

            serviceItems.forEach(function (otherItem) {

                const otherTrigger =
                    otherItem.querySelector(
                        ".mj-service-trigger"
                    );

                const otherContent =
                    otherItem.querySelector(
                        ".mj-service-content"
                    );

                const otherInner =
                    otherItem.querySelector(
                        ".mj-service-content-inner"
                    );


                otherItem.classList.remove(
                    "is-active"
                );


                if (otherTrigger) {

                    otherTrigger.setAttribute(
                        "aria-expanded",
                        "false"
                    );

                }


                if (otherContent) {

                    otherContent.style.gridTemplateRows =
                        "0fr";

                }


                if (otherInner) {

                    otherInner.style.opacity = "0";

                    otherInner.style.transform =
                        "translateY(-12px)";

                }

            });


            /* =====================================
               OPEN CLICKED SERVICE
            ===================================== */

            if (!isCurrentlyOpen) {

                item.classList.add(
                    "is-active"
                );


                trigger.setAttribute(
                    "aria-expanded",
                    "true"
                );


                content.style.gridTemplateRows =
                    "1fr";


                contentInner.style.opacity =
                    "1";


                contentInner.style.transform =
                    "translateY(0)";

            }

        });

    });

});