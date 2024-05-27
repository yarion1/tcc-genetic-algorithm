<?php

namespace App\Models;

use App\Models\ModelFront\Base\BaseModel;

class CoursesProfessor extends Model
{
    protected $guarded = [
        'ativo',
        // 'criado_por',
        // 'criado_em',
        // 'atualizado_por',
        // 'atualizado_em',
        // 'excluido_por',
        // 'excluido_em'
    ];

    public function professors()
    {
        return $this->belongsToMany(Professor::class, 'courses_professors', 'course_id', 'professor_id');
    }

    
    public function classes()
    {
        return $this->belongsToMany(CollegeClass::class, 'courses_classes', 'course_id', 'class_id');
    }

}
