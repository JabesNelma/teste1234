<?php

namespace App\Controllers;

use App\Models\GradeModel;
use App\Models\StudentModel;
use App\Models\ClassModel;

class Reports extends BaseController
{
    protected $gradeModel;
    protected $studentModel;
    protected $classModel;

    public function __construct()
    {
        $this->gradeModel = new GradeModel();
        $this->studentModel = new StudentModel();
        $this->classModel = new ClassModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Generate Reports',
            'classes' => $this->classModel->findAll(),
            'students' => $this->studentModel->getStudentWithClass(),
        ];

        return view('reports/index', $data);
    }

    public function studentReport()
    {
        $studentId = $this->request->getGet('student_id');

        if (!$studentId) {
            return redirect()->to('/reports')->with('error', 'Please select a student.');
        }

        $student = $this->studentModel->getStudentWithClass($studentId);

        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $grades = $this->gradeModel->getGradesByStudent($studentId);
        $gpa = $this->gradeModel->calculateGPA($studentId);

        $data = [
            'title' => 'Student Report - ' . $student['full_name'],
            'student' => $student,
            'grades' => $grades,
            'gpa' => $gpa,
        ];

        return view('reports/student_report', $data);
    }

    public function classReport()
    {
        $classId = $this->request->getGet('class_id');
        $term = $this->request->getGet('term');
        $year = $this->request->getGet('year');

        if (!$classId || !$term || !$year) {
            return redirect()->to('/reports')->with('error', 'Please select class, term, and year.');
        }

        $class = $this->classModel->find($classId);
        $averages = $this->gradeModel->getTermAverages($classId, $term, $year);

        $data = [
            'title' => 'Class Report',
            'class' => $class,
            'term' => $term,
            'year' => $year,
            'averages' => $averages,
        ];

        return view('reports/class_report', $data);
    }
}
