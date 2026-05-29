<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-book me-2"></i>Informasaun Materia
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th width="40%">Kode Materia</th><td><?= esc($subject['subject_code']) ?></td></tr>
                    <tr><th>Naran Materia</th><td><?= esc($subject['subject_name']) ?></td></tr>
                </table>
                <div class="mb-3">
                    <strong>Deskrisaun:</strong><br>
                    <p class="text-muted small"><?= esc($subject['description'] ?: 'No description available.') ?></p>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <a href="<?= site_url('subjects/edit/') ?><?= $subject['id'] ?>" class="btn btn-warning btn-sm flex-grow-1"><i class="bi bi-pencil me-1"></i>Edit</a>
                    <a href="<?= site_url('subjects') ?>" class="btn btn-secondary btn-sm flex-grow-1"><i class="bi bi-arrow-left me-1"></i>Fila</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-journal-text me-2"></i>Recent Grades for this Subject</span>
            </div>
            <div class="card-body">
                <?php if (empty($recent_grades)): ?>
                    <p class="text-muted text-center">No grades recorded for this subject yet.</p>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nu.Emis</th>
                                <th>Naran Estudante</th>
                                <th>Periodu/Tinan</th>
                                <th>Total Valor</th>
                                <th>Valor Medio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_grades as $grade): ?>
                            <tr>
                                <td><small><?= esc($grade['student_code']) ?></small></td>
                                <td><?= esc($grade['student_name']) ?></td>
                                <td><small><?= esc($grade['academic_term']) ?> / <?= esc($grade['academic_year']) ?></small></td>
                                                                <td class="fw-bold"><?= number_format($grade['score'], 1) ?></td>
                                                                <td>
                                                                    <?php if ($grade['score'] >= 5): ?>
                                                                        <span class="badge bg-success">Aprovado</span>
                                                                    <?php else: ?>
                                                                        <span class="badge bg-danger">Reprovado</span>
                                                                    <?php endif; ?>
                                                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
