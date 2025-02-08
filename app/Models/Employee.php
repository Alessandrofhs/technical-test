<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $guarded = ['id'];

    protected $fillable = [
        'NIK', 'FirstName', 'LastName', 'JobTitleID', 'Gender',
        'PlaceOfBirth', 'DateOfBirth', 'HireDate', 'Phone', 'Email', 'Address'
    ];
    public function jobtitle()
    {
        return $this->belongsTo(JobTitle::class, 'JobTitleID');
    }
}
