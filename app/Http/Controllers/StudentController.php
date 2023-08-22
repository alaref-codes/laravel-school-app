<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomCreateStudentSubjectRequest;
use App\Repositories\StudentSubjectRepository;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Repositories\StudentRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\DataTables\StudentDataTable;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;

class StudentController extends AppBaseController
{
    /** @var StudentRepository $studentRepository*/
    private $studentRepository;
    private $studentSubjectRepository;

    public function __construct(StudentSubjectRepository $studentSubjectRepo,StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->studentSubjectRepository = $studentSubjectRepo;
    }


    /**
     * Display a listing of the Student.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(StudentDataTable $dataTable)
    {
        return $dataTable->render('students.table_index');
    }

    /**
     * Show the form for creating a new Student.
     *
     * @return Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created Student in storage.
     *
     * @param CreateStudentRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentRequest $request)
    {
        $input = $request->all();

        $student = $this->studentRepository->create($input);

        Flash::success('Student saved successfully.');

        return redirect(route('students.index'));
    }

    /**
     * Display the specified Student.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        return view('students.show')->with('student', $student);
    }

    public function studentGrades($id)
    {
        $studentSubjects = StudentSubject::where('student_id', $id)->get();
        $subjects = Subject::select('id','name')->get();
        $student = $this->studentRepository->find($id);
        $average = 0.0;
        foreach ($studentSubjects as $grades) {
            $midtermAverage = 0.0;
            if ($grades->degree_type == 'midterm'){
                $grades->degree = $grades->degree / 2;
                $midtermAverage += $grades->degree;
            }
            $average += $grades->degree;
        }
        // if (empty($studentSubjects)) {
        //     Flash::error('Student not found');

        //     return redirect(route('students.studentGrades'));
        // }

        return view('students.studentGrades',compact('studentSubjects','student','subjects','average'));
    }

    public function updateStudentGrades($id,CustomCreateStudentSubjectRequest $request)
    {
        $input = $request->all();

        if ($request->degree_type == "final") {
            $studentFinal = StudentSubject::where('subject_id', $request->subject_id)->where('student_id',$id)->where('degree_type',$request->degree_type)->where('deleted_at',null)->get();
            if (count($studentFinal) > 0) {
                Flash::error('تم إدخال درجة الامتحان النهائي لهذه المادة مسبقا');
                return redirect()->back();
    
            };
        } else {
            if ($request->degree > 40) {
                Flash::error('أقصى درجة للامتحان النصفي هي 40');
                return redirect()->back();
            }
            $studentMidterms = StudentSubject::where('subject_id', $request->subject_id)->where('student_id',$id)->where('degree_type',$request->degree_type)->where('deleted_at',null)->get();
            if (count($studentMidterms) > 1) {
                Flash::error('تم إدخال درجات الامتحان النصفي لهذه المادة مسبقا');
                return redirect()->back();
    
            };
        }

        $input['student_id'] = $id;

        $studentSubject = $this->studentSubjectRepository->create($input);
        Flash::success('Student Subject saved successfully.');

        return redirect()->back();
        return view('students/'.$id.'/grades');
    }

    /**
     * Show the form for editing the specified Student.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        return view('students.edit')->with('student', $student);
    }

    /**
     * Update the specified Student in storage.
     *
     * @param int $id
     * @param UpdateStudentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentRequest $request)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        $student = $this->studentRepository->update($request->all(), $id);

        Flash::success('Student updated successfully.');

        return redirect(route('students.index'));
    }

    /**
     * Remove the specified Student from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            Flash::error('Student not found');

            return redirect(route('students.index'));
        }

        $this->studentRepository->delete($id);

        Flash::success('Student deleted successfully.');

        return redirect(route('students.index'));
    }
}
