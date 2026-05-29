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
            'gender' => 'required|in_list[mane,feto]',
            'date_of_birth' => 'required|valid_date',
            'class_id' => 'required|integer',
            'enrollment_date' => 'required|valid_date',
            'status' => 'required|in_list[active,inactive,graduated]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gender = $this->request->getPost('gender') === 'mane' ? 'male' : 'female';

        $data = [
            'student_id' => $this->request->getPost('student_id'),
            'full_name' => $this->request->getPost('full_name'),
            'gender' => $gender,
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'class_id' => $this->request->getPost('class_id'),
            'parent_name' => $this->request->getPost('parent_name'),
            'parent_phone' => $this->request->getPost('parent_phone'),
            'address' => $this->request->getPost('address'),
            'enrollment_date' => $this->request->getPost('enrollment_date'),
            'status' => $this->request->getPost('status'),
        ];

        if (!$this->studentModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->studentModel->errors());
        }

        return redirect()->to('/students')->with('success', 'Student added successfully.');
    }

    public function edit($id)
    {
        $student = $this->studentModel->find($id);

        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $student['gender'] = $student['gender'] === 'male' ? 'mane' : 'feto';

        $data = [
            'title' => 'Edit Student',
            'student' => $student,
            'classes' => $this->classModel->findAll(),
        ];

        return view('students/edit', $data);
    }

    public function update($id)
    {
        if (!$this->studentModel->find($id)) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $validation = $this->validate([
            'student_id' => 'required|is_unique[students.student_id,id,' . $id . ']',
            'full_name' => 'required|min_length[3]|max_length[100]',
            'gender' => 'required|in_list[mane,feto]',
            'date_of_birth' => 'required|valid_date',
            'class_id' => 'required|integer',
            'enrollment_date' => 'required|valid_date',
            'status' => 'required|in_list[active,inactive,graduated]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gender = $this->request->getPost('gender') === 'mane' ? 'male' : 'female';

        $data = [
            'student_id' => $this->request->getPost('student_id'),
            'full_name' => $this->request->getPost('full_name'),
            'gender' => $gender,
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'class_id' => $this->request->getPost('class_id'),
            'parent_name' => $this->request->getPost('parent_name'),
            'parent_phone' => $this->request->getPost('parent_phone'),
            'address' => $this->request->getPost('address'),
            'enrollment_date' => $this->request->getPost('enrollment_date'),
            'status' => $this->request->getPost('status'),
        ];

        if (!$this->studentModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->studentModel->errors());
        }

        return redirect()->to('/students')->with('success', 'Student updated successfully.');
    }

    public function delete($id)
    {
        if (!$this->studentModel->find($id)) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        try {
            $this->studentModel->delete($id);
        } catch (\Exception $e) {
            return redirect()->to('/students')->with('error', 'Cannot delete student. They may have grade records.');
        }

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
