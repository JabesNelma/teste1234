<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Report - <?= esc($class['class_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
        }
        .report-card {
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            background: white;
        }
        .school-header {
            text-align: center;
            border-bottom: 3px double #1a365d;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .school-header h2 { color: #1a365d; margin: 0; }
    </style>
</head>
<body>
    <div class="no-print text-center py-3 bg-light">
        <a href="<?= site_url('reports') ?>" class="btn btn-secondary">Fila Fali ba Kaderneta</a>
        <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer"></i> Print</button>
    </div>

    <div class="report-card">
        <div class="school-header">
            <h2>ESKOLA SECUNDARIA GERAL VENILALE</h2>
            <h5>Relatoriu Kaderneta Turma Nian</h5>
            <p class="mb-0 text-muted"><?= esc($class['class_name']) ?> | <?= esc($term) ?> | <?= esc($year) ?></p>
        </div>

        <?php if (empty($averages)): ?>
            <p class="text-muted text-center">No grade data available for this class.</p>
        <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nu.Emis</th>
                    <th>Naran Estudante</th>
                    <th>Total Valor</th>
                    <th>Klasifikasaun</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; foreach ($averages as $avg): ?>
                <tr>
                    <td><?= $rank++ ?></td>
                    <td><?= esc($avg['student_code']) ?></td>
                    <td><?= esc($avg['full_name']) ?></td>
                    <td><?= number_format($avg['average'], 1) ?></td>
                    <td>
                        <?php if ($avg['average'] >= 5): ?>
                            <span class="badge bg-success">Aprovado</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Reprovado</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

       
        <?php endif; ?>

        <div class="text-center mt-4 text-muted">
            <small>Fo Sai <?= date('d M Y ') ?> | Sistema Eskola Secundaria Geral Venilale</small>
        </div>
    </div>
</body>
</html>
