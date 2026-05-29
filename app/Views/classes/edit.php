<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header"><i class="bi bi-pencil me-2"></i>Edit Klasse</div>
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

        <form action="<?= site_url('classes/update/') ?><?= $class['id'] ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="class_code" class="form-label">Kode Klasse *</label>
                    <input type="text" name="class_code" id="class_code" class="form-control" value="<?= old('class_code', $class['class_code']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="class_name" class="form-label">Naran Klasse *</label>
                    <input type="text" name="class_name" id="class_name" class="form-control" value="<?= old('class_name', $class['class_name']) ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="academic_year" class="form-label">Anu Letivu*</label>
                    <input type="text" name="academic_year" id="academic_year" class="form-control" value="<?= old('academic_year', $class['academic_year']) ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="section" class="form-label">Area Estudu</label>
                    <input type="text" name="section" id="section" class="form-control" value="<?= old('section', $class['section']) ?>">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Atualiza Klasse</button>
                <a href="<?= site_url('classes') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Fila Fali ba Lista Klasse</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
