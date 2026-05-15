<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <i class="bi bi-person-plus me-2"></i>Add New Student
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('students/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="student_id" class="form-label">Student ID *</label>
                    <input type="text" name="student_id" id="student_id" class="form-control" value="<?= old('student_id') ?>" required>
                    <small class="text-muted">Format: VGSS-YYYY-NNN (e.g., VGSS-2025-011)</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="full_name" class="form-label">Full Name *</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" value="<?= old('full_name') ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="gender" class="form-label">Gender *</label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="">Select Gender</option>
                        <option value="male" <?= old('gender') === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= old('gender') === 'female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth *</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= old('date_of_birth') ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="class_id" class="form-label">Class *</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>" <?= old('class_id') == $class['id'] ? 'selected' : '' ?>>
                                <?= esc($class['class_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="parent_name" class="form-label">Parent/Guardian Name</label>
                    <input type="text" name="parent_name" id="parent_name" class="form-control" value="<?= old('parent_name') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="parent_phone" class="form-label">Parent Phone</label>
                    <input type="text" name="parent_phone" id="parent_phone" class="form-control" value="<?= old('parent_phone') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control" rows="2"><?= old('address') ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="enrollment_date" class="form-label">Enrollment Date *</label>
                    <input type="date" name="enrollment_date" id="enrollment_date" class="form-control" value="<?= old('enrollment_date') ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="active" <?= old('status') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        <option value="graduated" <?= old('status') === 'graduated' ? 'selected' : '' ?>>Graduated</option>
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Save Student</button>
                <a href="<?= site_url('students') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Back to List</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
