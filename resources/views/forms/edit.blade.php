@extends('layouts.tabs')

@section('content2')
    
                <h4> Izmjena kamere "{{ $form->text }}"</h4>
                <hr>

{{-- Forma za unos teksta --}}

                {!! Form::open(['action' => ['App\Http\Controllers\FormsController@update', $form->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row">
                    <div class="form-group row">
                    {{Form::label('text', 'Tekst:', ['class' => 'col-lg-2 control-label'])}}
                    <div class="col-lg-10">
                    {{Form::text('text', $form->text, ['class' => 'form-control bg-light', 'placeholder' => 'Unesite opisni tekst'])}}
                    </div>
                    </div>
                    <br> <br> <br>

{{-- Forma za unos slike --}}

                <div class="form-group row">
                    {{Form::label('image', 'Slika:', ['class' => 'col-lg-2 control-label'])}}
                <br>
                <div class="col-lg-10">
                    {{Form::file('image')}}
                </div>
            </div>
                <br> <br>


{{-- Checkbox 'Trajanje' 

                <div class="form-group row">
                    {{Form::label('title', ' ', ['class' => 'col-lg-2 control-label'])}}
                    <div class="col-lg-10">
                        
                        <div class="checkbox">
                            {!! Form::checkbox('checkbox') !!}
                            {!! Form::label('checkbox', 'Ograničeno trajanje kamere: ') !!}
                        </div>
                    </div>
                </div>


<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
    <label class="form-check-label" for="defaultCheck1">
      Default checkbox
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
    <label class="form-check-label" for="defaultCheck2">
      Disabled checkbox
    </label>
  </div>
--}}

{{-- 'Submit' button --}}
                <div class="form-group">
                {{Form::submit('Submit', ['class' => 'btn btn-primary pull-right' ])}}
                </div>
                



                {!! Form::close() !!}

            </div>
              

        
  

@endsection

