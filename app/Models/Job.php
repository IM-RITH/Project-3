<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    public function rCompany()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function rJobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }
    public function rJobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }
}