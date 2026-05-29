<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people me-2"></i>Lista Estudante</span>
        <a href="<?= site_url('students/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Aumenta Estudante
        </a>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Buka uza Naran/Nu.Emis..." value="<?= esc($search ?? '') ?>">
                    <button class="btn btn-outline-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
                    <?php if ($search): ?>
                    <a href="<?= site_url('students') ?>" class="btn btn-outline-secondary btn-sm">Hamos</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nu.Emis</th>
                        <th>Naran Kompletu</th>
                        <th>Sexu</th>
                        <th>Klasse</th>
                        <th>Enkaregadu/Responsabilida</th>
                       
                        <th>Aksaun</th>
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
                            <p <?= site_url('students/view/') ?><?= $student['id'] ?>"><?= esc($student['full_name']) ?></p>
                        </td>
                        <td><?= $student['gender'] === 'male' ? 'Mane' : 'Feto' ?></td>
                        <td><?= esc($student['class_name'] ?? '-') ?></td>
                        <td><?= esc($student['parent_name'] ?? '-') ?></td>
                        
                        <td>
                            <div class="btn-group btn-group-sm">
                                
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
