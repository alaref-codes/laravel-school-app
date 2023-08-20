@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Student Subject</h1>
                </div>
            </div>
        </div>
    </section>


  
    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'studentSubjects.store']) !!}

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        {!! Form::label('student_id', 'Student:') !!}
                        <select class="form-control" name="student_id" id="student_id">
                                @foreach($students as $student)
                                    <option value="{{$student->id}}" >{{$student->name}}</option>
                                @endforeach
                        </select>
                        </div>
                        <div class="form-group col-sm-6">
                        {!! Form::label('subject_id', 'Subject:') !!}
                        <select class="form-control" name="subject_id" id="subject_id" >
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}" >{{$subject->name}}</option>
                                @endforeach
                        </select>
                        </div>
                    @include('student_subjects.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('studentSubjects.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
