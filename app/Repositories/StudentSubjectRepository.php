<?php

namespace App\Repositories;

use App\Models\StudentSubject;
use App\Repositories\BaseRepository;

/**
 * Class StudentSubjectRepository
 * @package App\Repositories
 * @version August 8, 2023, 12:52 pm UTC
*/

class StudentSubjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'student_id',
        'subject_id',
        'degree',
        'degree_type'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StudentSubject::class;
    }
}
