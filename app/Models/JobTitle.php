<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    protected $table = 'jobtitles';

    protected $guarded = ['id'];
    public function employee()
    {
        return $this->hasMany(Employee::class, 'JobTitleID');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'DepartmentID');
    }
}
