<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-building me-2"></i>Class Information
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th width="40%">Class Code</th><td><?= esc($class['class_code']) ?></td></tr>
                    <tr><th>Class Name</th><td><?= esc($class['class_name']) ?></td></tr>
                    <tr><th>Academic Year</th><td><?= esc($class['academic_year']) ?></td></tr>
                    <tr><th>Section</th><td><?= esc($class['section'] ?? '-') ?></td></tr>
                </table>
                <div class="d-flex gap-2 mt-3">
                    <a href="<?= site_url('classes/edit/') ?><?= $class['id'] ?>" class="btn btn-warning btn-sm flex-grow-1"><i class="bi bi-pencil me-1"></i>Edit</a>
                    <a href="<?= site_url('reports/class') ?>?class_id=<?= $class['id'] ?>&term=Term 1&year=<?= esc($class['academic_year']) ?>" class="btn btn-info btn-sm flex-grow-1"><i class="bi bi-printer me-1"></i>Report</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-people me-2"></i>Students in this Class</span>
                <span class="badge bg-primary"><?= count($students) ?> Students</span>
            </div>
            <div class="card-body">
                <?php if (empty($students)): ?>
                    <p class="text-muted text-center">No students enrolled in this class yet.</p>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Full Name</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student): ?>
                            <tr>
                                <td><strong><?= esc($student['student_id']) ?></strong></td>
                                <td><?= esc($student['full_name']) ?></td>
                                <td><?= ucfirst($student['gender']) ?></td>
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
                                <td>
                                    <a href="<?= site_url('students/view/') ?><?= $student['id'] ?>" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a>
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
