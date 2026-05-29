<?php

namespace App\Controllers;

use App\Models\GradeModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;
use App\Models\ClassModel;

class Grades extends BaseController
{
    protected $gradeModel;
    protected $studentModel;
    protected $subjectModel;
    protected $classModel;

    public function __construct()
    {
        $this->gradeModel = new GradeModel();
        $this->studentModel = new StudentModel();
        $this->subjectModel = new SubjectModel();
        $this->classModel = new ClassModel();
    }

    public function index()
    {
        $classId = $this->request->getGet('class_id');
        $term = $this->request->getGet('term');
        $year = $this->request->getGet('year');

        $grades = [];
        if ($classId && $classId !== '0' && $term && $year) {
            $grades = $this->gradeModel->getGradesByClassAndTerm((int) $classId, $term, $year);
        }

        $data = [
            'title' => 'Manage Grades',
            'grades' => $grades,
            'classes' => $this->classModel->findAll(),
            'selected_class' => $classId,
            'selected_term' => $term,
            'selected_year' => $year,
        ];

        return view('grades/index', $data);
    }

    public function create()
    {
        $classId = $this->request->getGet('class_id');
        $studentId = $this->request->getGet('student_id');

        $students = [];
        if ($classId) {
            $students = $this->studentModel->getStudentsByClass($classId);
        }

        $data = [
            'title' => 'Add Grade',
            'students' => $students,
            'subjects' => $this->subjectModel->findAll(),
            'classes' => $this->classModel->findAll(),
            'selected_class' => $classId,
            'selected_student' => $studentId,
        ];

        return view('grades/create', $data);
    }

    public function store()
    {
        $validation = $this->validate([
            'student_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'class_id' => 'required|integer',
            'academic_term' => 'required|in_list[Term 1,Term 2,Term 3]',
            'academic_year' => 'required|max_length[20]',
            'score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $studentId = (int) $this->request->getPost('student_id');
        $subjectId = (int) $this->request->getPost('subject_id');
        $term = $this->request->getPost('academic_term');
        $year = $this->request->getPost('academic_year');

        if ($this->gradeModel->isDuplicate($studentId, $subjectId, $term, $year)) {
            return redirect()->back()->withInput()->with('error', 'A grade already exists for this student, subject, term, and academic year.');
        }

        $score = (float) $this->request->getPost('score');

        $data = [
            'student_id' => $studentId,
            'subject_id' => $subjectId,
            'class_id' => (int) $this->request->getPost('class_id'),
            'academic_term' => $term,
            'academic_year' => $year,
            'score' => $score,
            'grade_letter' => $this->gradeModel->scoreToLetter($score),
            'remarks' => $this->gradeModel->scoreToRemarks($score),
            'entered_by' => session()->get('user_id'),
        ];

        $saved = $this->gradeModel->save($data);

        if (!$saved) {
            return redirect()->back()->withInput()->with('errors', $this->gradeModel->errors());
        }

        $gradeId = $this->gradeModel->getInsertID();
        $stored = $this->gradeModel->find($gradeId);
        if (!$stored || (float) $stored['score'] !== $score) {
            return redirect()->back()->withInput()->with('error', 'Failed to save grade. Please try again.');
        }

        return redirect()->to('/grades?class_id=' . $data['class_id'] . '&term=' . urlencode($term) . '&year=' . urlencode($year))->with('success', 'Grade added successfully.');
    }

    public function edit($id)
    {
        $grade = $this->gradeModel->find($id);

        if (!$grade) {
            return redirect()->to('/grades')->with('error', 'Grade not found.');
        }

        $data = [
            'title' => 'Edit Grade',
            'grade' => $grade,
            'students' => $this->studentModel->getStudentsByClass($grade['class_id']),
            'subjects' => $this->subjectModel->findAll(),
            'classes' => $this->classModel->findAll(),
        ];

        return view('grades/edit', $data);
    }

    public function update($id)
    {
        if (!$this->gradeModel->find($id)) {
            return redirect()->to('/grades')->with('error', 'Grade not found.');
        }

        $validation = $this->validate([
            'student_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'class_id' => 'required|integer',
            'academic_term' => 'required|in_list[Term 1,Term 2,Term 3]',
            'academic_year' => 'required|max_length[20]',
            'score' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[10]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $studentId = (int) $this->request->getPost('student_id');
        $subjectId = (int) $this->request->getPost('subject_id');
        $term = $this->request->getPost('academic_term');
        $year = $this->request->getPost('academic_year');

        if ($this->gradeModel->isDuplicate($studentId, $subjectId, $term, $year, $id)) {
            return redirect()->back()->withInput()->with('error', 'A grade already exists for this student, subject, term, and academic year.');
        }

        $score = (float) $this->request->getPost('score');

        $data = [
            'student_id' => $studentId,
            'subject_id' => $subjectId,
            'class_id' => (int) $this->request->getPost('class_id'),
            'academic_term' => $term,
            'academic_year' => $year,
            'score' => $score,
            'grade_letter' => $this->gradeModel->scoreToLetter($score),
            'remarks' => $this->gradeModel->scoreToRemarks($score),
        ];

        $updated = $this->gradeModel->update($id, $data);

        if (!$updated) {
            return redirect()->back()->withInput()->with('errors', $this->gradeModel->errors());
        }

        $saved = $this->gradeModel->find($id);
        if (!$saved || (float) $saved['score'] !== $score) {
            return redirect()->back()->withInput()->with('error', 'Failed to save grade. Please try again.');
        }

        return redirect()->to('/grades?class_id=' . $data['class_id'] . '&term=' . urlencode($term) . '&year=' . urlencode($year))->with('success', 'Grade updated successfully.');
    }

    public function delete($id)
    {
        if (!$this->gradeModel->find($id)) {
            return redirect()->to('/grades')->with('error', 'Grade not found.');
        }

        try {
            $this->gradeModel->delete($id);
        } catch (\Exception $e) {
            return redirect()->to('/grades')->with('error', 'Failed to delete grade. It may be referenced by other records.');
        }

        return redirect()->to('/grades')->with('success', 'Grade deleted successfully.');
    }

    public function studentGrades($studentId)
    {
        $student = $this->studentModel->getStudentWithClass($studentId);

        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $grades = $this->gradeModel->getGradesByStudent($studentId);
        $gpa = $this->gradeModel->calculateGPA($studentId);

        $data = [
            'title' => 'Grades - ' . $student['full_name'],
            'student' => $student,
            'grades' => $grades,
            'gpa' => $gpa,
        ];

        return view('grades/student_grades', $data);
    }

    public function getStudentsByClass()
    {
        $classId = $this->request->getGet('class_id');
        $students = $this->studentModel->getStudentsByClass($classId);
        return $this->response->setJSON($students);
    }
}
