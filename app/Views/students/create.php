<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <i class="bi bi-person-plus me-2"></i>Aumenta Estudante Foun
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
                    <label for="student_id" class="form-label">Nu.Emis *</label>
                    <input type="text" name="student_id" id="student_id" class="form-control" value="<?= old('student_id') ?>" required>
                    <small class="text-muted">Format: ESGC-YYYY-NNN (e.g., ESGV-2025-011)</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="full_name" class="form-label">Naran Kompletu *</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" value="<?= old('full_name') ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="gender" class="form-label">Sexu *</label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="">Hili Sexu</option>
                        <option value="mane" <?= in_array(old('gender'), ['mane', 'male']) ? 'selected' : '' ?>>Mane</option>
                        <option value="feto" <?= in_array(old('gender'), ['feto', 'female']) ? 'selected' : '' ?>>Feto</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date_of_birth" class="form-label">Data Moris *</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="<?= old('date_of_birth') ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="class_id" class="form-label">Klasse *</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Hili Klasse</option>
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
                    <label for="parent_name" class="form-label">Enkaregadu/Responsabilidade</label>
                    <input type="text" name="parent_name" id="parent_name" class="form-control" value="<?= old('parent_name') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="parent_phone" class="form-label">Numeru Telefone Enkaregadu</label>
                    <input type="text" name="parent_phone" id="parent_phone" class="form-control" value="<?= old('parent_phone') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Hela Fatin</label>
                <textarea name="address" id="address" class="form-control" rows="2"><?= old('address') ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="enrollment_date" class="form-label">Data Inskrisaun *</label>
                    <input type="date" name="enrollment_date" id="enrollment_date" class="form-control" value="<?= old('enrollment_date') ?>" required>
                </div>
                
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Rai Dadus Estudante</button>
                <a href="<?= site_url('students') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Fila Fali ba Lista Estudante</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
