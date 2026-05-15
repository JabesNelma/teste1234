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
        <a href="<?= site_url('reports') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to Reports</a>
        <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer"></i> Print Report</button>
    </div>

    <div class="report-card">
        <div class="school-header">
            <h2>VENILALE GENERAL SECONDARY SCHOOL</h2>
            <h5>Student Academic Report Card</h5>
            <p class="mb-0 text-muted">Academic Year <?= !empty($grades) ? esc($grades[0]['academic_year']) : '2025-2026' ?></p>
        </div>

        <div class="row mb-4">
            <div class="col-6">
                <table class="table table-sm info-table">
                    <tr><th>Student ID</th><td><?= esc($student['student_id']) ?></td></tr>
                    <tr><th>Full Name</th><td><?= esc($student['full_name']) ?></td></tr>
                    <tr><th>Gender</th><td><?= ucfirst($student['gender']) ?></td></tr>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-sm info-table">
                    <tr><th>Class</th><td><?= esc($student['class_name']) ?></td></tr>
                    <tr><th>Date of Birth</th><td><?= date('d M Y', strtotime($student['date_of_birth'])) ?></td></tr>
                    <tr><th>Academic Year</th><td><?= !empty($grades) ? esc($grades[0]['academic_year']) : '-' ?></td></tr>
                </table>
            </div>
        </div>

        <h5 class="mb-3">Academic Performance</h5>
        <?php if (empty($grades)): ?>
            <p class="text-muted text-center">No grades recorded.</p>
        <?php else: ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Subject</th>
                    <th>Term</th>
                    <th>Score</th>
                    <th>Grade</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grades as $grade): ?>
                <tr>
                    <td><?= esc($grade['subject_name']) ?></td>
                    <td><?= esc($grade['academic_term']) ?></td>
                    <td><?= number_format($grade['score'], 1) ?></td>
                    <td>
                        <?php
                        $letter = strtoupper($grade['grade_letter'] ?? '');
                        $class = match (true) {
                            str_starts_with($letter, 'A') => 'grade-a',
                            str_starts_with($letter, 'B') => 'grade-b',
                            str_starts_with($letter, 'C') => 'grade-c',
                            str_starts_with($letter, 'D') => 'grade-d',
                            default => 'grade-f',
                        };
                        ?>
                        <span class="badge-grade <?= $class ?>"><?= $letter ?></span>
                    </td>
                    <td><?= esc($grade['remarks'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

        <div class="row mt-4">
            <div class="col-4 text-center">
                <div class="p-3 bg-primary text-white rounded">
                    <h4 class="mb-0"><?= $gpa['gpa'] ?></h4>
                    <small>GPA</small>
                </div>
            </div>
            <div class="col-4 text-center">
                <div class="p-3 bg-success text-white rounded">
                    <h4 class="mb-0"><?= $gpa['average'] ?>%</h4>
                    <small>Average Score</small>
                </div>
            </div>
            <div class="col-4 text-center">
                <div class="p-3 bg-warning text-white rounded">
                    <h4 class="mb-0"><?= $gpa['total_subjects'] ?></h4>
                    <small>Total Subjects</small>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-5">
            <div class="col-4 text-center">
                <hr>
                <p>Class Teacher</p>
            </div>
            <div class="col-4 text-center">
                <hr>
                <p>Principal</p>
            </div>
            <div class="col-4 text-center">
                <hr>
                <p>Parent/Guardian</p>
            </div>
        </div>

        <div class="text-center mt-4 text-muted">
            <small>Generated on <?= date('d M Y H:i') ?> | VGSS Grading System</small>
        </div>
    </div>
</body>
</html>
