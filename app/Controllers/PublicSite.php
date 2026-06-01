<?php

namespace App\Controllers;

use App\Models\GradeModel;
use App\Models\StudentModel;

class PublicSite extends BaseController
{
    public function index(): string
    {
        return view('public/home', [
            'title' => 'Eskola Secundaria Geral Venilale',
        ]);
    }

    public function grades(): string
    {
        $studentModel = new StudentModel();
        $gradeModel = new GradeModel();
        $keyword = trim((string) $this->request->getGet('q'));
        $studentResults = [];

        if ($keyword !== '') {
            $students = $studentModel->searchStudents($keyword);

            foreach ($students as $student) {
                $studentId = (int) $student['id'];

                $studentResults[] = [
                    'student' => $student,
                    'grades' => $gradeModel->getGradesByStudent($studentId),
                    'gpa' => $gradeModel->calculateGPA($studentId),
                ];
            }
        }

        return view('public/grades', [
            'title' => 'Valor Publiku',
            'keyword' => $keyword,
            'studentResults' => $studentResults,
        ]);
    }
}