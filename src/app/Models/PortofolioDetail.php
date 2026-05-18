<?php

namespace App\Models;
use App\Models\Portofolio;
use Illuminate\Database\Eloquent\Model;

class PortofolioDetail extends Model
{
    protected $fillable = [
        'portofolio_id',

        'project_description',
        'problem_analysis',
        'system_requirements',
        'architecture_explanation',
        'tech_stack_explanation',

        'erd_image',
        'flowchart_image',

        'conclusion',
    ];
    
    public function portofolio()
    {
        return $this->belongsTo(Portofolio::class);
    }
}
