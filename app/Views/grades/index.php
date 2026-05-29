<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-journal-text me-2"></i>Maneja Valor</span>
        <a href="<?= site_url('grades/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Aumenta Valor
        </a>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <select name="class_id" class="form-select form-select-sm" required>
                    <option value="">Hili Klasse</option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?= $class['id'] ?>" <?= $selected_class == $class['id'] ? 'selected' : '' ?>>
                            <?= esc($class['class_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="term" class="form-select form-select-sm" required>
                    <option value="">Hili Periodu</option>
                    <option value="Term 1" <?= $selected_term === 'Term 1' ? 'selected' : '' ?>>Periodu 1</option>
                    <option value="Term 2" <?= $selected_term === 'Term 2' ? 'selected' : '' ?>>Periodu 2</option>
                    <option value="Term 3" <?= $selected_term === 'Term 3' ? 'selected' : '' ?>>Periodu 3</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="year" class="form-control form-control-sm" placeholder="Anu Letivu" value="<?= esc($selected_year ?? '') ?>" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-sm w-100" type="submit"><i class="bi bi-search me-1"></i>Selesiona Rezultadu</button>
            </div>
        </form>

        <?php if (!empty($grades)): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nu.Emis</th>
                        <th>Naran Estudante</th>
                        <th>Materia</th>
                        <th>Periodu</th>
                        <th>Rezultadu</th>
                        <th>Kategoria</th>
                        <th>Klasse</th>
                        <th>Aksaun</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grades as $grade): ?>
                    <tr>
                        <td><strong><?= esc($grade['student_code']) ?></strong></td>
                        <td>
                            <a href="<?= site_url('students/view/') ?><?= $grade['student_id'] ?>"><?= esc($grade['student_name']) ?></a>
                        </td>
                        <td><?= esc($grade['subject_name']) ?></td>
                        <td><?= esc($grade['academic_term']) ?> / <?= esc($grade['academic_year']) ?></td>
                        <td>
                            <span class="fw-bold"><?= number_format($grade['score'], 1) ?></span>
                            <?php if ($grade['score'] >= 5): ?>
                                <span class="badge bg-success ms-1"></span>
                            <?php else: ?>
                                <span class="badge bg-danger ms-1"></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($grade['score'] >= 10): ?>
                                <span class="badge bg-primary">Muito Bom</span>
                            <?php elseif ($grade['score'] >= 8): ?>
                                <span class="badge bg-info text-dark">Bom</span>
                            <?php elseif ($grade['score'] >= 6): ?>
                                <span class="badge bg-warning text-dark">Suficiente</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Insuficiente</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($grade['class_name'] ?? '-') ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?= site_url('grades/edit/') ?><?= $grade['id'] ?>" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <a href="<?= site_url('grades/delete/') ?><?= $grade['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Delete this grade?')"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php elseif ($selected_class): ?>
        <p class="text-muted text-center">No grades found for the selected criteria.</p>
        <?php else: ?>
        <p class="text-muted text-center">Please select a class, term, and academic year to view grades.</p>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
