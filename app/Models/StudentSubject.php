<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StudentSubject
 * @package App\Models
 * @version August 8, 2023, 12:52 pm UTC
 *
 * @property integer $student_id
 * @property integer $subject_id
 * @property integer $degree
 * @property string $degree_type
 */
class StudentSubject extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'student_subject';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'student_id',
        'subject_id',
        'degree',
        'degree_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_id' => 'integer',
        'subject_id' => 'integer',
        'degree' => 'integer',
        'degree_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_id' => 'required',
        'subject_id' => 'required',
        'degree' => 'required|integer|between:0,100',
        'degree_type' => 'required'
    ];


    public function students()
    {
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }


    public function subjects()
    {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id');
    }

}
