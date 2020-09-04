<!-- Partner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('partner', 'Partner:') !!}
    {!! Form::select('partner', [" "] + \App\Models\Partner::orderBy('nev')->pluck('nev', 'id')->toArray(), $szamla->partner,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'partner']) !!}
    {!! Form::label('szamlaszam', 'Szamlaszám:') !!}
    {!! Form::text('szamlaszam', $szamla->szamlaszam, ['class' => 'form-control', 'required' => 'true']) !!}
    {!! Form::label('fizitesimod', 'Fizitésimód:') !!}
    {!! Form::select('fizitesimod', [" "] + \App\Models\Dictionary::where('tipus', '=', '25')->orderBy('nev')->pluck('nev', 'id')->toArray(), $szamla->fizitesimod,['class'=>'select2 form-control', 'required' => 'true', 'id' => 'fizitesimod']) !!}
    {!! Form::label('osszeg', 'Összeg:') !!}
    {!! Form::number('osszeg', $szamla->osszeg, ['class' => 'form-control  text-right', 'required' => 'true']) !!}
</div>
<!-- Kelt Field -->
<div class="form-group col-sm-2">
    {!! Form::label('kelt', 'Kelt:') !!}
    {!! Form::date('kelt', $szamla->kelt, ['class' => 'form-control', 'required' => 'true', 'id'=>'kelt']) !!}
    {!! Form::label('teljesites', 'Teljesítés:') !!}
    {!! Form::date('teljesites', $szamla->teljesites, ['class' => 'form-control', 'required' => 'true','id'=>'teljesites']) !!}
    {!! Form::label('fizetesihatarido', 'Fizetési határidő:') !!}
    {!! Form::date('fizetesihatarido', $szamla->fizetesihatarido, ['class' => 'form-control', 'required' => 'true','id'=>'fizetesihatarido']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('szamlas.index') !!}" class="btn btn-default">Kilép</a>
</div>

@section('scripts')
    @include('layouts.ajax_js')
    @include('functions.required_js')
    @include('szamlas.szamla_js')
<!--
/*    <script type="text/javascript">
        var submitButton = document.querySelector('.form-group .btn.btn-primary');
        submitButton.addEventListener('click', function(ev) {
            ev.preventDefault();
            alert('baszki ez működik');
        })
    </script>*/
-->
@endsection
