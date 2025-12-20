import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // Mobile nav toggle
    const navToggle = document.getElementById('navToggle');
    const navMobile = document.getElementById('navMobile');

    if (navToggle && navMobile) {
        navToggle.addEventListener('click', () => {
            const isOpen = navMobile.classList.contains('open');
            if (isOpen) {
                navMobile.classList.remove('open');
                navMobile.classList.add('closed');
            } else {
                navMobile.classList.remove('closed');
                navMobile.classList.add('open');
            }
        });
    }

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
            if (navMobile && navMobile.classList.contains('open')) {
                navMobile.classList.remove('open');
                navMobile.classList.add('closed');
            }
        });
    });

    // Hero background slider
    const heroImages = [
        'https://images.unsplash.com/photo-1482192596544-9eb780fc7f66?w=1600&h=600&fit=crop',
        'https://images.unsplash.com/photo-1516483638261-f4dbaf036963?w=1600&h=600&fit=crop',
        'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1600&h=600&fit=crop'
    ];

    const heroBg = document.getElementById('heroBg');
    const pagination = document.getElementById('heroBgPagination');
    const prevBtn = document.querySelector('.hero-bg-prev');
    const nextBtn = document.querySelector('.hero-bg-next');

    let currentHeroIndex = 0;
    let heroInterval = null;

    function renderPagination() {
        if (!pagination) return;
        pagination.innerHTML = '';
        heroImages.forEach((_, idx) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.className =
                'w-2.5 h-2.5 rounded-full mx-1 border border-white/60 transition ' +
                (idx === currentHeroIndex ? 'bg-white' : 'bg-white/10');
            dot.addEventListener('click', () => {
                currentHeroIndex = idx;
                setHeroBg(false);
                resetHeroInterval();
            });
            pagination.appendChild(dot);
        });
    }

    function setHeroBg(firstLoad = false) {
        if (!heroBg) return;

        if (firstLoad) {
            heroBg.style.backgroundImage = `url('${heroImages[currentHeroIndex]}')`;
            heroBg.classList.remove('opacity-0');
            heroBg.classList.add('opacity-100');
            renderPagination();
            return;
        }

        heroBg.classList.remove('opacity-100');
        heroBg.classList.add('opacity-0');

        setTimeout(() => {
            heroBg.style.backgroundImage = `url('${heroImages[currentHeroIndex]}')`;
            heroBg.classList.remove('opacity-0');
            heroBg.classList.add('opacity-100');
            renderPagination();
        }, 400);
    }

    function nextHero() {
        currentHeroIndex = (currentHeroIndex + 1) % heroImages.length;
        setHeroBg(false);
    }

    function prevHero() {
        currentHeroIndex = (currentHeroIndex - 1 + heroImages.length) % heroImages.length;
        setHeroBg(false);
    }

    function startHeroInterval() {
        if (heroInterval) clearInterval(heroInterval);
        heroInterval = setInterval(nextHero, 5000);
    }

    function resetHeroInterval() {
        startHeroInterval();
    }

    if (heroBg && heroImages.length > 0) {
        setHeroBg(true);
        startHeroInterval();

        if (nextBtn) nextBtn.addEventListener('click', () => {
            nextHero();
            resetHeroInterval();
        });

        if (prevBtn) prevBtn.addEventListener('click', () => {
            prevHero();
            resetHeroInterval();
        });
    }

    // Inisialisasi AOS (tetap dari CDN)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 600,
            once: true,
            offset: 120,
            easing: 'ease-out-cubic',
        });
    }
});