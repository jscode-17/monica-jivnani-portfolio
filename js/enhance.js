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
