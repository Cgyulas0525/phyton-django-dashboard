<!-- Focsoport Field -->
<div class="form-group col-sm-6">
    {!! Form::label('focsoport', 'Főcsoport:') !!}
    {!! Form::select('focsoport', \App\Models\termekfocsoport::where('id', '=', $termekcsoport->focsoport)->pluck('nev', 'id')->toArray(), null,['style' => 'cursor: not-allowed', 'class'=>'select2 form-control', 'readonly' => 'true', 'id' => 'focsoport']) !!}
</div>

<!-- Nev Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nev', 'Név:') !!}
    {!! Form::text('nev', null, ['class' => 'form-control', 'required' => 'true']) !!}
</div>

<!-- Megjegyzes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('megjegyzes', 'Megjegyzés:') !!}
    {!! Form::text('megjegyzes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('termekfocsoports.index') !!}" class="btn btn-default">Kilép</a>
</div>


@section('scripts')
    @include('functions.required_js')
    <script type="text/javascript">
        RequiredBackgroundModify('.form-control')
    </script>
@endsection
