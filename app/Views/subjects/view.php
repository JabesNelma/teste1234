<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-book me-2"></i>Subject Information
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th width="40%">Subject Code</th><td><?= esc($subject['subject_code']) ?></td></tr>
                    <tr><th>Subject Name</th><td><?= esc($subject['subject_name']) ?></td></tr>
                </table>
                <div class="mb-3">
                    <strong>Description:</strong><br>
                    <p class="text-muted small"><?= esc($subject['description'] ?: 'No description available.') ?></p>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <a href="<?= site_url('subjects/edit/') ?><?= $subject['id'] ?>" class="btn btn-warning btn-sm flex-grow-1"><i class="bi bi-pencil me-1"></i>Edit</a>
                    <a href="<?= site_url('subjects') ?>" class="btn btn-secondary btn-sm flex-grow-1"><i class="bi bi-arrow-left me-1"></i>Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-journal-text me-2"></i>Recent Grades for this Subject</span>
            </div>
            <div class="card-body">
                <?php if (empty($recent_grades)): ?>
                    <p class="text-muted text-center">No grades recorded for this subject yet.</p>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Term/Year</th>
                                <th>Score</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_grades as $grade): ?>
                            <tr>
                                <td><small><?= esc($grade['student_code']) ?></small></td>
                                <td><?= esc($grade['student_name']) ?></td>
                                <td><small><?= esc($grade['academic_term']) ?> / <?= esc($grade['academic_year']) ?></small></td>
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
