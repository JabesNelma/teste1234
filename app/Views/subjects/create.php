<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <i class="bi bi-plus-circle me-2"></i>Add New Subject
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

        <form action="<?= site_url('subjects/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="subject_code" class="form-label">Subject Code *</label>
                    <input type="text" name="subject_code" id="subject_code" class="form-control" value="<?= old('subject_code') ?>" required>
                    <small class="text-muted">e.g., MATH, ENG, SCI</small>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="subject_name" class="form-label">Subject Name *</label>
                    <input type="text" name="subject_name" id="subject_name" class="form-control" value="<?= old('subject_name') ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3"><?= old('description') ?></textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Save Subject</button>
                <a href="<?= site_url('subjects') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Back to List</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
