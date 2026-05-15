<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-building me-2"></i>Class List</span>
        <a href="<?= site_url('classes/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Add Class
        </a>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search classes..." value="<?= esc($search ?? '') ?>">
                    <button class="btn btn-outline-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
                    <?php if ($search): ?>
                    <a href="<?= site_url('classes') ?>" class="btn btn-outline-secondary btn-sm">Clear</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Class Code</th>
                        <th>Class Name</th>
                        <th>Academic Year</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($classes)): ?>
                    <tr><td colspan="5" class="text-center text-muted">No classes found.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($classes as $class): ?>
                    <tr>
                        <td><strong><?= esc($class['class_code']) ?></strong></td>
                        <td>
                            <a href="<?= site_url('classes/view/') ?><?= $class['id'] ?>"><?= esc($class['class_name']) ?></a>
                        </td>
                        <td><?= esc($class['academic_year']) ?></td>
                        <td><?= esc($class['section'] ?? '-') ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?= site_url('classes/view/') ?><?= $class['id'] ?>" class="btn btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                                <a href="<?= site_url('classes/edit/') ?><?= $class['id'] ?>" class="btn btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <a href="<?= site_url('classes/delete/') ?><?= $class['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" title="Delete"><i class="bi bi-trash"></i></a>
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
