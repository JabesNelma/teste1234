<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-book me-2"></i>Lista Materia</span>
        <a href="<?= site_url('subjects/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Aumenta Materia
        </a>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Buka uza Naran/Kode..." value="<?= esc($search ?? '') ?>">
                    <button class="btn btn-outline-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
                    <?php if ($search): ?>
                    <a href="<?= site_url('subjects') ?>" class="btn btn-outline-secondary btn-sm">Hamos</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode Materia</th>
                        <th>Naran Materia</th>
                        <th>Deskrisaun</th>
                        <th>Aksaun</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($subjects)): ?>
                    <tr><td colspan="4" class="text-center text-muted">No subjects found.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($subjects as $subject): ?>
                    <tr>
                        <td><strong><?= esc($subject['subject_code']) ?></strong></td>
                        <td>
                            <p href="<?= site_url('subjects/view/') ?><?= $subject['id'] ?>"><?= esc($subject['subject_name']) ?></p>
                        </td>
                        <td><?= esc($subject['description'] ?? '-') ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                
                                <a href="<?= site_url('subjects/edit/') ?><?= $subject['id'] ?>" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?= site_url('subjects/delete/') ?><?= $subject['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this subject?')" title="Delete">
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
