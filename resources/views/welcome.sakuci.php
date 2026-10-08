@extends('layouts.app')

@section('title', config('app.name') . ' — Peminjaman Alat Sekolah')

@section('content')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Pasang tema sedini mungkin agar tidak berkedip -->
    <script>
        (function () {
            var theme = 'light';
            try {
                var saved = localStorage.getItem('sk-theme');
                if (saved === 'dark' || saved === 'light') {
                    theme = saved;
                } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    theme = 'dark';
                }
            } catch (e) {}
            document.documentElement.setAttribute('data-sk-theme', theme);
        })();
    </script>

    <style>
        /* ===== HAPUS JARAK BAWAAN LAYOUT APP AGAR BENAR-BENAR FULL SCREEN ===== */
        main.py-4, .container, .content-wrapper {
            padding: 0 !important;
            margin: 0 !important;
            max-width: 100% !important;
        }

        /* ===== TOKEN: TERANG (default) ===== */
        .sk-wrapper {
            --paper: #f6f8fd;
            --surface: #ffffff;
            --text: #17306b;
            --text-soft: #52618a;
            --line: #cdd9f3;
            --edge: #17306b;
            --band: #17306b;
            --band-text: #ffffff;
            --btn-bg: #17306b;
            --btn-text: #ffffff;
            --btn-hover: #0f2150;
            --btn-shadow: #ffc933;
            --chip: #e9efff;
            --pencil: #ffc933;
            --stamp: #d9352b;
            --icon-ink: #0f2150;
            --margin-line: rgba(217, 53, 43, 0.35);
            --tag-out-bg: #fff1c2;  --tag-out-tx: #7a5a00;
            --tag-back-bg: #d9f3e3; --tag-back-tx: #14683a;
            --tag-wait-bg: #e9efff; --tag-wait-tx: #17306b;
            --cta-bg: #ffc933;
            --cta-text: #0f2150;
            --cta-btn-shadow: #0f2150;
        }

        /* ===== TOKEN: GELAP ===== */
        html[data-sk-theme="dark"] .sk-wrapper {
            --paper: #0d1530;
            --surface: #16203f;
            --text: #e8edff;
            --text-soft: #a4b1d8;
            --line: #223058;
            --edge: #5d73b8;
            --band: #1d2b57;
            --band-text: #ffffff;
            --btn-bg: #ffc933;
            --btn-text: #0f2150;
            --btn-hover: #ffd966;
            --btn-shadow: #5d73b8;
            --chip: #22305e;
            --margin-line: rgba(255, 120, 110, 0.30);
            --tag-out-bg: #4a3b0a;  --tag-out-tx: #ffd966;
            --tag-back-bg: #123d28; --tag-back-tx: #8fe3b0;
            --tag-wait-bg: #22305e; --tag-wait-tx: #c9d6ff;
            --cta-bg: #ffc933;
            --cta-text: #0f2150;
            --cta-btn-shadow: #0f2150;
        }
        html[data-sk-theme="dark"] { color-scheme: dark; }

        body { overflow-x: hidden; margin: 0; }
        
        .sk-wrapper {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            font-family: 'Nunito Sans', system-ui, sans-serif;
            color: var(--text);
            background: var(--paper);
            transition: background-color 0.25s ease, color 0.25s ease;
        }
        .sk-wrapper * { box-sizing: border-box; }
        .sk-wrapper h1, .sk-wrapper h2, .sk-wrapper h3 { font-family: 'Bricolage Grotesque', sans-serif; }

        /* Latar buku tulis: garis + garis margin */
        .notebook {
            --m: calc(clamp(1.5rem, 6vw, 6rem) - 1.4rem);
            background-color: var(--paper);
            background-image:
                linear-gradient(90deg, transparent 0, transparent var(--m), var(--margin-line) var(--m), var(--margin-line) calc(var(--m) + 2px), transparent calc(var(--m) + 2px)),
                repeating-linear-gradient(to bottom, transparent 0, transparent 35px, var(--line) 35px, var(--line) 36px);
        }

        /* ===== TOMBOL TEMA ===== */
        .theme-toggle {
            position: fixed;
            right: 1.2rem;
            bottom: 1.2rem;
            z-index: 1050;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.7rem 1.1rem;
            border-radius: 999px;
            border: 2px solid var(--edge);
            background: var(--surface);
            color: var(--text);
            font: 700 0.9rem 'Nunito Sans', sans-serif;
            cursor: pointer;
            box-shadow: 3px 3px 0 var(--edge);
        }
        .theme-toggle:hover { box-shadow: 1px 1px 0 var(--edge); transform: translate(2px, 2px); }
        .theme-toggle:focus-visible { outline: 3px solid var(--pencil); outline-offset: 3px; }
        .theme-toggle .to-light { display: none; }
        html[data-sk-theme="dark"] .theme-toggle .to-light { display: inline-flex; align-items: center; gap: 0.55rem; }
        html[data-sk-theme="dark"] .theme-toggle .to-dark  { display: none; }
        .theme-toggle .to-dark { display: inline-flex; align-items: center; gap: 0.55rem; }

        /* ===== HERO ===== */
        .sk-hero {
            min-height: calc(100vh - 56px);
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
            align-items: center;
            gap: 3rem;
            padding: 5rem clamp(1.5rem, 6vw, 6rem);
        }
        .sk-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--pencil);
            color: #0f2150;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            margin-bottom: 1.6rem;
        }
        .sk-title {
            font-weight: 800;
            font-size: clamp(2.7rem, 5.8vw, 5.2rem);
            line-height: 1.02;
            letter-spacing: -0.03em;
            margin: 0 0 1.4rem;
            max-width: 12ch;
        }
        .sk-lead {
            font-size: clamp(1.02rem, 1.3vw, 1.2rem);
            line-height: 1.7;
            color: var(--text-soft);
            max-width: 48ch;
            margin: 0 0 2.4rem;
        }
        .sk-actions { display: flex; flex-wrap: wrap; gap: 0.9rem; }
        .btn-sk {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.95rem 1.9rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            border: 2px solid var(--edge);
            transition: background 0.18s ease, color 0.18s ease, box-shadow 0.18s ease;
        }
        .btn-sk:focus-visible { outline: 3px solid var(--pencil); outline-offset: 3px; }
        .btn-sk-primary { background: var(--btn-bg); color: var(--btn-text); border-color: var(--btn-bg); box-shadow: 4px 4px 0 var(--btn-shadow); }
        .btn-sk-primary:hover { background: var(--btn-hover); border-color: var(--btn-hover); color: var(--btn-text); box-shadow: 2px 2px 0 var(--btn-shadow); }
        .btn-sk-outline { background: var(--surface); color: var(--text); }
        .btn-sk-outline:hover { background: var(--text); color: var(--paper); border-color: var(--text); }

        /* Kartu peminjaman */
        .loan-card {
            position: relative;
            background: var(--surface);
            border: 2px solid var(--edge);
            border-radius: 14px;
            box-shadow: 10px 10px 0 var(--edge);
            max-width: 480px;
            width: 100%;
            justify-self: center;
            transform: rotate(2deg);
            overflow: hidden;
        }
        .loan-card header {
            background: var(--band);
            color: var(--band-text);
            padding: 1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
        }
        .loan-card header small { font-family: 'Nunito Sans', sans-serif; font-weight: 600; opacity: 0.75; font-size: 0.8rem; }
        .loan-body { padding: 0.4rem 1.4rem 1.2rem; }
        .loan-row { display: flex; align-items: center; gap: 1rem; padding: 1rem 0; border-bottom: 1px dashed var(--line); }
        .loan-row:last-child { border-bottom: 0; }
        .loan-row .ico {
            width: 46px; height: 46px;
            display: grid; place-items: center;
            border-radius: 10px;
            background: var(--chip);
            font-size: 1.35rem;
            flex-shrink: 0;
        }
        .loan-row .name { font-weight: 700; line-height: 1.25; }
        .loan-row .meta { font-size: 0.82rem; color: var(--text-soft); }
        .loan-row .tag { margin-left: auto; font-size: 0.78rem; font-weight: 700; padding: 0.25rem 0.7rem; border-radius: 999px; white-space: nowrap; }
        .tag.out  { background: var(--tag-out-bg);  color: var(--tag-out-tx); }
        .tag.back { background: var(--tag-back-bg); color: var(--tag-back-tx); }
        .tag.wait { background: var(--tag-wait-bg); color: var(--tag-wait-tx); }
        .loan-note { border-top: 2px solid var(--edge); padding: 0.7rem 1.4rem; font-size: 0.8rem; color: var(--text-soft); background: var(--paper); }

        /* Stempel animasi */
        .stamp {
            position: absolute;
            right: 1.2rem;
            bottom: 3.2rem;
            border: 4px solid var(--stamp);
            color: var(--stamp);
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: 0.05em;
            padding: 0.2rem 0.9rem;
            border-radius: 8px;
            background: color-mix(in srgb, var(--surface) 70%, transparent);
            transform: rotate(-12deg);
            animation: stamp-in 0.45s cubic-bezier(.2,1.6,.4,1) 0.9s both;
        }
        html[data-sk-theme="dark"] .stamp { color: #ff7a70; border-color: #ff7a70; }
        @keyframes stamp-in {
            from { transform: rotate(-12deg) scale(2.6); opacity: 0; }
            to   { transform: rotate(-12deg) scale(1);   opacity: 0.92; }
        }

        /* ===== KATEGORI ===== */
        .sk-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 5rem clamp(1.5rem, 6vw, 6rem);
        }
        .sk-head { max-width: 58ch; margin-bottom: 2.6rem; }
        .sk-head h2 { font-weight: 800; font-size: clamp(1.9rem, 3.4vw, 3rem); letter-spacing: -0.02em; margin: 0 0 0.7rem; }
        .sk-head p { color: var(--text-soft); font-size: 1.05rem; line-height: 1.65; margin: 0; }

        .sk-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1.5rem; }
        .sk-card {
            display: flex;
            flex-direction: column;
            background: var(--surface);
            border: 2px solid var(--edge);
            border-radius: 12px;
            padding: 1.7rem;
            min-height: 210px;
            color: var(--text);
            text-decoration: none;
            box-shadow: 6px 6px 0 var(--accent, var(--edge));
            transition: box-shadow 0.15s ease, transform 0.15s ease;
        }
        .sk-card:hover, .sk-card:focus-visible {
            transform: translate(4px, 4px);
            box-shadow: 2px 2px 0 var(--accent, var(--edge));
            color: var(--text);
        }
        .sk-card:focus-visible { outline: 3px solid var(--pencil); outline-offset: 3px; }
        .sk-card .icon {
            width: 54px; height: 54px;
            display: grid; place-items: center;
            border-radius: 12px;
            background: var(--accent, var(--edge));
            color: var(--icon-ink);
            font-size: 1.6rem;
            margin-bottom: 1.1rem;
        }
        .sk-card h3 { font-weight: 700; font-size: 1.25rem; margin: 0 0 0.5rem; }
        .sk-card p { color: var(--text-soft); font-size: 0.95rem; line-height: 1.6; margin: 0; }

        /* ===== LANGKAH ===== */
        .sk-steps-wrap { background: var(--band); color: var(--band-text); padding: 5rem clamp(1.5rem, 6vw, 6rem); }
        .sk-steps-wrap h2 { font-weight: 800; font-size: clamp(1.8rem, 3.2vw, 2.8rem); letter-spacing: -0.02em; margin: 0 0 2.4rem; }
        .sk-steps { list-style: none; margin: 0; padding: 0; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 2rem; counter-reset: step; }
        .sk-steps li { counter-increment: step; border-top: 3px solid var(--pencil); padding-top: 1.2rem; }
        .sk-steps li::before {
            content: counter(step);
            display: block;
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 3rem;
            line-height: 1;
            color: var(--pencil);
            margin-bottom: 0.6rem;
        }
        .sk-steps h3 { font-weight: 700; font-size: 1.3rem; margin: 0 0 0.4rem; }
        .sk-steps p { color: rgba(255,255,255,0.8); line-height: 1.6; margin: 0; max-width: 34ch; }

        /* ===== CTA ===== */
        .sk-cta {
            background: var(--cta-bg);
            color: var(--cta-text);
            padding: 5rem clamp(1.5rem, 6vw, 6rem);
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 2rem 3rem;
            align-items: center;
        }
        .sk-cta h2 { font-weight: 800; font-size: clamp(1.8rem, 3.4vw, 3rem); letter-spacing: -0.02em; margin: 0 0 0.6rem; }
        .sk-cta p { font-size: 1.08rem; line-height: 1.6; max-width: 50ch; margin: 0; }
        .sk-cta .btn-sk-primary { background: #0f2150; border-color: #0f2150; color: #fff; box-shadow: 4px 4px 0 var(--cta-btn-shadow); }
        .sk-cta .btn-sk-primary:hover { background: #17306b; border-color: #17306b; color: #fff; box-shadow: 2px 2px 0 var(--cta-btn-shadow); }
        html[data-sk-theme="dark"] .sk-cta .btn-sk-primary { box-shadow: 4px 4px 0 rgba(15, 33, 80, 0.45); }

        /* ===== Responsif ===== */
        @media (max-width: 1199.98px) { .sk-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 991.98px) {
            .sk-hero { grid-template-columns: 1fr; padding-top: 4rem; padding-bottom: 4rem; min-height: auto; }
            .loan-card { transform: none; max-width: 520px; }
            .sk-steps { grid-template-columns: 1fr; }
            .sk-cta { grid-template-columns: 1fr; }
        }
        @media (max-width: 575.98px) {
            .sk-grid { grid-template-columns: 1fr; }
            .sk-section { min-height: auto; }
        }
        @media (prefers-reduced-motion: reduce) {
            .stamp { animation: none; opacity: 0.92; }
            .sk-card, .theme-toggle, .sk-wrapper { transition: none; }
        }
    </style>

    <div class="sk-wrapper">

        <!-- Tombol ganti tema -->
        <button type="button" class="theme-toggle" id="skThemeToggle" aria-label="Ganti mode tampilan">
            <span class="to-dark"><i class="bi bi-moon-stars-fill"></i> Mode gelap</span>
            <span class="to-light"><i class="bi bi-sun-fill"></i> Mode terang</span>
        </button>

        <!-- HERO -->
        <section class="sk-hero notebook">
            <div>
                <span class="sk-badge"><i class="bi bi-backpack2"></i> Welcome To Peminjam Alat</span>
                <h1 class="sk-title">Butuh alat? Pinjam di sini.</h1>
                <p class="sk-lead">
                    Dari laptop, kamera, dan alat praktikum sampai bola basket. Ajukan peminjaman,
                    pantau statusnya, dan kembalikan sebelum tenggat.
                </p>
                <div class="sk-actions">
                    <a href="{{ route('dashboard') }}" class="btn-sk btn-sk-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk Dashboard
                    </a>
                    <a href="#kategori" class="btn-sk btn-sk-outline">
                        <i class="bi bi-grid-3x3-gap"></i> Lihat Kategori Alat
                    </a>
                </div>
            </div>

            <div class="loan-card" aria-hidden="true">
                <header>Kartu Peminjaman <small>Contoh tampilan</small></header>
                <div class="loan-body">
                    <div class="loan-row">
                        <span class="ico"><i class="bi bi-camera-video"></i></span>
                        <div><div class="name">Kamera DSLR</div><div class="meta">Multimedia &middot; 2 hari</div></div>
                        <span class="tag out">Dipinjam</span>
                    </div>
                    <div class="loan-row">
                        <span class="ico"><i class="bi bi-eyedropper"></i></span>
                        <div><div class="name">Mikroskop optik</div><div class="meta">Sains &middot; 1 hari</div></div>
                        <span class="tag back">Dikembalikan</span>
                    </div>
                    <div class="loan-row">
                        <span class="ico"><i class="bi bi-dribbble"></i></span>
                        <div><div class="name">Bola basket</div><div class="meta">Olahraga &middot; 3 hari</div></div>
                        <span class="tag wait">Menunggu</span>
                    </div>
                </div>
                <div class="loan-note">Status diperbarui otomatis setelah guru atau petugas menyetujui.</div>
                <span class="stamp">DISETUJUI</span>
            </div>
        </section>

        <!-- KATEGORI -->
        <section class="sk-section notebook" id="kategori">
            <div class="sk-head">
                <h2>Alat apa yang ingin kamu pinjam?</h2>
                <p>Pilih kelompok alat, lalu lanjutkan ke dashboard untuk melihat stok dan mengajukan peminjaman.</p>
            </div>

            <div class="sk-grid">
                <a href="{{ route('dashboard') }}" class="sk-card" style="--accent:#8fc1ff">
                    <span class="icon"><i class="bi bi-laptop"></i></span>
                    <h3>Lab Komputer</h3>
                    <p>Laptop, perangkat jaringan, dan alat pemrograman siswa.</p>
                </a>
                <a href="{{ route('dashboard') }}" class="sk-card" style="--accent:#9be3b8">
                    <span class="icon"><i class="bi bi-eyedropper"></i></span>
                    <h3>Alat Lab Sains & MIPA</h3>
                    <p>Mikroskop optik, gelas ukur, tabung reaksi, dan kit praktikum kimia/biologi.</p>
                </a>
                <a href="{{ route('dashboard') }}" class="sk-card" style="--accent:#d4b5ff">
                    <span class="icon"><i class="bi bi-camera-video"></i></span>
                    <h3>Multimedia & Studio</h3>
                    <p>Kamera DSLR, proyektor, speaker portable, mic clip-on, dan alat podcast.</p>
                </a>
                <a href="{{ route('dashboard') }}" class="sk-card" style="--accent:#ffb48a">
                    <span class="icon"><i class="bi bi-tools"></i></span>
                    <h3>Praktek Kejuruan / Kriya</h3>
                    <p>Peralatan teknik mesin, kelistrikan, pertukangan, dan perangkat workshop.</p>
                </a>
                <a href="{{ route('dashboard') }}" class="sk-card" style="--accent:#ffc933">
                    <span class="icon"><i class="bi bi-trophy"></i></span>
                    <h3>Sarana Olahraga & Seni</h3>
                    <p>Bola basket/sepak bola, net lapangan, matras senam, dan alat musik.</p>
                </a>
                <a href="{{ route('dashboard') }}" class="sk-card" style="--accent:#ffa5a0">
                    <span class="icon"><i class="bi bi-clock-history"></i></span>
                    <h3>Riwayat & Log Peminjam</h3>
                    <p>Status pengajuan, tenggat waktu, dan laporan sirkulasi alat.</p>
                </a>
            </div>
        </section>

        <!-- LANGKAH -->
        <section class="sk-steps-wrap">
            <h2>Cara meminjam, tiga langkah</h2>
            <ol class="sk-steps">
                <li>
                    <h3>Cek ketersediaan</h3>
                    <p>Lihat alat yang masih ada di dashboard sebelum jam pelajaran dimulai.</p>
                </li>
                <li>
                    <h3>Ajukan peminjaman</h3>
                    <p>Isi formulir, pilih alat dan lama pinjam, lalu tunggu persetujuan.</p>
                </li>
                <li>
                    <h3>Kembalikan tepat waktu</h3>
                    <p>Serahkan alat ke petugas sebelum tenggat agar riwayatmu tetap rapi.</p>
                </li>
            </ol>
        </section>

        <!-- CTA -->
        <section class="sk-cta">
            <div>
                <h2>Siap meminjam alat?</h2>
                <p>Masuk ke sistem untuk mengajukan peminjaman baru atau memeriksa alat yang tersedia hari ini.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-sk btn-sk-primary">
                <i class="bi bi-pencil-square"></i> Isi Formulir Peminjaman
            </a>
        </section>

    </div>

    <script>
        (function () {
            var root = document.documentElement;
            var btn = document.getElementById('skThemeToggle');
            if (!btn) return;

            btn.addEventListener('click', function () {
                var next = root.getAttribute('data-sk-theme') === 'dark' ? 'light' : 'dark';
                root.setAttribute('data-sk-theme', next);
                try { localStorage.setItem('sk-theme', next); } catch (e) {}
            });

            // Ikuti perubahan tema sistem selama pengguna belum memilih sendiri
            if (window.matchMedia) {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
                    var saved = null;
                    try { saved = localStorage.getItem('sk-theme'); } catch (err) {}
                    if (!saved) root.setAttribute('data-sk-theme', e.matches ? 'dark' : 'light');
                });
            }
        })();
    </script>

@endsection