<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>
<?php $student = $studentResults[0]['student'] ?? null; ?>
<section class="hero-panel mb-4 mb-lg-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-8">
            <span class="eyebrow mb-3"><i class="bi bi-journal-text"></i> Valor Publiku</span>
            <h1 class="display-title fw-black mb-3" style="font-size: clamp(2.1rem, 6vw, 4rem);">Peskiza valor estudante husi database</h1>
            <p class="lead-copy mb-0">
                Se-estudante sira hili naran mesak, página ida ne'e sei retorna valor nebe registra iha sistem. Hili naran estudante no haree valor akademiku sira iha kada semester/term.
            </p>
        </div>
        <div class="col-lg-4">
            <div class="glass-card section-card">
                        <div class="muted">
                            <?php if (! empty($student)): ?>
                                Student ID: <?= esc($student['student_id'] ?? '-') ?> · Classe: <?= esc($student['class_name'] ?? $student['class_id'] ?? '-') ?>
                            <?php else: ?>
                                Student ID: - · Classe: -
                            <?php endif; ?>
                        </div>
                    <div>
                        <label for="q" class="form-label text-white-50 fw-semibold">Naran estudante</label>
                        <input type="text" class="form-control form-control-lg bg-dark text-white border-secondary" id="q" name="q" value="<?= esc($keyword) ?>" placeholder="Ex: Maria da Costa">
                    </div>
                    <button type="submit" class="btn btn-brand btn-lg"><i class="bi bi-search me-1"></i>Haree valor</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php if ($keyword === ''): ?>
    <div class="glass-card section-card text-center">
        <i class="bi bi-search display-6 d-block mb-3" style="color: var(--brand-2);"></i>
        <h2 class="section-title mb-2">Komeça hodi peskiza</h2>
        <p class="muted mb-0">Hatama naran estudante atu haree valor nebe registra ona iha database.</p>
    </div>
<?php elseif (empty($studentResults)): ?>
    <div class="glass-card section-card text-center">
        <i class="bi bi-exclamation-circle display-6 d-block mb-3" style="color: var(--danger);"></i>
        <h2 class="section-title mb-2">Ladi'ak hetan rezultadu</h2>
        <p class="muted mb-0">La hetan estudante ho naran <strong><?= esc($keyword) ?></strong>. Tenta fali ho naran seluk.</p>
    </div>
<?php else: ?>
    <div class="d-grid gap-4">
        <?php foreach ($studentResults as $result): ?>
            <?php
                $student = $result['student'];
                $grades = $result['grades'];
                $gpa = $result['gpa'];
            ?>
            <article class="glass-card section-card">
                <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
                    <div>
                        <div class="section-label mb-2">Estudante</div>
                        <h2 class="section-title mb-1"><?= esc($student['full_name']) ?></h2>
                        <div class="muted">Student ID: <?= esc($student['student_id']) ?> · Classe: <?= esc($student['class_id']) ?></div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 align-items-start">
                        <span class="badge badge-soft rounded-pill px-3 py-2">GPA <?= esc(number_format((float) ($gpa['gpa'] ?? 0), 2)) ?></span>
                        <span class="badge badge-soft rounded-pill px-3 py-2">Average <?= esc(number_format((float) ($gpa['average'] ?? 0), 2)) ?></span>
                        <span class="badge badge-soft rounded-pill px-3 py-2"><?= esc((string) ($gpa['total_subjects'] ?? 0)) ?> subjects</span>
                    </div>
                </div>

                <?php if (empty($grades)): ?>
                    <div class="alert alert-warning border-0 mb-0">La iha valor registradu ba estudante ida ne'e.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-dark table-borderless align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Materia</th>
                                    <th>Term</th>
                                    <th>Ano</th>
                                    <th>Score</th>
                                    <th>Grade</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($grades as $grade): ?>
                                    <?php $score = (float) $grade['score']; ?>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold"><?= esc($grade['subject_name']) ?></div>
                                            <small class="text-white-50"><?= esc($grade['subject_code']) ?></small>
                                        </td>
                                        <td><?= esc($grade['academic_term']) ?></td>
                                        <td><?= esc($grade['academic_year']) ?></td>
                                        <td class="fw-bold"><?= esc(number_format($score, 1)) ?></td>
                                        <td>
                                            <span class="badge rounded-pill <?= $score >= 9 ? 'text-bg-success' : ($score >= 6 ? 'text-bg-primary' : 'text-bg-danger') ?>">
                                                <?= esc($grade['grade_letter'] ?? '-') ?>
                                            </span>
                                        </td>
                                        <td><?= esc($grade['remarks'] ?? '-') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>