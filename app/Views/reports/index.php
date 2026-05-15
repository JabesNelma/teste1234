<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-person me-2"></i>Student Report</div>
            <div class="card-body">
                <p>Generate a detailed report card for a specific student including all grades, GPA, and remarks.</p>
                <form action="<?= site_url('reports/student') ?>" method="GET">
                    <div class="mb-3">
                        <label class="form-label">Select Student</label>
                        <select name="student_id" class="form-select" required>
                            <option value="">-- Select Student --</option>
                            <?php foreach ($students as $student): ?>
                                <option value="<?= $student['id'] ?>"><?= esc($student['student_id']) ?> - <?= esc($student['full_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-file-earmark-text me-1"></i>Generate Report</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><i class="bi bi-building me-2"></i>Class Report</div>
            <div class="card-body">
                <p>Generate a class summary report showing average scores for all students in a class for a specific term.</p>
                <form action="<?= site_url('reports/class') ?>" method="GET">
                    <div class="mb-3">
                        <label class="form-label">Select Class</label>
                        <select name="class_id" class="form-select" required>
                            <option value="">-- Select Class --</option>
                            <?php foreach ($classes as $class): ?>
                                <option value="<?= $class['id'] ?>"><?= esc($class['class_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Term</label>
                            <select name="term" class="form-select" required>
                                <option value="">Select</option>
                                <option value="Term 1">Term 1</option>
                                <option value="Term 2">Term 2</option>
                                <option value="Term 3">Term 3</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Academic Year</label>
                            <input type="text" name="year" class="form-control" value="2025-2026" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-bar-graph me-1"></i>Generate Report</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
