<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="stat-card bg-gradient-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><?= $total_students ?></h3>
                    <p>Total Estudante</p>
                </div>
                <i class="bi bi-people fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card bg-gradient-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><?= $total_subjects ?></h3>
                    <p>Total Materia</p>
                </div>
                <i class="bi bi-book fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card bg-gradient-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3><?= $total_classes ?></h3>
                    <p>Total Turma</p>
                </div>
                <i class="bi bi-building fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card bg-gradient-info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>3</h3>
                    <p>Periodu</p>
                </div>
                <i class="bi bi-calendar3 fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-people me-2"></i>Lista Estudante</span>
                <p href="<?= site_url('students') ?>" class="btn btn-sm btn-primary">Rezultadu Estudante</p>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nu.Emis</th>
                            <th>Naran</th>
                            <th>Klasse</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_students as $student): ?>
                        <tr>
                            <td><small><?= esc($student['student_id']) ?></small></td>
                            <td>
                                <p href="<?= site_url('students/view/') ?><?= $student['id'] ?>"><?= esc($student['full_name']) ?></p>
                            </td>
                            <td><small><?= esc($student['class_name']) ?></small></td>
                            
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-journal-text me-2"></i>Lista Valor</span>
                <p href="<?= site_url('grades') ?>" class="btn btn-sm btn-primary">Rezultadu Valor</p>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Estudante</th>
                            <th>Materia</th>
                            <th>Valor</th>
                            <th>Kategoria</th>
                            <th>Turma</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_grades as $grade): ?>
                        <tr>
                            <td><small><?= esc($grade['student_name']) ?></small></td>
                            <td><small><?= esc($grade['subject_name']) ?></small></td>
                            <td class="fw-bold"><?= number_format($grade['score'], 1) ?></td>
                            <td>
                                <?php if ($grade['score'] >= 10): ?>
                                    <span class="badge bg-primary">Excelente</span>
                                <?php elseif ($grade['score'] >= 9): ?>
                                    <span class="badge bg-info text-dark">Muito Bom</span>
                                <?php elseif ($grade['score'] >= 8): ?>
                                    <span class="badge bg-warning text-dark">Bom</span>
                                <?php elseif ($grade['score'] >= 7): ?>
                                    <span class="badge bg-warning text-dark">Razoavel</span>
                                <?php elseif ($grade['score'] >= 6): ?>
                                    <span class="badge bg-warning text-dark">Suficiente</span>
                                <?php elseif ($grade['score'] >= 5): ?>
                                    <span class="badge bg-warning text-dark">Insuficiente</span>
                                <?php elseif ($grade['score'] >= 4): ?>
                                    <span class="badge bg-warning text-dark">Mediocre</span>
                                <?php elseif ($grade['score'] >= 3): ?>
                                    <span class="badge bg-warning text-dark">Mau</span>
                                <?php elseif ($grade['score'] >= 2): ?>
                                    <span class="badge bg-warning text-dark">Muito Mau</span>
                                <?php elseif ($grade['score'] >= 1): ?>
                                    <span class="badge bg-warning text-dark">Mau</span>
                                <?php else: ?>
                                <?php endif; ?>
                            </td>
                            <td><small><?= esc($grade['class_name'] ?? '-') ?></small></td>
                            <td>
                                
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
