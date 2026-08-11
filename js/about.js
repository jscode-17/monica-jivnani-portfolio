document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       SCROLL REVEAL
    ===================================================== */

    const reveals = document.querySelectorAll(
        ".reveal"
    );

    const revealObserver = new IntersectionObserver(
        function (entries) {

            entries.forEach(function (entry) {

                if (entry.isIntersecting) {

                    entry.target.classList.add("show");

                    revealObserver.unobserve(
                        entry.target
                    );
                }

            });

        },
        {
            threshold: 0.12
        }
    );

    reveals.forEach(function (element) {
        revealObserver.observe(element);
    });


    /* =====================================================
       COUNTERS
    ===================================================== */

    const counters = document.querySelectorAll(
        ".counter"
    );

    const counterObserver =
        new IntersectionObserver(
            function (entries) {

                entries.forEach(function (entry) {

                    if (!entry.isIntersecting) {
                        return;
                    }

                    const counter = entry.target;

                    const target = Number(
                        counter.dataset.target
                    );

                    const duration = 1500;

                    const startTime =
                        performance.now();


                    function updateCounter(time) {

                        const progress =
                            Math.min(
                                (time - startTime) /
                                duration,
                                1
                            );


                        const eased =
                            1 -
                            Math.pow(
                                1 - progress,
                                3
                            );


                        const current =
                            Math.floor(
                                eased * target
                            );


                        counter.textContent =
                            current;


                        if (progress < 1) {

                            requestAnimationFrame(
                                updateCounter
                            );

                        } else {

                            counter.textContent =
                                target;

                        }

                    }


                    requestAnimationFrame(
                        updateCounter
                    );


                    counterObserver.unobserve(
                        counter
                    );

                });

            },
            {
                threshold: 0.4
            }
        );


    counters.forEach(function (counter) {

        counterObserver.observe(counter);

    });


    /* =====================================================
       TIMELINE ANIMATION
    ===================================================== */

    const timelineItems =
        document.querySelectorAll(
            ".mj-timeline-item, .timeline-item"
        );


    const timelineObserver =
        new IntersectionObserver(
            function (entries) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add(
                            "active"
                        );

                    }

                });

            },
            {
                threshold: 0.3
            }
        );


    timelineItems.forEach(function (item) {

        timelineObserver.observe(item);

    });


    /* =====================================================
       IMAGE PARALLAX
    ===================================================== */

    const image =
        document.querySelector(
            ".mj-about-image, .hero-photo img, .photo-card img"
        );


    if (image) {

        image.addEventListener(
            "mousemove",
            function (event) {

                const rect =
                    image.getBoundingClientRect();


                const x =
                    (event.clientX - rect.left) /
                    rect.width - 0.5;


                const y =
                    (event.clientY - rect.top) /
                    rect.height - 0.5;


                image.style.transform =
                    "perspective(900px) " +
                    "rotateY(" +
                    (x * 4) +
                    "deg) " +
                    "rotateX(" +
                    (-y * 4) +
                    "deg) " +
                    "scale(1.02)";

            }
        );


        image.addEventListener(
            "mouseleave",
            function () {

                image.style.transform =
                    "perspective(900px) " +
                    "rotateY(0deg) " +
                    "rotateX(0deg) " +
                    "scale(1)";

            }
        );

    }


    /* =====================================================
       HERO GLOW
    ===================================================== */

    const glow =
        document.querySelector(
            ".mj-about-glow, .hero-orbit"
        );


    const hero =
        document.querySelector(
            ".mj-about-hero, .about-hero"
        );


    if (glow && hero) {

        hero.addEventListener(
            "mousemove",
            function (event) {

                const rect =
                    hero.getBoundingClientRect();


                const x =
                    event.clientX - rect.left;


                const y =
                    event.clientY - rect.top;


                glow.style.left =
                    (x - 200) + "px";


                glow.style.top =
                    (y - 200) + "px";

            }
        );

    }


    /* =====================================================
       INTRO MOUSE GLOW
    ===================================================== */

    const intro =
        document.querySelector(
            ".mj-intro"
        );


    if (intro) {

        intro.addEventListener(
            "mousemove",
            function (event) {

                const rect =
                    intro.getBoundingClientRect();


                const x =
                    event.clientX - rect.left;


                const y =
                    event.clientY - rect.top;


                intro.style.setProperty(
                    "--mouse-x",
                    x + "px"
                );


                intro.style.setProperty(
                    "--mouse-y",
                    y + "px"
                );

            }
        );

    }


    /* =====================================================
       SMOOTH ANCHOR SCROLL
    ===================================================== */

    document.querySelectorAll(
        'a[href^="#"]'
    ).forEach(function (link) {

        link.addEventListener(
            "click",
            function (event) {

                const targetId =
                    this.getAttribute("href");


                if (
                    targetId &&
                    targetId !== "#"
                ) {

                    const target =
                        document.querySelector(
                            targetId
                        );


                    if (target) {

                        event.preventDefault();

                        target.scrollIntoView({
                            behavior: "smooth",
                            block: "start"
                        });

                    }

                }

            }
        );

    });

});