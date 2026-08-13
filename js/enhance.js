// Enhancements — role rotator + facts strip reveal
// Loads after the theme's own scripts (plugins.js, main.js, contact-modal.js)

document.addEventListener('DOMContentLoaded', function () {

    /* rotating role word */
    var list = document.querySelector('.ce-rotator-list');
    if (list) {
        var items = list.children.length;
        var i = 0;
        setInterval(function () {
            i = (i + 1) % items;
            list.style.transition = 'transform .6s cubic-bezier(0.28,0.12,0.22,1)';
            list.style.transform = 'translateY(-' + i + 'em)';
        }, 2400);
    }

    /* reveal facts strip on scroll into view */
    var facts = document.querySelector('.ce-facts');
    if (facts && 'IntersectionObserver' in window) {
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    facts.classList.add('ce-in');
                    obs.unobserve(facts);
                }
            });
        }, { threshold: 0.3 });
        obs.observe(facts);
    } else if (facts) {
        facts.classList.add('ce-in'); // fallback
    }

    /* cursor glow follows mouse within the intro section */
    var introSection = document.querySelector('.s-intro');
    var glow = document.getElementById('ceGlow');
    if (introSection && glow) {
        introSection.addEventListener('mousemove', function (e) {
            var rect = introSection.getBoundingClientRect();
            glow.style.left = (e.clientX - rect.left) + 'px';
            glow.style.top = (e.clientY - rect.top) + 'px';
        });
        introSection.addEventListener('mouseleave', function () {
            glow.style.left = '-9999px';
            glow.style.top = '-9999px';
        });
    }

    /* photo tilts toward the cursor */
    var photoWrap = document.querySelector('.s-intro__content-media');
    var photoInner = document.querySelector('.s-intro__content-media-inner');
    if (photoWrap && photoInner) {
        photoWrap.addEventListener('mousemove', function (e) {
            var rect = photoWrap.getBoundingClientRect();
            var x = (e.clientX - rect.left) / rect.width - 0.5;
            var y = (e.clientY - rect.top) / rect.height - 0.5;
            photoInner.style.transform =
                'rotateY(' + (x * 9) + 'deg) rotateX(' + (-y * 9) + 'deg)';
        });
        photoWrap.addEventListener('mouseleave', function () {
            photoInner.style.transform = 'rotateY(0) rotateX(0)';
        });
    }

    /* magnetic nudge on the header "Connect With Me" button */
    var magnetBtn = document.querySelector('.s-header__contact-btn');
    if (magnetBtn) {
        magnetBtn.addEventListener('mousemove', function (e) {
            var r = magnetBtn.getBoundingClientRect();
            var x = e.clientX - r.left - r.width / 2;
            var y = e.clientY - r.top - r.height / 2;
            magnetBtn.style.transform = 'translate(' + (x * 0.25) + 'px,' + (y * 0.35) + 'px)';
        });
        magnetBtn.addEventListener('mouseleave', function () {
            magnetBtn.style.transform = 'translate(0,0)';
        });
    }

    /* hero "Get in Touch" button opens the same contact modal
       as the header button, without touching contact-modal.js */
    var heroContactBtn = document.getElementById('heroContactBtn');
    var contactModal = document.getElementById('contactModal');
    if (heroContactBtn && contactModal) {
        heroContactBtn.addEventListener('click', function () {
            contactModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    }

});
/* =========================================================
   EXPERTISE CARD INTERACTION
========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    const expertiseCards =
        document.querySelectorAll(".expertise-card");


    expertiseCards.forEach(function (card) {

        card.addEventListener("mousemove", function (e) {

            const rect =
                card.getBoundingClientRect();

            const x =
                e.clientX - rect.left;

            const y =
                e.clientY - rect.top;

            const centerX =
                rect.width / 2;

            const centerY =
                rect.height / 2;

            const rotateX =
                ((y - centerY) / centerY) * -2;

            const rotateY =
                ((x - centerX) / centerX) * 2;


            card.style.transform =
                `translateY(-10px)
                 perspective(1000px)
                 rotateX(${rotateX}deg)
                 rotateY(${rotateY}deg)`;

        });


        card.addEventListener("mouseleave", function () {

            card.style.transform = "";

        });

    });


    /* =====================================================
       SCROLL REVEAL
    ===================================================== */

    const revealItems =
        document.querySelectorAll(
            ".expertise-card, .expertise-modern__intro, .expertise-mission"
        );


    const revealObserver =
        new IntersectionObserver(
            function (entries) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add(
                            "expertise-visible"
                        );

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


    revealItems.forEach(function (item) {

        revealObserver.observe(item);

    });

});
/* =========================================================
   PREMIUM CLIENT FILTER
========================================================= */

document.addEventListener("DOMContentLoaded", function () {

    const filters =
        document.querySelectorAll(".clients-filter");

    const cards =
        document.querySelectorAll(".client-premium-card");


    filters.forEach(function (filter) {

        filter.addEventListener("click", function () {

            const selected =
                this.getAttribute("data-filter");


            /* Active button */

            filters.forEach(function (item) {

                item.classList.remove("active");

            });

            this.classList.add("active");


            /* Filter cards */

            cards.forEach(function (card) {

                const category =
                    card.getAttribute("data-category");


                if (
                    selected === "all" ||
                    category === selected
                ) {

                    card.classList.remove("is-hidden");

                    card.style.animation =
                        "clientCardIn .5s ease both";

                } else {

                    card.classList.add("is-hidden");

                }

            });

        });

    });

});
/* =========================================================
   CLIENT CARD ANIMATION
========================================================= */

const clientAnimationStyle =
    document.createElement("style");

clientAnimationStyle.textContent = `
    @keyframes clientCardIn {

        from {
            opacity: 0;
            transform: translateY(18px) scale(.97);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

    }
`;

document.head.appendChild(clientAnimationStyle);

/* BOOKS PREMIUM INTERACTIONS */
document.addEventListener('DOMContentLoaded',function(){
 var stage=document.querySelector('.books-ai-stage'),books=document.querySelector('.books-ai-books');
 if(stage&&books&&window.matchMedia('(min-width:901px)').matches){
  stage.addEventListener('mousemove',function(e){var r=stage.getBoundingClientRect(),x=(e.clientX-r.left)/r.width-.5,y=(e.clientY-r.top)/r.height-.5;books.style.transform='translate('+x*14+'px,'+y*-10+'px) rotateY('+(x*5)+'deg) rotateX('+(y*-3)+'deg)';});
  stage.addEventListener('mouseleave',function(){books.style.transform='';});
 }
});
