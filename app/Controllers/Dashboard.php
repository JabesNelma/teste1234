<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\GradeModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $studentModel = new StudentModel();
        $subjectModel = new SubjectModel();
        $classModel = new ClassModel();
        $gradeModel = new GradeModel();

        $data = [
            'title' => 'Dashboard',
            'total_students' => $studentModel->getStudentCount(),
            'total_subjects' => $subjectModel->getSubjectCount(),
            'total_classes' => $classModel->getClassCount(),
            'recent_students' => $studentModel->select('students.*, classes.class_name')
                ->join('classes', 'classes.id = students.class_id', 'left')
                ->orderBy('students.created_at', 'DESC')
                ->limit(5)
                ->findAll(),
            'recent_grades' => $gradeModel->select('grades.*, students.full_name as student_name, subjects.subject_name')
                ->join('students', 'students.id = grades.student_id')
                ->join('subjects', 'subjects.id = grades.subject_id')
                ->orderBy('grades.created_at', 'DESC')
                ->limit(5)
                ->findAll(),
        ];

        return view('dashboard/index', $data);
    }
}
