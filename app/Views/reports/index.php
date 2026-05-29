<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-person me-2"></i>Caderneta Estudante</div>
            <div class="card-body">
                <p>Relatoriu detalhadu ba estudante ida inklui valor no observasaun sira.</p>
                <form action="<?= site_url('reports/student') ?>" method="GET">
                    <div class="mb-3">
                        <label class="form-label">Hili Estudante</label>
                        <select name="student_id" class="form-select" required>
                            <option value="">-- Hili Estudante --</option>
                            <?php foreach ($students as $student): ?>
                                <option value="<?= $student['id'] ?>"><?= esc($student['student_id']) ?> - <?= esc($student['full_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-file-earmark-text me-1"></i>Relatoriu Kaderneta Estudante</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-building me-2"></i>Caderneta Klasse</div>
            <div class="card-body">
                <p>Relatoriu Kaderneta Turma nian ne'ebe hatudu valor hotu-hotu iha turma ida.</p>
                <form action="<?= site_url('reports/class') ?>" method="GET">
                    <div class="mb-3">
                        <label class="form-label">Selesiona Klasse</label>
                        <select name="class_id" class="form-select" required>
                            <option value="">-- Selesiona Klasse --</option>
                            <?php foreach ($classes as $class): ?>
                                <option value="<?= $class['id'] ?>"><?= esc($class['class_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Periodu</label>
                            <select name="term" class="form-select" required>
                                <option value="">Hili</option>
                                <option value="Term 1">Periodu 1</option>
                                <option value="Term 2">Periodu 2</option>
                                <option value="Term 3">Periodu 3</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Ano Letivu</label>
                            <input type="text" name="year" class="form-control" value="2025-2026" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-bar-graph me-1"></i>Relatoriu Kaderneta Turma nian</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
