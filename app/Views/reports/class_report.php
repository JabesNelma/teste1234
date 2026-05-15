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
        <a href="<?= site_url('reports') ?>" class="btn btn-secondary">Back to Reports</a>
        <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer"></i> Print</button>
    </div>

    <div class="report-card">
        <div class="school-header">
            <h2>VENILALE GENERAL SECONDARY SCHOOL</h2>
            <h5>Class Academic Summary Report</h5>
            <p class="mb-0 text-muted"><?= esc($class['class_name']) ?> | <?= esc($term) ?> | <?= esc($year) ?></p>
        </div>

        <?php if (empty($averages)): ?>
            <p class="text-muted text-center">No grade data available for this class.</p>
        <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Rank</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Average Score</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; foreach ($averages as $avg): ?>
                <tr>
                    <td><?= $rank++ ?></td>
                    <td><?= esc($avg['student_code']) ?></td>
                    <td><?= esc($avg['full_name']) ?></td>
                    <td><?= number_format($avg['average'], 2) ?>%</td>
                    <td>
                        <?php
                        $letter = match(true) {
                            $avg['average'] >= 90 => 'A+',
                            $avg['average'] >= 85 => 'A',
                            $avg['average'] >= 80 => 'A-',
                            $avg['average'] >= 75 => 'B+',
                            $avg['average'] >= 70 => 'B',
                            $avg['average'] >= 65 => 'B-',
                            $avg['average'] >= 60 => 'C+',
                            $avg['average'] >= 55 => 'C',
                            $avg['average'] >= 50 => 'C-',
                            $avg['average'] >= 45 => 'D+',
                            $avg['average'] >= 40 => 'D',
                            default => 'F'
                        };
                        $badgeClass = str_starts_with($letter, 'A') ? 'bg-success' : (str_starts_with($letter, 'B') ? 'bg-primary' : (str_starts_with($letter, 'C') ? 'bg-warning' : (str_starts_with($letter, 'D') ? 'bg-danger' : 'bg-dark')));
                        ?>
                        <span class="badge <?= $badgeClass ?>"><?= $letter ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4 p-3 bg-light rounded">
            <strong>Class Statistics:</strong><br>
            Highest Average: <?= number_format(max(array_column($averages, 'average')), 2) ?>%<br>
            Lowest Average: <?= number_format(min(array_column($averages, 'average')), 2) ?>%<br>
            Class Average: <?= number_format(array_sum(array_column($averages, 'average')) / count($averages), 2) ?>%
        </div>
        <?php endif; ?>

        <div class="text-center mt-4 text-muted">
            <small>Generated on <?= date('d M Y H:i') ?> | VGSS Grading System</small>
        </div>
    </div>
</body>
</html>
