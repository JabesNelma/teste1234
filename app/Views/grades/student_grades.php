<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><i class="bi bi-person me-2"></i>Student Info</div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width:60px;height:60px;font-size:1.5rem">
                        <?= strtoupper(substr($student['full_name'], 0, 1)) ?>
                    </div>
                </div>
                <table class="table table-sm">
                    <tr><th>Student ID</th><td><?= esc($student['student_id']) ?></td></tr>
                    <tr><th>Name</th><td><?= esc($student['full_name']) ?></td></tr>
                    <tr><th>Class</th><td><?= esc($student['class_name']) ?></td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header"><i class="bi bi-bar-chart me-2"></i>Academic Summary</div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <h3 class="text-primary"><?= $gpa['gpa'] ?></h3>
                        <small>GPA</small>
                    </div>
                    <div class="col-4">
                        <h3 class="text-success"><?= $gpa['average'] ?>%</h3>
                        <small>Average</small>
                    </div>
                    <div class="col-4">
                        <h3 class="text-warning"><?= $gpa['total_subjects'] ?></h3>
                        <small>Subjects</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><i class="bi bi-journal-text me-2"></i>Grades</div>
            <div class="card-body">
                <?php if (empty($grades)): ?>
                    <p class="text-muted text-center">No grades recorded.</p>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
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
                                <td><?= esc($grade['academic_term']) ?> / <?= esc($grade['academic_year']) ?></td>
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
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
