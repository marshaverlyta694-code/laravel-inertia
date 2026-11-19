<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Tulis" />

    <main class="landing-shell">
        <header class="site-header">
            <Link href="/" class="brand" aria-label="Tulis, beranda">
                <span class="brand-mark" aria-hidden="true">t</span>
                <span>tulis<span class="brand-period">.</span></span>
            </Link>

            <nav class="site-nav" aria-label="Navigasi utama">
                <template v-if="$page.props.auth?.user">
                    <Link :href="route('dashboard')" class="nav-login">Dashboard</Link>
                </template>
                <template v-else>
                    <Link v-if="canLogin" :href="route('login')" class="nav-login">
                        Masuk
                    </Link>
                    <Link v-if="canRegister" :href="route('register')" class="nav-join">
                        Daftar <span aria-hidden="true">→</span>
                    </Link>
                </template>
            </nav>
        </header>

        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-copy">
                <p class="eyebrow"><span class="eyebrow-line"></span> CERITA KECIL, HARI LEBIH BERARTI</p>
                <h1 id="hero-title">Ada banyak hal yang layak kamu <em>tulis.</em></h1>
                <p class="hero-description">
                    Tempat sederhana untuk menuangkan cerita, menyimpan ide, dan kembali kapan saja.
                </p>
                <div class="hero-actions">
                    <Link
                        v-if="$page.props.auth?.user"
                        :href="route('dashboard')"
                        class="primary-action"
                    >
                        Buka tulisanmu <span aria-hidden="true">→</span>
                    </Link>
                    <Link v-else-if="canRegister" :href="route('register')" class="primary-action">
                        Mulai menulis <span aria-hidden="true">→</span>
                    </Link>
                    <Link v-else-if="canLogin" :href="route('login')" class="primary-action">
                        Masuk untuk menulis <span aria-hidden="true">→</span>
                    </Link>
                </div>
                <div class="hero-note">
                    <span class="note-dot"></span>
                    Ide pertama tidak harus sempurna.
                </div>
            </div>

            <div class="hero-art" role="img" aria-label="Meja hangat dengan catatan dan secangkir minuman">
                <div class="art-shade"></div>
                <div class="quote-card">
                    <span class="quote-mark" aria-hidden="true">“</span>
                    <p>Hal sederhana hari ini, jadi cerita yang ingin kuingat.</p>
                    <span class="quote-caption">CATATAN HARI INI · 17:42</span>
                </div>
                <span class="art-index">IDE HARI INI, UNTUK NANTI</span>
            </div>
        </section>
    </main>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,500;1,600&display=swap');

:global(*) {
    box-sizing: border-box;
}

:global(body) {
    margin: 0;
    background: #fbf5f0;
    color: #342b2a;
    font-family: 'DM Sans', sans-serif;
}

.landing-shell {
    --ink: #342b2a;
    --muted: #796b68;
    --paper: #fbf5f0;
    --matcha: #dce8b3;
    --leaf: #4d6548;
    --berry: #b85062;
    --blush: #f8dce0;
    --line: #745a5528;
    height: 100vh;
    height: 100svh;
    padding: 0 6.2%;
    overflow: hidden;
    background-color: var(--paper);
    background-image:
        radial-gradient(#b8506212 0.7px, transparent 0.7px),
        radial-gradient(#4d65480d 0.7px, transparent 0.7px);
    background-position: 0 0, 4px 4px;
    background-size: 8px 8px;
}

.site-header {
    height: 82px;
    min-height: 82px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--line);
}

.brand {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: var(--ink);
    text-decoration: none;
    font-size: 17px;
    font-weight: 700;
    letter-spacing: 0;
}

.brand-mark {
    display: grid;
    width: 31px;
    height: 31px;
    place-items: center;
    border-radius: 50%;
    background: var(--blush);
    color: var(--berry);
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 16px;
    font-style: italic;
}

.brand-light {
    font-weight: 400;
}

.brand-period {
    color: var(--berry);
}

.site-nav {
    display: flex;
    align-items: center;
    gap: 24px;
    font-size: 12px;
    font-weight: 600;
}

.site-nav a {
    color: var(--ink);
    text-decoration: none;
}

.site-nav a:not(.nav-join):hover {
    color: var(--berry);
}

.site-nav .nav-join,
.primary-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    min-height: 44px;
    padding: 0 18px;
    background: var(--leaf);
    color: white;
    transition: background 160ms ease, transform 160ms ease;
}

.site-nav .nav-join:hover,
.primary-action:hover {
    transform: translateY(-2px);
    background: #394d37;
}

.nav-join span,
.primary-action span {
    color: var(--matcha);
    font-size: 17px;
}

.hero {
    display: grid;
    grid-template-columns: minmax(0, 0.95fr) minmax(390px, 1.05fr);
    gap: 7%;
    align-items: center;
    height: calc(100% - 82px);
    min-height: 0;
    padding: clamp(24px, 5vh, 58px) 0;
}

.hero-copy {
    max-width: 515px;
    padding: 16px 0;
    animation: reveal 650ms ease both;
}

.eyebrow,
.section-number,
.art-index,
.quote-caption,
.footer-year {
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 1.25px;
}

.eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 0 28px;
    color: #52615c;
}

.eyebrow-line {
    width: 24px;
    height: 2px;
    background: var(--berry);
}

h1,
h2,
.quote-card p {
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 500;
    letter-spacing: 0;
}

h1 {
    max-width: 510px;
    margin: 0;
    font-size: clamp(48px, 5.5vw, 76px);
    line-height: 1.06;
}

h1 em,
h2 em {
    color: var(--leaf);
    font-weight: 500;
}

.hero-description {
    max-width: 390px;
    margin: 24px 0 0;
    color: var(--muted);
    font-size: 14px;
    line-height: 1.8;
}

.hero-actions {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-top: 30px;
}

.primary-action {
    min-height: 50px;
    padding: 0 19px;
    color: white;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
}

.hero-note {
    display: flex;
    align-items: center;
    gap: 9px;
    margin-top: 46px;
    color: #887a75;
    font-size: 10px;
}

.note-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--matcha);
}

.hero-art {
    position: relative;
    height: min(58vh, 470px);
    min-height: 300px;
    background: #59615b url('https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=1400&q=85') center 53% / cover no-repeat;
    animation: reveal 700ms 100ms ease both;
}

.art-shade {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #10201d19, #10201d55);
}

.quote-card {
    position: absolute;
    right: -22px;
    bottom: 38px;
    width: min(270px, 70%);
    min-height: 155px;
    padding: 20px 22px;
    background: var(--blush);
    box-shadow: 0 14px 38px #59333924;
}

.quote-mark {
    display: block;
    height: 22px;
    color: var(--berry);
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 36px;
    line-height: 1;
}

.quote-card p {
    margin: 4px 0 17px;
    font-size: 20px;
    line-height: 1.25;
}

.quote-caption {
    color: #87525a;
    font-size: 8px;
}

.art-index {
    position: absolute;
    bottom: 16px;
    left: 18px;
    color: white;
    font-size: 8px;
}

@keyframes reveal {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 860px) {
    .landing-shell {
        padding: 0 5%;
    }

    .hero {
        grid-template-columns: minmax(0, 1fr) minmax(280px, 0.9fr);
        gap: 5%;
        padding: 28px 0;
    }

    .hero-art {
        height: min(54vh, 420px);
        min-height: 260px;
    }
}

@media (max-width: 600px) {
    .landing-shell {
        padding: 0 22px;
    }

    .site-header {
        height: 70px;
        min-height: 70px;
    }

    .site-nav {
        gap: 14px;
        font-size: 11px;
    }

    .site-nav .nav-join {
        min-height: 38px;
        padding: 0 12px;
    }

    .hero {
        height: calc(100% - 70px);
        grid-template-columns: minmax(0, 1fr);
        grid-template-rows: auto minmax(170px, 30vh);
        align-content: center;
        gap: 18px;
        padding: 18px 0;
    }

    .hero-copy {
        padding: 0;
    }

    .eyebrow {
        margin-bottom: 22px;
    }

    h1 {
        max-width: 430px;
        font-size: clamp(38px, 10vw, 50px);
    }

    .hero-description {
        max-width: 390px;
        margin-top: 14px;
        font-size: 12px;
        line-height: 1.6;
    }

    .hero-note {
        margin-top: 16px;
        font-size: 9px;
    }

    .hero-art {
        width: calc(100% - 12px);
        height: 100%;
        min-height: 0;
        margin-right: 12px;
    }

    .quote-card {
        right: -12px;
        bottom: 16px;
        width: min(235px, 75%);
        min-height: 130px;
        padding: 15px 17px;
    }
}

@media (max-height: 700px) and (max-width: 600px) {
    .hero {
        grid-template-rows: auto minmax(110px, 24vh);
        gap: 12px;
        padding: 12px 0;
    }

    h1 {
        font-size: 38px;
    }

    .hero-description {
        margin-top: 10px;
    }

    .hero-note {
        display: none;
    }

    .quote-card {
        bottom: 10px;
        min-height: 112px;
        padding: 12px 14px;
    }

    .quote-card p {
        margin-bottom: 10px;
        font-size: 17px;
    }
}

@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
