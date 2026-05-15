<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['class_name', 'class_code', 'academic_year', 'section'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'class_name' => 'required|min_length[3]|max_length[50]',
        'class_code' => 'required|is_unique[classes.class_code,id,{id}]',
        'academic_year' => 'required|min_length[4]|max_length[20]',
    ];

    public function getClassesForDropdown(): array
    {
        $classes = $this->orderBy('class_name', 'ASC')->findAll();
        $options = [];
        foreach ($classes as $class) {
            $options[$class['id']] = $class['class_name'];
        }
        return $options;
    }

    public function getClassCount()
    {
        return $this->countAllResults(false);
    }

    public function searchClasses(string $keyword)
    {
        return $this->like('class_name', $keyword)
            ->orLike('class_code', $keyword)
            ->orLike('academic_year', $keyword)
            ->findAll();
    }
}
