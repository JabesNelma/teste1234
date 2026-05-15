<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people me-2"></i>Student List</span>
        <a href="<?= site_url('students/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Add Student
        </a>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name or ID..." value="<?= esc($search ?? '') ?>">
                    <button class="btn btn-outline-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
                    <?php if ($search): ?>
                    <a href="<?= site_url('students') ?>" class="btn btn-outline-secondary btn-sm">Clear</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Parent/Guardian</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($students)): ?>
                    <tr><td colspan="7" class="text-center text-muted">No students found.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($students as $student): ?>
                    <tr>
                        <td><strong><?= esc($student['student_id']) ?></strong></td>
                        <td>
                            <a href="<?= site_url('students/view/') ?><?= $student['id'] ?>"><?= esc($student['full_name']) ?></a>
                        </td>
                        <td><?= ucfirst($student['gender']) ?></td>
                        <td><?= esc($student['class_name'] ?? '-') ?></td>
                        <td><?= esc($student['parent_name'] ?? '-') ?></td>
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
                            <div class="btn-group btn-group-sm">
                                <a href="<?= site_url('students/view/') ?><?= $student['id'] ?>" class="btn btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= site_url('students/edit/') ?><?= $student['id'] ?>" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= site_url('students/delete/') ?><?= $student['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this student?')" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
