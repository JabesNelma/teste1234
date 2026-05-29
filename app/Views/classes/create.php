<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Aumenta Turma</div>
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

        <form action="<?= site_url('classes/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="class_code" class="form-label">kode Klasse *</label>
                    <input type="text" name="class_code" id="class_code" class="form-control" value="<?= old('class_code') ?>" required>
                    <small class="text-muted">e.g., 10, 11, 12</small>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="class_name" class="form-label">Naran Turma *</label>
                    <input type="text" name="class_name" id="class_name" class="form-control" value="<?= old('class_name') ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="academic_year" class="form-label">Ano Letivu *</label>
                    <input type="text" name="academic_year" id="academic_year" class="form-control" value="<?= old('academic_year') ?>" placeholder="2025-2026" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="section" class="form-label">Area Estudu</label>
                    <input type="text" name="section" id="section" class="form-control" value="<?= old('section') ?>" placeholder="e.g., A, B, Science">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Rai Dadus Klasse</button>
                <a href="<?= site_url('classes') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Fila Fali ba Lista Klasse</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
