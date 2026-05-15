<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VGSS Grading System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a365d 0%, #2c5282 50%, #2b6cb0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            max-width: 400px;
            margin: auto;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .login-header {
            background: linear-gradient(135deg, #1a365d, #2c5282);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 30px;
            text-align: center;
        }
        .login-header h4 { margin: 0; font-weight: 600; }
        .login-header small { opacity: 0.8; }
        .form-control:focus {
            border-color: #2c5282;
            box-shadow: 0 0 0 0.2rem rgba(44,82,130,0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #1a365d, #2c5282);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #2c5282, #2b6cb0);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card card">
            <div class="login-header">
                <h4>VGSS Grading System</h4>
                <small>Venilale General Secondary School</small>
            </div>
            <div class="card-body p-4">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <form action="<?= site_url('login') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-login w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </form>

                <div class="mt-4 p-3 bg-light rounded">
                    <small class="text-muted d-block"><strong>Demo Accounts:</strong></small>
                    <small class="text-muted">Admin: <code>admin</code> / <code>password</code></small><br>
                    <small class="text-muted">Teacher: <code>teacher1</code> / <code>password</code></small>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
