@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $student->name }} Grades</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => ['students.updateStudentGrades',$student->id]]) !!}
            <div class="card-body">
                <div class="row">
                    @include('student_subjects.fields')
                </div>
                {!! Form::label('subject_id', 'Subject:') !!}
                <select class="form-control" name="subject_id" id="subject_id" >
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}" >{{$subject->name}}</option>
                        @endforeach
                </select>
                </div>
                
                <div class="card-footer">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <h5 style="display: inline"  >Average Score : {{ $average }} </h5>
                </div>
            </div>
            <div class="form-group col-sm-6">

            {!! Form::close() !!}

        </div>
    </div>
    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('students.grades_table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
