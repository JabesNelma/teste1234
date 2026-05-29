<?php

namespace App\Controllers;

use App\Models\SubjectModel;

class Subjects extends BaseController
{
    protected $subjectModel;

    public function __construct()
    {
        $this->subjectModel = new SubjectModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');

        if ($search) {
            $subjects = $this->subjectModel->searchSubjects($search);
        } else {
            $subjects = $this->subjectModel->findAll();
        }

        $data = [
            'title' => 'Manage Subjects',
            'subjects' => $subjects,
            'search' => $search,
        ];

        return view('subjects/index', $data);
    }

    public function create()
    {
        return view('subjects/create', ['title' => 'Add Subject']);
    }

    public function store()
    {
        $validation = $this->validate([
            'subject_code' => 'required|is_unique[subjects.subject_code]',
            'subject_name' => 'required|min_length[3]|max_length[100]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'subject_code' => $this->request->getPost('subject_code'),
            'subject_name' => $this->request->getPost('subject_name'),
            'description' => $this->request->getPost('description'),
        ];

        if (!$this->subjectModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->subjectModel->errors());
        }

        return redirect()->to('/subjects')->with('success', 'Subject added successfully.');
    }

    public function edit($id)
    {
        $subject = $this->subjectModel->find($id);

        if (!$subject) {
            return redirect()->to('/subjects')->with('error', 'Subject not found.');
        }

        return view('subjects/edit', ['title' => 'Edit Subject', 'subject' => $subject]);
    }

    public function update($id)
    {
        if (!$this->subjectModel->find($id)) {
            return redirect()->to('/subjects')->with('error', 'Subject not found.');
        }

        $validation = $this->validate([
            'subject_code' => 'required|is_unique[subjects.subject_code,id,' . $id . ']',
            'subject_name' => 'required|min_length[3]|max_length[100]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'subject_code' => $this->request->getPost('subject_code'),
            'subject_name' => $this->request->getPost('subject_name'),
            'description' => $this->request->getPost('description'),
        ];

        if (!$this->subjectModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->subjectModel->errors());
        }

        return redirect()->to('/subjects')->with('success', 'Subject updated successfully.');
    }

    public function delete($id)
    {
        try {
            $this->subjectModel->delete($id);
            return redirect()->to('/subjects')->with('success', 'Subject deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->to('/subjects')->with('error', 'Cannot delete subject. It may have grades recorded.');
        }
    }

    public function view($id)
    {
        $subject = $this->subjectModel->find($id);

        if (!$subject) {
            return redirect()->to('/subjects')->with('error', 'Subject not found.');
        }

        $gradeModel = new \App\Models\GradeModel();
        $recentGrades = $gradeModel->select('grades.*, students.full_name as student_name, students.student_id as student_code')
            ->join('students', 'students.id = grades.student_id')
            ->where('subject_id', $id)
            ->orderBy('grades.created_at', 'DESC')
            ->limit(10)
            ->findAll();

        $data = [
            'title' => 'Subject Details - ' . $subject['subject_name'],
            'subject' => $subject,
            'recent_grades' => $recentGrades,
        ];

        return view('subjects/view', $data);
    }
}
