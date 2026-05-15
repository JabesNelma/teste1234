<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'VGSS Grading System') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #1a365d;
            --secondary-color: #2c5282;
            --accent-color: #e53e3e;
        }
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding-top: 0;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.2);
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-header h5 {
            font-size: 1rem;
            margin: 0;
            font-weight: 600;
        }
        .sidebar-header small {
            opacity: 0.8;
            font-size: 0.75rem;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            font-size: 0.9rem;
            border-left: 3px solid transparent;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--accent-color);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
        }
        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }
        .stat-card {
            padding: 25px;
            border-radius: 10px;
            color: white;
        }
        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }
        .stat-card p {
            margin: 0;
            opacity: 0.9;
        }
        .bg-gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .bg-gradient-success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
        .bg-gradient-warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .bg-gradient-info { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .badge-grade {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 600;
        }
        .grade-a { background-color: #d4edda; color: #155724; }
        .grade-b { background-color: #cce5ff; color: #004085; }
        .grade-c { background-color: #fff3cd; color: #856404; }
        .grade-d { background-color: #ffe0b2; color: #e65100; }
        .grade-f { background-color: #f8d7da; color: #721c24; }
        @media print {
            .sidebar, .topbar, .no-print { display: none !important; }
            .main-content { margin-left: 0 !important; padding: 0 !important; }
            .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h5>VGSS Grading System</h5>
            <small>Venilale General Secondary School</small>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link <?= uri_string() === 'dashboard' ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'students') ? 'active' : '' ?>" href="<?= site_url('students') ?>">
                    <i class="bi bi-people"></i> Students
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'subjects') ? 'active' : '' ?>" href="<?= site_url('subjects') ?>">
                    <i class="bi bi-book"></i> Subjects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'classes') ? 'active' : '' ?>" href="<?= site_url('classes') ?>">
                    <i class="bi bi-building"></i> Classes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'grades') ? 'active' : '' ?>" href="<?= site_url('grades') ?>">
                    <i class="bi bi-journal-text"></i> Grades
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= str_starts_with(uri_string(), 'reports') ? 'active' : '' ?>" href="<?= site_url('reports') ?>">
                    <i class="bi bi-file-earmark-bar-graph"></i> Reports
                </a>
            </li>
            <li class="nav-item mt-5">
                <a class="nav-link text-danger" href="<?= site_url('logout') ?>">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="topbar">
            <div>
                <button class="btn btn-sm btn-outline-secondary d-md-none me-2" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="mb-0"><?= esc($title ?? 'Dashboard') ?></h5>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-end me-3">
                    <div class="fw-bold"><?= esc(session()->get('full_name')) ?></div>
                    <small class="text-muted"><?= ucfirst(session()->get('role')) ?></small>
                </div>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px">
                    <?= strtoupper(substr(session()->get('full_name'), 0, 1)) ?>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
