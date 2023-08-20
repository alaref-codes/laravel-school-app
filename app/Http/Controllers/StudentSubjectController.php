<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentSubjectRequest;
use App\Http\Requests\UpdateStudentSubjectRequest;
use App\Repositories\StudentSubjectRepository;
use App\Repositories\StudentRepository;
use App\Models\Student;
use App\Http\Controllers\AppBaseController;
use App\Models\Subject;
use App\DataTables\StudentSubjectDataTable;
use Illuminate\Http\Request;
use Flash;
use Response;

class StudentSubjectController extends AppBaseController
{
    /** @var StudentSubjectRepository $studentSubjectRepository*/
    private $studentSubjectRepository;
    private $studentRepository;

    public function __construct(StudentSubjectRepository $studentSubjectRepo,StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->studentSubjectRepository = $studentSubjectRepo;
    }

    /**
     * Display a listing of the StudentSubject.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(StudentSubjectDataTable $dataTable)
    {
        return $dataTable->render('student_subjects.table_index');

        // $studentSubjects = $this->studentSubjectRepository->all();
        // return view('student_subjects.index')
        //     ->with('studentSubjects', $studentSubjects);
    }

    /**
     * Show the form for creating a new StudentSubject.
     *
     * @return Response
     */
    public function create()
    {
        $students = Student::select('id','name')->get();
        $subjects = Subject::select('id','name')->get();

        return view('student_subjects.create')->with(compact('students','subjects'));
        // return view('student_subjects.create')->with(['students',$students,'subjects',$subjects]);
    }

    /**
     * Store a newly created StudentSubject in storage.
     *
     * @param CreateStudentSubjectRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentSubjectRequest $request)
    {
        $input = $request->all();

        $studentSubject = $this->studentSubjectRepository->create($input);

        Flash::success('Student Subject saved successfully.');

        return redirect(route('studentSubjects.index'));
    }

    /**
     * Display the specified StudentSubject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $studentSubject = $this->studentSubjectRepository->find($id);

        if (empty($studentSubject)) {
            Flash::error('Student Subject not found');

            return redirect(route('studentSubjects.index'));
        }

        return view('student_subjects.show')->with('studentSubject', $studentSubject);
    }

    /**
     * Show the form for editing the specified StudentSubject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $studentSubject = $this->studentSubjectRepository->find($id);

        if (empty($studentSubject)) {
            Flash::error('Student Subject not found');

            return redirect(route('studentSubjects.index'));
        }

        return view('student_subjects.edit')->with('studentSubject', $studentSubject);
    }

    /**
     * Update the specified StudentSubject in storage.
     *
     * @param int $id
     * @param UpdateStudentSubjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentSubjectRequest $request)
    {
        $studentSubject = $this->studentSubjectRepository->find($id);

        if (empty($studentSubject)) {
            Flash::error('Student Subject not found');

            return redirect(route('studentSubjects.index'));
        }

        $studentSubject = $this->studentSubjectRepository->update($request->all(), $id);

        Flash::success('Student Subject updated successfully.');

        return redirect(route('studentSubjects.index'));
    }

    /**
     * Remove the specified StudentSubject from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $studentSubject = $this->studentSubjectRepository->find($id);

        if (empty($studentSubject)) {
            Flash::error('Student Subject not found');

            return redirect(route('studentSubjects.index'));
        }

        $this->studentSubjectRepository->delete($id);

        Flash::success('Student Subject deleted successfully.');

        return redirect(route('studentSubjects.index'));
    }
}
