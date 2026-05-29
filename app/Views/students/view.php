<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-transparent p-0 mb-0">
        <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>" class="text-decoration-none"><i class="bi bi-speedometer2 me-1"></i>Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('students') ?>" class="text-decoration-none"><i class="bi bi-people me-1"></i>Estudante</a></li>
        <li class="breadcrumb-item active fw-semibold"><?= esc($student['full_name']) ?></li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center p-4">
                <div class="position-relative d-inline-block mb-3">
                    <div class="bg-gradient-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width:100px;height:100px;font-size:2.5rem;font-weight:700">
                        <?= strtoupper(substr($student['full_name'], 0, 1)) ?>
                    </div>
                    <span class="position-absolute bottom-0 end-0 p-1 bg-white rounded-circle">
                        <?php
                        $icon = match($student['gender']) {
                            'male' => 'bi-gender-male text-primary',
                            'female' => 'bi-gender-female text-danger',
                            default => 'bi-person text-muted'
                        };
                        ?>
                        <i class="bi <?= $icon ?> fs-5"></i>
                    </span>
                </div>
                <h4 class="fw-bold mb-1"><?= esc($student['full_name']) ?></h4>
                <p class="text-muted mb-2"><small>#<?= esc($student['student_id']) ?></small></p>
                <?php
                $badge = match($student['status']) {
                    'active' => 'bg-success',
                    'inactive' => 'bg-secondary',
                    'graduated' => 'bg-info',
                    default => 'bg-secondary'
                };
                ?>
                <span class="badge <?= $badge ?> fs-6 px-3 py-2 mb-3 d-inline-block"><?= ucfirst($student['status']) ?></span>
                <hr>
                <div class="text-start small">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted"><i class="bi bi-building me-1"></i>Klasse</span>
                        <span class="fw-medium"><?= esc($student['class_name']) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted"><i class="bi bi-gender-<?= $student['gender'] === 'male' ? 'male' : 'female' ?> me-1"></i>Sexu</span>
                        <span class="fw-medium"><?= $student['gender'] === 'male' ? 'Mane' : 'Feto' ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted"><i class="bi bi-calendar me-1"></i>Data Moris</span>
                        <span class="fw-medium"><?= date('d M Y', strtotime($student['date_of_birth'])) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted"><i class="bi bi-calendar-check me-1"></i>Enrolled</span>
                        <span class="fw-medium"><?= date('d M Y', strtotime($student['enrollment_date'])) ?></span>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-0 p-3 pt-0">
                <div class="d-grid gap-2">
                    <a href="<?= site_url('students/edit/') ?><?= $student['id'] ?>" class="btn btn-warning"><i class="bi bi-pencil me-1"></i>Edit Profile</a>
                    <a href="<?= site_url('reports/student') ?>?student_id=<?= $student['id'] ?>" class="btn btn-info text-white"><i class="bi bi-printer me-1"></i>Relatoriu Kaderneta</a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2"></i>Kontaktu Informasaun</h6>
            </div>
            <div class="card-body pt-3">
                <div class="small">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width:36px;height:36px">
                            <i class="bi bi-person text-primary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Enkaregadu/Responsabilidade</small>
                            <span class="fw-medium"><?= esc($student['parent_name'] ?? '-') ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width:36px;height:36px">
                            <i class="bi bi-telephone text-success"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Numeru Telefone</small>
                            <span class="fw-medium"><?= esc($student['parent_phone'] ?? '-') ?></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width:36px;height:36px">
                            <i class="bi bi-geo-alt text-danger"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Hela Fatin</small>
                            <span class="fw-medium"><?= esc($student['address'] ?? '-') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-gradient-primary text-white h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-trophy fs-1 mb-2 d-block"></i>
                        <h2 class="fw-bold mb-0"><?= number_format($gpa['gpa'], 2) ?></h2>
                        <small class="opacity-75">GPA (4.0 Scale)</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-gradient-success text-white h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-graph-up-arrow fs-1 mb-2 d-block"></i>
                    <h2 class="fw-bold mb-0"><?= number_format($gpa['average'], 1) ?></h2>
                    <small class="opacity-75">Average Score</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-gradient-warning text-white h-100">
                    <div class="card-body text-center py-4">
                        <i class="bi bi-book fs-1 mb-2 d-block"></i>
                        <h2 class="fw-bold mb-0"><?= $gpa['total_subjects'] ?></h2>
                        <small class="opacity-75">Subjects Taken</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-journal-text me-2"></i>Grade Records</h6>
                <a href="<?= site_url('grades/create') ?>?student_id=<?= $student['id'] ?>&class_id=<?= $student['class_id'] ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i>Add Grade
                </a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($grades)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                    <p class="text-muted mb-0">No grades recorded yet.</p>
                    <a href="<?= site_url('grades/create') ?>?student_id=<?= $student['id'] ?>&class_id=<?= $student['class_id'] ?>" class="btn btn-outline-primary btn-sm mt-2">
                        <i class="bi bi-plus-lg me-1"></i>Add First Grade
                    </a>
                </div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Subject</th>
                                <th>Term</th>
                                <th>Score</th>
                                <th>Grade</th>
                                <th>Remarks</th>
                                <th>Teacher</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grades as $grade): ?>
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-medium"><?= esc($grade['subject_name']) ?></div>
                                    <small class="text-muted"><?= esc($grade['subject_code']) ?></small>
                                </td>
                                <td><span class="badge bg-light text-dark"><?= esc($grade['academic_term']) ?> <?= esc($grade['academic_year']) ?></span></td>
                                                                <td class="fw-bold"><?= number_format($grade['score'], 1) ?></td>
                                                                <td>
                                                                    <?php if ($grade['score'] >= 5): ?>
                                                                        <span class="badge bg-success">Aprovado</span>
                                                                    <?php else: ?>
                                                                        <span class="badge bg-danger">Reprovado</span>
                                                                    <?php endif; ?>
                                                                </td>
                                <td><small class="text-muted"><?= esc($grade['remarks'] ?? '-') ?></small></td>
                                <td><small class="text-muted"><?= esc($grade['teacher_name'] ?? '-') ?></small></td>
                                <td class="text-end pe-3">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= site_url('grades/edit/') ?><?= $grade['id'] ?>" class="btn btn-outline-warning" title="Edit" data-bs-toggle="tooltip"><i class="bi bi-pencil"></i></a>
                                        <a href="<?= site_url('grades/delete/') ?><?= $grade['id'] ?>" class="btn btn-outline-danger" title="Delete" data-bs-toggle="tooltip" onclick="return confirm('Delete this grade?')"><i class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <?php if (!empty($grades)): ?>
            <div class="card-footer bg-white border-top-0 text-end py-2">
                <small class="text-muted">Showing <?= count($grades) ?> grade record<?= count($grades) !== 1 ? 's' : '' ?></small>
            </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($grades)): ?>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-bar-chart-line me-2"></i>Performance Overview</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Materia</th>
                                <th>Score</th>
                                <th style="width:40%">Progress</th>
                                <th class="text-end">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grades as $grade):
                                $barColor = $grade['score'] >= 8 ? 'bg-success' : ($grade['score'] >= 5 ? 'bg-warning' : 'bg-danger');
                            ?>
                            <tr>
                                <td><span class="fw-medium"><?= esc($grade['subject_name']) ?></span></td>
                                <td class="fw-bold"><?= number_format($grade['score'], 1) ?></td>
                                <td>
                                    <div class="progress" style="height:8px">
                                        <div class="progress-bar <?= $barColor ?>" role="progressbar" style="width:<?= $grade['score'] * 10 ?>%" aria-valuenow="<?= $grade['score'] ?>" aria-valuemin="0" aria-valuemax="10"></div>
                                    </div>
                                </td>
                                <td class="text-end">
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
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltips.map(function (el) { return new bootstrap.Tooltip(el); });
    });
</script>
<?= $this->endSection() ?>
