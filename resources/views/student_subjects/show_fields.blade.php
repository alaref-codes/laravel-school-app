<!-- Student Id Field -->
<div class="col-sm-12">
    {!! Form::label('student_id', 'Student Id:') !!}
    <p>{{ $studentSubject->student_id }}</p>
</div>

<!-- Subject Id Field -->
<div class="col-sm-12">
    {!! Form::label('subject_id', 'Subject Id:') !!}
    <p>{{ $studentSubject->subject_id }}</p>
</div>

<!-- Degree Field -->
<div class="col-sm-12">
    {!! Form::label('degree', 'Degree:') !!}
    <p>{{ $studentSubject->degree }}</p>
</div>

<!-- Degree Type Field -->
<div class="col-sm-12">
    {!! Form::label('degree_type', 'Degree Type:') !!}
    <p>{{ $studentSubject->degree_type }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $studentSubject->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $studentSubject->updated_at }}</p>
</div>

