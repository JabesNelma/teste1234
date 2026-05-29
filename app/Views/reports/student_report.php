<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report - <?= esc($student['full_name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .report-card { box-shadow: none !important; border: 2px solid #000 !important; }
        }
        .report-card {
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .school-header {
            text-align: center;
            border-bottom: 3px double #1a365d;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .school-header h2 { color: #1a365d; margin: 0; }
        .school-header h5 { color: #2c5282; margin: 5px 0; }
        .info-table th { background: #f8f9fa; width: 35%; }
        .grade-a { background-color: #d4edda; color: #155724; }
        .grade-b { background-color: #cce5ff; color: #004085; }
        .grade-c { background-color: #fff3cd; color: #856404; }
        .grade-d { background-color: #ffe0b2; color: #e65100; }
        .grade-f { background-color: #f8d7da; color: #721c24; }
        .badge-grade { padding: 3px 8px; border-radius: 4px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="no-print text-center py-3 bg-light">
        <a href="<?= site_url('reports') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Fila Fali ba Relatoriu Kaderneta</a>
        <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer"></i> Print Kaderneta</button>
    </div>

    <div class="report-card">
        <div class="school-header">
            <h2>ESKOLA SECUNDARIA GERAL VENILALE</h2>
            <h5>Kaderneta Periodu Estudante</h5>
            <p class="mb-0 text-muted">Anu Letivu <?= !empty($grades) ? esc($grades[0]['academic_year']) : '2025-2026' ?></p>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <table class="table table-sm info-table">
                    <tr><th>Nu.Emis</th><td><?= esc($student['student_id']) ?></td></tr>
                    <tr><th>Naran Kompletu</th><td><?= esc($student['full_name']) ?></td></tr>
                    <tr><th>Sexu</th><td><?= $student['gender'] === 'male' ? 'Mane' : 'Feto' ?></td></tr>
                    <tr><th>Periodu</th><td><?= !empty($grades) ? esc($grades[0]['academic_term']) : '-' ?></td></tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm info-table">
                    <tr><th>Klasse</th><td><?= esc($student['class_name']) ?></td></tr>
                    <tr><th>Data Moris</th><td><?= date('d M Y', strtotime($student['date_of_birth'])) ?></td></tr>
                    <tr><th>Anu Letivu</th><td><?= !empty($grades) ? esc($grades[0]['academic_year']) : '-' ?></td></tr>
                  
                </table>
            </div>
        </div>

        <h5 class="mb-3">Nota Aprendizagem</h5>
        <?php if (empty($grades)): ?>
            <p class="text-muted text-center">No grades recorded.</p>
        <?php else: ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Materia</th>
                    <th>Valor</th>
                    <th>Observasaun</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grades as $grade): ?>
                <tr>
                    <td><?= esc($grade['subject_name']) ?></td>
                    
                    <td><?= number_format($grade['score'], 1) ?></td>
                   
                    <td>
                        <?php if ($grade['score'] >= 10): ?>
                             <span class="badge bg-primary">Excelente</span>
                        <?php elseif ($grade['score'] >= 9): ?>
                            <span class="badge bg-info text-dark">Muito Bom</span>
                        <?php elseif ($grade['score'] >= 8): ?>
                            <span class="badge bg-warning text-dark">Bom</span>
                        <?php elseif ($grade['score'] >= 7): ?>
                            <span class="badge bg-warning text-dark">Razoavel</span>
                        <?php elseif ($grade['score'] >= 6): ?>
                            <span class="badge bg-warning text-dark">Suficiente</span>
                        <?php elseif ($grade['score'] >= 5): ?>
                            <span class="badge bg-warning text-dark">Insuficiente</span>
                        <?php elseif ($grade['score'] >= 4): ?>
                            <span class="badge bg-warning text-dark">Mediocre</span>
                        <?php elseif ($grade['score'] >= 3): ?>
                            <span class="badge bg-warning text-dark">Mau</span>
                        <?php elseif ($grade['score'] >= 2): ?>
                            <span class="badge bg-warning text-dark">Muito Mau</span>
                        <?php elseif ($grade['score'] >= 1): ?>
                            <span class="badge bg-warning text-dark">Mau</span>
                        <?php else: ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

        <?php
        $total_valor=0;
        foreach ($grades as $grade){
            $total_valor += $grade['score'];
        }
        ?>

        <div class="row mt-4">
            <div class="col-4 text-center">
                <div class="p-3 bg-primary text-white rounded">
                    <h4 class="mb-0"><?= $total_valor ?></h4>
                    <small>Total Valor</small>
                </div>
            </div>
        <?php
        $total_valor = 0;
        
        //soma valor hotu husi materia sira
        foreach ($grades as $grade) {
            $total_valor += $grade['score'];
        }

        //klasifikasaun
        if ($total_valor >= 85) {
            $status = "Aprovadu";
            $bg = "bg-success";
        }else {
            $status = "Reprovadu";
            $bg = "bg-danger";
            
        }
        ?>
            <div class="col-4 text-center">
                <div class="p-3 <?= $bg ?> text-white rounded">
                    <h4 class="mb-0"><?= $status ?></h4>
                    <small>Klasifikasaun</small>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-5">
            <div class="col-4 text-center">
                <hr>
                <p>Professor da Turma</p>
            </div>
            <div class="col-4 text-center">
                <hr>
                <p>Diretor Eskola</p>
            </div>
            <div class="col-4 text-center">
                <hr>
                <p>Enkaregadu/Responsabilidade</p>
            </div>
        </div>

        <div class="text-center mt-4 text-muted">
            <small>Fo Sai <?= date('d M Y H:i') ?> | Sistema ESGV</small>
        </div>
    </div>
</body>
</html>
