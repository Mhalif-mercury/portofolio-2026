<?php

namespace App\Models;

use App\Models\PortofolioDetail;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'short_description',
        'description',
        'github_url',
        'live_url',
        'tech_stack',
        'year',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function detail()
    {
        return $this->hasOne(PortofolioDetail::class);
    }

}
