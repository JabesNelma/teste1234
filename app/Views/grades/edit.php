<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header"><i class="bi bi-pencil me-2"></i>Edit Valor</div>
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

        <form action="<?= site_url('grades/update/') ?><?= $grade['id'] ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="class_id" class="form-label">Klasse *</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Hili Klasse</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>" <?= old('class_id', $grade['class_id']) == $class['id'] ? 'selected' : '' ?>>
                                <?= esc($class['class_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="student_id" class="form-label">Estudante *</label>
                    <select name="student_id" id="student_id" class="form-select" required>
                        <option value="">Hili Estudante</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?= $student['id'] ?>" <?= old('student_id', $grade['student_id']) == $student['id'] ? 'selected' : '' ?>>
                                <?= esc($student['full_name']) ?> (<?= esc($student['student_id']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="subject_id" class="form-label">Materia *</label>
                    <select name="subject_id" id="subject_id" class="form-select" required>
                        <option value="">Hili Materia</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?= $subject['id'] ?>" <?= old('subject_id', $grade['subject_id']) == $subject['id'] ? 'selected' : '' ?>>
                                <?= esc($subject['subject_code']) ?> - <?= esc($subject['subject_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="academic_term" class="form-label">Academic Term *</label>
                    <select name="academic_term" id="academic_term" class="form-select" required>
                        <option value="">Hili Periodu</option>
                        <option value="Term 1" <?= old('academic_term', $grade['academic_term']) === 'Term 1' ? 'selected' : '' ?>>Periodu 1</option>
                        <option value="Term 2" <?= old('academic_term', $grade['academic_term']) === 'Term 2' ? 'selected' : '' ?>>Periodu 2</option>
                        <option value="Term 3" <?= old('academic_term', $grade['academic_term']) === 'Term 3' ? 'selected' : '' ?>>Periodu 3</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="academic_year" class="form-label">Anu Letivu *</label>
                    <input type="text" name="academic_year" id="academic_year" class="form-control" value="<?= old('academic_year', $grade['academic_year']) ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="score" class="form-label">Valor (0-10) *</label>
                    <input type="number" name="score" id="score" class="form-control" min="0" max="10" step="0.1" value="<?= old('score', $grade['score']) ?>" required>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Update Grade</button>
                <a href="<?= site_url('grades') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Fila Fali ba Lista Vaor</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('class_id').addEventListener('change', function() {
    const classId = this.value;
    const studentSelect = document.getElementById('student_id');
    
    if (classId) {
        fetch(`<?= site_url('grades/get-students-by-class') ?>?class_id=${classId}`)
            .then(response => response.json())
            .then(students => {
                studentSelect.innerHTML = '<option value="">Select Student</option>';
                students.forEach(student => {
                    const option = document.createElement('option');
                    option.value = student.id;
                    option.textContent = `${student.full_name} (${student.student_id})`;
                    studentSelect.appendChild(option);
                });
            });
    } else {
        studentSelect.innerHTML = '<option value="">Select Class First</option>';
    }
});
</script>
<?= $this->endSection() ?>
