<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ClassModel;

class Students extends BaseController
{
    protected $studentModel;
    protected $classModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->classModel = new ClassModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');

        if ($search) {
            $students = $this->studentModel->searchStudents($search);
        } else {
            $students = $this->studentModel->getStudentWithClass();
        }

        $data = [
            'title' => 'Manage Students',
            'students' => $students,
            'search' => $search,
        ];

        return view('students/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Student',
            'classes' => $this->classModel->findAll(),
        ];

        return view('students/create', $data);
    }

    public function store()
    {
        $validation = $this->validate([
            'student_id' => 'required|is_unique[students.student_id]',
            'full_name' => 'required|min_length[3]|max_length[100]',
            'gender' => 'required|in_list[male,female]',
            'date_of_birth' => 'required|valid_date',
            'class_id' => 'required|integer',
            'enrollment_date' => 'required|valid_date',
            'status' => 'required|in_list[active,inactive,graduated]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->studentModel->save([
            'student_id' => $this->request->getPost('student_id'),
            'full_name' => $this->request->getPost('full_name'),
            'gender' => $this->request->getPost('gender'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'class_id' => $this->request->getPost('class_id'),
            'parent_name' => $this->request->getPost('parent_name'),
            'parent_phone' => $this->request->getPost('parent_phone'),
            'address' => $this->request->getPost('address'),
            'enrollment_date' => $this->request->getPost('enrollment_date'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/students')->with('success', 'Student added successfully.');
    }

    public function edit($id)
    {
        $student = $this->studentModel->find($id);

        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $data = [
            'title' => 'Edit Student',
            'student' => $student,
            'classes' => $this->classModel->findAll(),
        ];

        return view('students/edit', $data);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'student_id' => 'required|is_unique[students.student_id,id,' . $id . ']',
            'full_name' => 'required|min_length[3]|max_length[100]',
            'gender' => 'required|in_list[male,female]',
            'date_of_birth' => 'required|valid_date',
            'class_id' => 'required|integer',
            'enrollment_date' => 'required|valid_date',
            'status' => 'required|in_list[active,inactive,graduated]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->studentModel->update($id, [
            'student_id' => $this->request->getPost('student_id'),
            'full_name' => $this->request->getPost('full_name'),
            'gender' => $this->request->getPost('gender'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'class_id' => $this->request->getPost('class_id'),
            'parent_name' => $this->request->getPost('parent_name'),
            'parent_phone' => $this->request->getPost('parent_phone'),
            'address' => $this->request->getPost('address'),
            'enrollment_date' => $this->request->getPost('enrollment_date'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/students')->with('success', 'Student updated successfully.');
    }

    public function delete($id)
    {
        $this->studentModel->delete($id);
        return redirect()->to('/students')->with('success', 'Student deleted successfully.');
    }

    public function view($id)
    {
        $student = $this->studentModel->getStudentWithClass($id);

        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $gradeModel = new \App\Models\GradeModel();
        $grades = $gradeModel->getGradesByStudent($id);
        $gpa = $gradeModel->calculateGPA($id);

        $data = [
            'title' => 'Student Profile - ' . $student['full_name'],
            'student' => $student,
            'grades' => $grades,
            'gpa' => $gpa,
        ];

        return view('students/view', $data);
    }
}
