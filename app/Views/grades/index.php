<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-journal-text me-2"></i>Grade Management</span>
        <a href="<?= site_url('grades/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Add Grade
        </a>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-3">
                <select name="class_id" class="form-select form-select-sm" required>
                    <option value="">Select Class</option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?= $class['id'] ?>" <?= $selected_class == $class['id'] ? 'selected' : '' ?>>
                            <?= esc($class['class_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="term" class="form-select form-select-sm" required>
                    <option value="">Select Term</option>
                    <option value="Term 1" <?= $selected_term === 'Term 1' ? 'selected' : '' ?>>Term 1</option>
                    <option value="Term 2" <?= $selected_term === 'Term 2' ? 'selected' : '' ?>>Term 2</option>
                    <option value="Term 3" <?= $selected_term === 'Term 3' ? 'selected' : '' ?>>Term 3</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" name="year" class="form-control form-control-sm" placeholder="Academic Year" value="<?= esc($selected_year ?? '') ?>" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-sm w-100" type="submit"><i class="bi bi-search me-1"></i>Filter</button>
            </div>
        </form>

        <?php if (!empty($grades)): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject</th>
                        <th>Term</th>
                        <th>Score</th>
                        <th>Grade</th>
                        <th>Actions</th>
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
                        <td><?= number_format($grade['score'], 1) ?></td>
                        <td>
                            <?php
                            $letter = strtoupper($grade['grade_letter'] ?? '');
                            $class = match (true) {
                                str_starts_with($letter, 'A') => 'grade-a',
                                str_starts_with($letter, 'B') => 'grade-b',
                                str_starts_with($letter, 'C') => 'grade-c',
                                str_starts_with($letter, 'D') => 'grade-d',
                                default => 'grade-f',
                            };
                            ?>
                            <span class="badge-grade <?= $class ?>"><?= $letter ?></span>
                        </td>
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
