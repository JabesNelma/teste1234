<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Eskola Secundaria Geral Venilale') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --bg: #07111f;
            --bg-soft: #0d1b2e;
            --surface: rgba(13, 27, 46, 0.78);
            --surface-strong: #10263f;
            --text: #e7eef8;
            --muted: #aebbd0;
            --line: rgba(255, 255, 255, 0.08);
            --brand: #5ad0c6;
            --brand-2: #8fd3ff;
            --accent: #f4b860;
            --danger: #ff7a7a;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(90, 208, 198, 0.22), transparent 34%),
                radial-gradient(circle at top right, rgba(143, 211, 255, 0.18), transparent 28%),
                linear-gradient(180deg, #09111d 0%, #0b1726 44%, #07111f 100%);
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,0.8), transparent 85%);
            opacity: 0.35;
        }

        .navbar {
            backdrop-filter: blur(16px);
            background: rgba(7, 17, 31, 0.78);
            border-bottom: 1px solid var(--line);
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 0.02em;
        }

        .navbar .nav-link {
            color: rgba(231, 238, 248, 0.82);
            font-weight: 500;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link:focus {
            color: #fff;
        }

        .nav-pill {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 0.35rem 0.8rem;
        }

        .page-shell {
            position: relative;
            overflow: hidden;
        }

        .page-shell::after {
            content: '';
            position: absolute;
            width: 20rem;
            height: 20rem;
            right: -8rem;
            top: 12rem;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(90, 208, 198, 0.15), transparent 70%);
            filter: blur(12px);
            pointer-events: none;
        }

        .hero-panel,
        .glass-card {
            background: linear-gradient(180deg, rgba(16, 38, 63, 0.84), rgba(10, 22, 38, 0.9));
            border: 1px solid var(--line);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.25);
            border-radius: 24px;
        }

        .hero-panel {
            padding: clamp(1.5rem, 4vw, 3rem);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .45rem .85rem;
            border-radius: 999px;
            background: rgba(90, 208, 198, 0.12);
            border: 1px solid rgba(90, 208, 198, 0.28);
            color: var(--brand);
            font-size: .9rem;
            font-weight: 700;
        }

        .display-title {
            letter-spacing: -0.04em;
            line-height: 0.95;
        }

        .lead-copy {
            color: var(--muted);
            font-size: 1.05rem;
            max-width: 65ch;
        }

        .cta-group .btn {
            border-radius: 999px;
            padding: .85rem 1.25rem;
            font-weight: 700;
        }

        .btn-brand {
            background: linear-gradient(135deg, var(--brand), var(--brand-2));
            color: #05101b;
            border: none;
        }

        .btn-brand:hover {
            color: #05101b;
            filter: brightness(1.05);
        }

        .btn-outline-soft {
            border-color: rgba(255,255,255,0.18);
            color: var(--text);
            background: rgba(255,255,255,0.04);
        }

        .btn-outline-soft:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }

        .section-card {
            padding: 1.5rem;
            height: 100%;
        }

        .section-label {
            color: var(--brand-2);
            font-size: .82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .stat {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 1rem;
        }

        .stat strong {
            display: block;
            font-size: 1.05rem;
        }

        .stat span {
            color: var(--muted);
            font-size: .92rem;
        }

        .section-title {
            font-size: clamp(1.35rem, 3vw, 2rem);
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .muted {
            color: var(--muted);
        }

        .info-list li {
            margin-bottom: .7rem;
        }

        .info-list strong {
            color: #fff;
        }

        .floating-note {
            border-left: 4px solid var(--accent);
            background: rgba(244, 184, 96, 0.1);
            color: #f8e7c2;
            border-radius: 16px;
            padding: 1rem 1.1rem;
        }

        .badge-soft {
            background: rgba(143, 211, 255, 0.12);
            color: var(--brand-2);
            border: 1px solid rgba(143, 211, 255, 0.2);
        }

        .footer {
            color: var(--muted);
            border-top: 1px solid var(--line);
            background: rgba(4, 10, 19, 0.45);
        }

        @media (max-width: 991.98px) {
            .navbar .nav-link {
                padding: .6rem 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container py-2">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= site_url('/') ?>">
                <span class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width:40px;height:40px;background:linear-gradient(135deg,var(--brand),var(--brand-2));color:#06111b;">
                    <i class="bi bi-mortarboard-fill"></i>
                </span>
                ESGV Venilale
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="publicNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2 mt-3 mt-lg-0">
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link nav-pill" href="<?= site_url('nilai') ?>"><i class="bi bi-journal-text me-1"></i>Valor</a></li>
                    <li class="nav-item"><a class="nav-link nav-pill" href="<?= site_url('login') ?>"><i class="bi bi-shield-lock me-1"></i>Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="page-shell">
        <div class="container py-4 py-lg-5">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success border-0 shadow-sm"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger border-0 shadow-sm"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <footer class="footer py-4 mt-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <div>ESGV Venilale</div>
            <div>Eskola Secundaria Geral Publiku iha Baucau, Venilale</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>