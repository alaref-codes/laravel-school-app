<!-- Degree Field -->
<div class="form-group col-sm-6">
    {!! Form::label('degree', 'Degree:') !!}
    {!! Form::text('degree', null, ['class' => 'form-control']) !!}
</div>

<!-- Degree Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('degree_type', 'Degree Type:') !!}
    {!! Form::select('degree_type', ['final'=>'final','midterm'=>'midterm'],null, ['class' => 'form-control']) !!}
</div>
