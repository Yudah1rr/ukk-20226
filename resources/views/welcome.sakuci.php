@extends('layouts.app')

@section('title', config('app.name') . ' — Portal Peminjaman Alat & Inventaris Sekolah')

@section('content')

    <!-- Tema: Inventaris Laboratorium — kertas grafik, label spesimen, aksen kaca & oranye keselamatan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=JetBrains+Mono:wght@500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --lab-bg: #eef3f1;
            --lab-surface: #ffffff;
            --ink: #16302c;
            --ink-soft: #4d6560;
            --teal: #0f7a6c;
            --teal-deep: #0a5850;
            --safety: #e8630a;
            --grid: rgba(15, 122, 108, 0.12);
            --border: #cfe0da;
        }

        .lab-wrapper {
            background-color: var(--lab-bg);
            background-image:
                linear-gradient(var(--grid) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid) 1px, transparent 1px);
            background-size: 28px 28px;
            color: var(--ink);
            width: 100%;
            padding: 3.25rem 2rem 4.5rem;
            font-family: 'Inter', system-ui, sans-serif;
        }
        .lab-wrapper * { box-sizing: border-box; }

        .lab-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.76rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            color: var(--teal-deep);
        }

        /* ===== HERO ===== */
        .lab-hero {
            background: var(--lab-surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 3rem 3rem;
            box-shadow: 0 1px 0 var(--border), 0 18px 40px -24px rgba(15, 60, 52, 0.35);
        }

        .lab-hero-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 3rem;
            align-items: center;
        }

        .lab-tagno {
            display: inline-block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            color: var(--ink-soft);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 0.35rem 0.9rem;
            margin-bottom: 1.5rem;
        }
        .lab-tagno::before {
            content: '●';
            color: var(--safety);
            margin-right: 0.5rem;
            font-size: 0.6rem;
        }

        .lab-title {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 2.75rem;
            line-height: 1.16;
            color: var(--ink);
            margin-bottom: 1.1rem;
            max-width: 15ch;
        }

        .lab-lead {
            color: var(--ink-soft);
            font-size: 1.05rem;
            line-height: 1.7;
            max-width: 52ch;
            margin-bottom: 2rem;
        }

        .lab-actions { display: flex; flex-wrap: wrap; gap: 0.9rem; }

        .btn-lab-primary {
            background: var(--teal);
            color: #ffffff;
            border: 1px solid var(--teal);
            padding: 0.8rem 1.7rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.92rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            transition: background 0.18s ease, transform 0.18s ease;
        }
        .btn-lab-primary:hover { background: var(--teal-deep); color: #fff; transform: translateY(-2px); }

        .btn-lab-outline {
            background: transparent;
            color: var(--ink);
            border: 1px solid var(--ink);
            padding: 0.8rem 1.7rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.92rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            transition: all 0.18s ease;
        }
        .btn-lab-outline:hover { background: var(--ink); color: #fff; transform: translateY(-2px); }

        /* labu erlenmeyer sederhana dari CSS */
        .lab-flask {
            width: 132px;
            height: 172px;
            position: relative;
            flex-shrink: 0;
        }
        .lab-flask .neck {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 26px;
            height: 46px;
            border-left: 3px solid var(--ink);
            border-right: 3px solid var(--ink);
        }
        .lab-flask .neck::before {
            content: '';
            position: absolute;
            top: -1px;
            left: -8px;
            right: -8px;
            height: 6px;
            background: var(--ink);
            border-radius: 2px;
        }
        .lab-flask .body {
            position: absolute;
            top: 44px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 63px solid transparent;
            border-right: 63px solid transparent;
            border-top: 118px solid var(--ink);
            opacity: 0.06;
        }
        .lab-flask .outline {
            position: absolute;
            top: 44px;
            left: 50%;
            transform: translateX(-50%);
            width: 126px;
            height: 122px;
            clip-path: polygon(42% 0%, 58% 0%, 58% 30%, 100% 100%, 0% 100%, 42% 30%);
            border: 3px solid var(--ink);
            border-top: none;
            background: transparent;
        }
        .lab-flask .liquid {
            position: absolute;
            bottom: 3px;
            left: 50%;
            transform: translateX(-50%);
            width: 108px;
            height: 62px;
            background: linear-gradient(180deg, var(--teal) 0%, var(--teal-deep) 100%);
            clip-path: polygon(18% 0%, 82% 0%, 100% 100%, 0% 100%);
        }
        .lab-flask .bubble {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255,255,255,0.55);
        }
        .lab-flask .b1 { bottom: 20px; left: 44%; }
        .lab-flask .b2 { bottom: 32px; left: 58%; width: 4px; height: 4px; }

        /* ===== Section heading ===== */
        .lab-section-heading {
            display: flex;
            align-items: baseline;
            gap: 1rem;
            margin: 3.4rem 0 1.7rem;
            padding-bottom: 0.9rem;
            border-bottom: 2px solid var(--ink);
        }
        .lab-section-heading h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--ink);
            margin: 0;
        }

        /* ===== Kartu kategori: label spesimen ===== */
        .lab-card {
            background: var(--lab-surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            text-decoration: none;
            color: var(--ink);
            display: block;
            height: 100%;
            padding: 1.5rem 1.5rem 1.4rem;
            position: relative;
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }
        .lab-card::before {
            /* lubang punch label spesimen */
            content: '';
            position: absolute;
            top: 14px;
            right: 14px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: var(--lab-bg);
        }
        .lab-card:hover {
            color: var(--ink);
            transform: translateY(-4px);
            border-color: var(--teal);
            box-shadow: 0 14px 28px -18px rgba(15, 122, 108, 0.45);
        }
        .lab-card .spec-code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--safety);
            letter-spacing: 0.03em;
        }
        .lab-card h4 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.14rem;
            margin: 0.5rem 0 0.6rem;
            padding-bottom: 0.65rem;
            border-bottom: 1px solid var(--border);
        }
        .lab-card p {
            color: var(--ink-soft);
            font-size: 0.9rem;
            line-height: 1.55;
            margin: 0;
        }

        /* ===== CTA: formulir requisisi ===== */
        .lab-cta {
            margin-top: 3.6rem;
            background: var(--ink);
            border-radius: 10px;
            padding: 3rem 2.5rem;
            text-align: center;
            color: var(--lab-surface);
        }
        .lab-cta .lab-label { color: var(--safety); }
        .lab-cta h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.7rem;
            margin: 0.6rem 0 0.8rem;
        }
        .lab-cta p {
            color: rgba(238, 243, 241, 0.78);
            max-width: 46ch;
            margin: 0 auto 1.7rem;
            line-height: 1.65;
        }
        .lab-cta .btn-lab-primary { background: var(--safety); border-color: var(--safety); }
        .lab-cta .btn-lab-primary:hover { background: #c85309; border-color: #c85309; }

        @media (max-width: 767.98px) {
            .lab-hero-grid { grid-template-columns: 1fr; }
            .lab-flask { display: none; }
            .lab-title { font-size: 2rem; }
            .lab-hero { padding: 2.3rem 1.6rem; }
        }
    </style>

    <div class="lab-wrapper">
        <div class="container-fluid px-2 px-lg-4">

            <!-- HERO -->
            <div class="lab-hero">
                <div class="lab-hero-grid">
                    <div>
                        <span class="lab-tagno">SPESIMEN NO. 001 / SISTEM PEMINJAMAN AKTIF</span>
                        <h1 class="lab-title">Inventaris Alat Laboratorium Sekolah</h1>
                        <p class="lab-lead">
                            Ajukan peminjaman alat lab, cek ketersediaan sebelum praktikum, dan kembalikan
                            tepat waktu — semua tercatat rapi seperti label spesimen di rak penyimpanan.
                        </p>
                        <div class="lab-actions">
                            <a href="{{ route('dashboard') }}" class="btn-lab-primary">
                                <i class="bi bi-speedometer2"></i> Masuk Dashboard
                            </a>
                            <a href="#menu-sekolah" class="btn-lab-outline">
                                <i class="bi bi-grid-3x3-gap"></i> Lihat Kategori Alat
                            </a>
                        </div>
                    </div>
                    <div class="lab-flask">
                        <div class="neck"></div>
                        <div class="outline"></div>
                        <div class="liquid"></div>
                        <div class="bubble b1"></div>
                        <div class="bubble b2"></div>
                    </div>
                </div>
            </div>

            <!-- KATEGORI -->
            <div id="menu-sekolah">
                <div class="lab-section-heading">
                    <span class="lab-label">RAK A–F</span>
                    <h2>Kategori Peminjaman & Fasilitas</h2>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-xl-4">
                        <a href="{{ route('dashboard') }}" class="lab-card">
                            <span class="spec-code">RAK.IT — A</span>
                            <h4>Lab Komputer & IT</h4>
                            <p>Laptop, perangkat jaringan, tablet, dan alat pemrograman siswa.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="{{ route('dashboard') }}" class="lab-card">
                            <span class="spec-code">RAK.MIPA — B</span>
                            <h4>Alat Lab Sains & MIPA</h4>
                            <p>Mikroskop optik, gelas ukur, tabung reaksi, dan kit praktikum kimia/biologi.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="{{ route('dashboard') }}" class="lab-card">
                            <span class="spec-code">RAK.MM — C</span>
                            <h4>Multimedia & Studio</h4>
                            <p>Kamera DSLR, proyektor, speaker portable, mic clip-on, dan alat podcast.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="{{ route('dashboard') }}" class="lab-card">
                            <span class="spec-code">RAK.VOK — D</span>
                            <h4>Praktek Kejuruan / Kriya</h4>
                            <p>Peralatan teknik mesin, kelistrikan, pertukangan, dan perangkat workshop.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="{{ route('dashboard') }}" class="lab-card">
                            <span class="spec-code">RAK.OR — E</span>
                            <h4>Sarana Olahraga & Seni</h4>
                            <p>Bola basket/sepak bola, net lapangan, matras senam, dan alat musik.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <a href="{{ route('dashboard') }}" class="lab-card">
                            <span class="spec-code">RAK.LOG — F</span>
                            <h4>Riwayat & Log Peminjam</h4>
                            <p>Status pengajuan, tenggat waktu, dan laporan sirkulasi alat.</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="lab-cta">
                <span class="lab-label">FORMULIR REQUISISI</span>
                <h2>Ingin mengajukan peminjaman alat?</h2>
                <p>Masuk ke sistem untuk mengajukan permohonan baru atau memeriksa ketersediaan inventaris hari ini.</p>
                <a href="{{ route('dashboard') }}" class="btn-lab-primary">
                    <i class="bi bi-pencil-square"></i> Isi Formulir Peminjaman
                </a>
            </div>

        </div>
    </div>

@endsection