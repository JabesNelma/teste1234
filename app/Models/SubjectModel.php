<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['subject_code', 'subject_name', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'subject_code' => 'required|is_unique[subjects.subject_code,id,{id}]',
        'subject_name' => 'required|min_length[3]|max_length[100]',
    ];

    public function searchSubjects(string $keyword)
    {
        return $this->like('subject_name', $keyword)
            ->orLike('subject_code', $keyword)
            ->findAll();
    }

    public function getSubjectCount()
    {
        return $this->countAllResults(false);
    }
}
