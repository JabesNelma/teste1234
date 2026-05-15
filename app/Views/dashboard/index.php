<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="stat-card bg-gradient-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><?= $total_students ?></h3>
                    <p>Total Students</p>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card bg-gradient-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><?= $total_subjects ?></h3>
                    <p>Total Subjects</p>
                </div>
                <i class="bi bi-book fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card bg-gradient-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><?= $total_classes ?></h3>
                    <p>Total Classes</p>
                </div>
                <i class="bi bi-building fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card bg-gradient-info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>3</h3>
                    <p>Academic Terms</p>
                </div>
                <i class="bi bi-calendar3 fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-people me-2"></i>Recent Students</span>
                <a href="<?= site_url('students') ?>" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_students as $student): ?>
                        <tr>
                            <td><small><?= esc($student['student_id']) ?></small></td>
                            <td>
                                <a href="<?= site_url('students/view/') ?><?= $student['id'] ?>"><?= esc($student['full_name']) ?></a>
                            </td>
                            <td><small><?= esc($student['class_name']) ?></small></td>
                            <td>
                                <?php
                                $badge = match($student['status']) {
                                    'active' => 'bg-success',
                                    'inactive' => 'bg-secondary',
                                    'graduated' => 'bg-info',
                                    default => 'bg-secondary'
                                };
                                ?>
                                <span class="badge <?= $badge ?>"><?= ucfirst($student['status']) ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-journal-text me-2"></i>Recent Grades</span>
                <a href="<?= site_url('grades') ?>" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Subject</th>
                            <th>Score</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_grades as $grade): ?>
                        <tr>
                            <td><small><?= esc($grade['student_name']) ?></small></td>
                            <td><small><?= esc($grade['subject_name']) ?></small></td>
                            <td><?= number_format($grade['score'], 1) ?></td>
                            <td>
                                <?php
                                $letter = strtoupper($grade['grade_letter'] ?? '');
                                $class = str_starts_with($letter, 'A') ? 'grade-a' :
                                        (str_starts_with($letter, 'B') ? 'grade-b' :
                                        (str_starts_with($letter, 'C') ? 'grade-c' :
                                        (str_starts_with($letter, 'D') ? 'grade-d' : 'grade-f')));
                                ?>
                                <span class="badge-grade <?= $class ?>"><?= $letter ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-lightning me-2"></i>Quick Actions
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="<?= site_url('students/create') ?>" class="btn btn-outline-primary w-100">
                            <i class="bi bi-person-plus me-2"></i>Add Student
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="<?= site_url('subjects/create') ?>" class="btn btn-outline-success w-100">
                            <i class="bi bi-plus-circle me-2"></i>Add Subject
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="<?= site_url('grades/create') ?>" class="btn btn-outline-warning w-100">
                            <i class="bi bi-pencil-square me-2"></i>Enter Grades
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="<?= site_url('reports') ?>" class="btn btn-outline-info w-100">
                            <i class="bi bi-file-earmark-bar-graph me-2"></i>Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
