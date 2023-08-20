<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentAPIRequest;
use App\Http\Requests\API\CreateStudentSubjectAPIRequest;
use App\Http\Requests\API\UpdateStudentAPIRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use App\Repositories\StudentSubjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\StudentSubject;
use Response;


/**
 * Class StudentController
 * @package App\Http\Controllers\API
 */

class StudentAPIController extends AppBaseController
{
    /** @var  StudentRepository */
    /** @var  StudentSubjectRepository */
    private $studentRepository;
    private $gradesRepository;

    public function __construct(StudentRepository $studentRepo,StudentSubjectRepository $gradesRepo)
    {
        $this->studentRepository = $studentRepo;
        $this->gradesRepository = $gradesRepo;
    }

    /**
     * Display a listing of the Student.
     * GET|HEAD /students
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $students = Student::all();
        return $this->sendResponse($students->toArray(), 'Students retrieved successfully');
    }

    public function indexGrades(Request $request)
    {
        $studentGrades = StudentSubject::all();
        return $this->sendResponse($studentGrades->toArray(), 'Students grades retrieved successfully');
    }

    /**
     * Store a newly created Student in storage.
     * POST /students
     *
     * @param CreateStudentAPIRequest $request
     * @param CreateStudentSubjectAPIRequest $request
     *
     * @return Response
     */
    public function storeGrades(CreateStudentSubjectAPIRequest $request)
    { 
        $input = $request->all();

        $grades = $this->gradesRepository->create($input);

        return $this->sendResponse($grades->toArray(), 'Grades saved successfully');
    }

    public function store(CreateStudentAPIRequest $request)
    {
        $input = $request->all();

        $student = $this->studentRepository->create($input);

        return $this->sendResponse($student->toArray(), 'Student saved successfully');
    }

    public function showStudentGrades($id)
    {
        $studentGrades = StudentSubject::where('student_id',$id)->get();

        if (empty($studentGrades)) {
            return $this->sendError('Student grades not found');
        }

        return $this->sendResponse($studentGrades->toArray(), 'Student grades retrieved successfully');
    }

    /**
     * Display the specified Student.
     * GET|HEAD /students/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        return $this->sendResponse($student->toArray(), 'Student retrieved successfully');
    }

    /**
     * Update the specified Student in storage.
     * PUT/PATCH /students/{id}
     *
     * @param int $id
     * @param UpdateStudentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Student $student */
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        $student = $this->studentRepository->update($input, $id);

        return $this->sendResponse($student->toArray(), 'Student updated successfully');
    }

    /**
     * Remove the specified Student from storage.
     * DELETE /students/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        $student->delete();

        return $this->sendSuccess('Student deleted successfully');
    }
}
