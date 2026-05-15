<?php

namespace App\Controllers;

use App\Models\ClassModel;

class Classes extends BaseController
{
    protected $classModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');

        if ($search) {
            $classes = $this->classModel->searchClasses($search);
        } else {
            $classes = $this->classModel->findAll();
        }

        $data = [
            'title' => 'Manage Classes',
            'classes' => $classes,
            'search' => $search,
        ];

        return view('classes/index', $data);
    }

    public function create()
    {
        return view('classes/create', ['title' => 'Add Class']);
    }

    public function store()
    {
        $validation = $this->validate([
            'class_name' => 'required|min_length[3]|max_length[50]',
            'class_code' => 'required|is_unique[classes.class_code]',
            'academic_year' => 'required|min_length[4]|max_length[20]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->classModel->save([
            'class_name' => $this->request->getPost('class_name'),
            'class_code' => $this->request->getPost('class_code'),
            'academic_year' => $this->request->getPost('academic_year'),
            'section' => $this->request->getPost('section'),
        ]);

        return redirect()->to('/classes')->with('success', 'Class added successfully.');
    }

    public function edit($id)
    {
        $class = $this->classModel->find($id);

        if (!$class) {
            return redirect()->to('/classes')->with('error', 'Class not found.');
        }

        return view('classes/edit', ['title' => 'Edit Class', 'class' => $class]);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'class_name' => 'required|min_length[3]|max_length[50]',
            'class_code' => 'required|is_unique[classes.class_code,id,' . $id . ']',
            'academic_year' => 'required|min_length[4]|max_length[20]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->classModel->update($id, [
            'class_name' => $this->request->getPost('class_name'),
            'class_code' => $this->request->getPost('class_code'),
            'academic_year' => $this->request->getPost('academic_year'),
            'section' => $this->request->getPost('section'),
        ]);

        return redirect()->to('/classes')->with('success', 'Class updated successfully.');
    }

    public function delete($id)
    {
        try {
            $this->classModel->delete($id);
            return redirect()->to('/classes')->with('success', 'Class deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->to('/classes')->with('error', 'Cannot delete class. It may have students enrolled.');
        }
    }

    public function view($id)
    {
        $class = $this->classModel->find($id);

        if (!$class) {
            return redirect()->to('/classes')->with('error', 'Class not found.');
        }

        $studentModel = new \App\Models\StudentModel();
        $students = $studentModel->getStudentsByClass($id);

        $data = [
            'title' => 'Class Details - ' . $class['class_name'],
            'class' => $class,
            'students' => $students,
        ];

        return view('classes/view', $data);
    }
}
