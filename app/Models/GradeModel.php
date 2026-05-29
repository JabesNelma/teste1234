<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'student_id', 'subject_id', 'class_id',
        'academic_term', 'academic_year', 'score', 'grade_letter', 'remarks', 'entered_by'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'student_id' => 'required|integer',
        'subject_id' => 'required|integer',
        'class_id' => 'required|integer',
        'academic_term' => 'required|in_list[Term 1,Term 2,Term 3]',
        'academic_year' => 'required|max_length[20]',
        'score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]',
    ];

    protected $skipValidation = false;

    public function getGradesByStudent(int $studentId, string $academicYear = '')
    {
        $builder = $this->select('grades.*, subjects.subject_name, subjects.subject_code, users.full_name as teacher_name')
            ->join('subjects', 'subjects.id = grades.subject_id')
            ->join('users', 'users.id = grades.entered_by', 'left')
            ->where('grades.student_id', $studentId);

        if ($academicYear) {
            $builder->where('grades.academic_year', $academicYear);
        }

        return $builder->orderBy('grades.academic_term', 'ASC')->findAll();
    }

    public function getGradesByClassAndTerm(int $classId, string $term, string $year)
    {
        return $this->select('grades.*, students.full_name as student_name, students.student_id as student_code, subjects.subject_name, classes.class_name')
            ->join('students', 'students.id = grades.student_id')
            ->join('subjects', 'subjects.id = grades.subject_id')
            ->join('classes', 'classes.id = grades.class_id')
            ->where('grades.class_id', $classId)
            ->where('grades.academic_term', $term)
            ->where('grades.academic_year', $year)
            ->findAll();
    }

    public function calculateGPA(int $studentId, string $academicYear = '')
    {
        $grades = $this->getGradesByStudent($studentId, $academicYear);

        if (empty($grades)) {
            return ['gpa' => 0, 'average' => 0, 'total_subjects' => 0, 'grades' => []];
        }

        $totalScore = 0;
        $totalPoints = 0;
        $subjectCount = count($grades);
        $gradeDetails = [];

        foreach ($grades as $grade) {
            $score = (float) $grade['score'];
            $letter = $this->scoreToLetter($score);
            $points = $this->letterToPoint($letter);

            $totalScore += $score;
            $totalPoints += $points;

            $gradeDetails[] = [
                'subject' => $grade['subject_name'],
                'subject_code' => $grade['subject_code'],
                'term' => $grade['academic_term'],
                'score' => $score,
                'letter' => $letter,
                'points' => $points,
            ];
        }

        $average = $totalScore / $subjectCount;
        $gpa = $totalPoints / $subjectCount;

        return [
            'gpa' => round($gpa, 2),
            'average' => round($average, 2),
            'total_subjects' => $subjectCount,
            'grades' => $gradeDetails,
        ];
    }

    public function scoreToLetter(float $score): string
    {
        if ($score >= 9.0) return 'A+';
        if ($score >= 8.5) return 'A';
        if ($score >= 8.0) return 'A-';
        if ($score >= 7.5) return 'B+';
        if ($score >= 7.0) return 'B';
        if ($score >= 6.5) return 'B-';
        if ($score >= 6.0) return 'C+';
        if ($score >= 5.5) return 'C';
        if ($score >= 5.0) return 'C-';
        if ($score >= 4.5) return 'D+';
        if ($score >= 4.0) return 'D';
        return 'F';
    }

    public function letterToPoint(string $letter): float
    {
        $points = [
            'A+' => 4.0, 'A' => 4.0, 'A-' => 3.7,
            'B+' => 3.3, 'B' => 3.0, 'B-' => 2.7,
            'C+' => 2.3, 'C' => 2.0, 'C-' => 1.7,
            'D+' => 1.3, 'D' => 1.0, 'F' => 0.0,
        ];

        return $points[$letter] ?? 0.0;
    }

    public function scoreToRemarks(float $score): string
    {
        if ($score >= 9.0) return 'Excellent';
        if ($score >= 8.0) return 'Very Good';
        if ($score >= 7.0) return 'Good';
        if ($score >= 6.0) return 'Satisfactory';
        if ($score >= 5.0) return 'Fair';
        if ($score >= 4.0) return 'Pass';
        return 'Fail';
    }

    public function isDuplicate(int $studentId, int $subjectId, string $term, string $year, ?int $excludeId = null): bool
    {
        $builder = $this->where('student_id', $studentId)
            ->where('subject_id', $subjectId)
            ->where('academic_term', $term)
            ->where('academic_year', $year);

        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }

        return (bool) $builder->countAllResults(true);
    }

    public function getTermAverages(int $classId, string $term, string $year)
    {
        return $this->select('students.id as student_id, students.student_id as student_code, students.full_name, AVG(grades.score) as average')
            ->join('students', 'students.id = grades.student_id')
            ->where('grades.class_id', $classId)
            ->where('grades.academic_term', $term)
            ->where('grades.academic_year', $year)
            ->groupBy('students.id, students.student_id, students.full_name')
            ->orderBy('average', 'DESC')
            ->findAll();
    }
}
