<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Add New Grade</div>
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

        <form action="<?= site_url('grades/store') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="class_id" class="form-label">Class *</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>" <?= $selected_class == $class['id'] ? 'selected' : '' ?>>
                                <?= esc($class['class_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="student_id" class="form-label">Student *</label>
                    <select name="student_id" id="student_id" class="form-select" required>
                        <option value="">Select Student</option>
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $student): ?>
                                <option value="<?= $student['id'] ?>" <?= $selected_student == $student['id'] ? 'selected' : '' ?>>
                                    <?= esc($student['full_name']) ?> (<?= esc($student['student_id']) ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Select Class First</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="subject_id" class="form-label">Subject *</label>
                    <select name="subject_id" id="subject_id" class="form-select" required>
                        <option value="">Select Subject</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?= $subject['id'] ?>" <?= old('subject_id') == $subject['id'] ? 'selected' : '' ?>>
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
                        <option value="">Select Term</option>
                        <option value="Term 1" <?= old('academic_term') === 'Term 1' ? 'selected' : '' ?>>Term 1</option>
                        <option value="Term 2" <?= old('academic_term') === 'Term 2' ? 'selected' : '' ?>>Term 2</option>
                        <option value="Term 3" <?= old('academic_term') === 'Term 3' ? 'selected' : '' ?>>Term 3</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="academic_year" class="form-label">Academic Year *</label>
                    <input type="text" name="academic_year" id="academic_year" class="form-control" value="<?= old('academic_year', '2025-2026') ?>" placeholder="2025-2026" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="score" class="form-label">Score (0-100) *</label>
                    <input type="number" name="score" id="score" class="form-control" min="0" max="100" step="0.01" value="<?= old('score') ?>" required>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Save Grade</button>
                <a href="<?= site_url('grades') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Back to List</a>
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
