<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'student_id', 'full_name', 'gender', 'date_of_birth',
        'class_id', 'parent_name', 'parent_phone', 'address',
        'enrollment_date', 'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'student_id' => 'required|is_unique[students.student_id,id,{id}]',
        'full_name' => 'required|min_length[3]|max_length[100]',
        'gender' => 'required|in_list[male,female]',
        'date_of_birth' => 'required|valid_date',
        'class_id' => 'required|integer',
        'enrollment_date' => 'required|valid_date',
        'status' => 'required|in_list[active,inactive,graduated]',
    ];

    public function getStudentWithClass($id = null)
    {
        $builder = $this->select('students.*, classes.class_name, classes.class_code')
            ->join('classes', 'classes.id = students.class_id', 'left');

        if ($id) {
            return $builder->where('students.id', $id)->first();
        }

        return $builder->findAll();
    }

    public function getStudentByStudentId(string $studentId)
    {
        return $this->where('student_id', $studentId)->first();
    }

    public function searchStudents(string $keyword)
    {
        return $this->select('students.*, classes.class_name, classes.class_code')
            ->join('classes', 'classes.id = students.class_id', 'left')
            ->groupStart()
                ->like('students.full_name', $keyword)
                ->orLike('students.student_id', $keyword)
            ->groupEnd()
            ->findAll();
    }

    public function getStudentsByClass(int $classId)
    {
        return $this->where('class_id', $classId)->findAll();
    }

    public function getStudentCount()
    {
        return $this->where('status', 'active')->countAllResults(false);
    }
}
