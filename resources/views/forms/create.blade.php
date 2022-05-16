@extends('layouts.tabs')

@section('content2')
    
        <div class="tab-content">
            <div class="tab-pane {{ request()->is('livecam/unos') ? 'active' : null }}" id="{{ url('livecam/unos') }}" role="tabpanel">
                <br>
                <h4> Unos nove kamere </h4>
                <hr>

{{-- Forma za unos teksta --}}

                {!! Form::open(['action' => 'App\Http\Controllers\FormsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row">
                    <div class="form-group row">
                    {{Form::label('text', 'Tekst:', ['class' => 'col-lg-2 control-label'])}}
                    <div class="col-lg-10">
                    {{Form::text('text', '', ['class' => 'form-control bg-light', 'placeholder' => 'Unesite opisni tekst'])}}
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
--}}

<br>

{{-- Checkbox --}}
<form>
  <div class="form-check">
    <input type="checkbox" id="Check" onclick="checkMe()"/>
      Ograničeno trajanje live kamere
  </div>
</form>

<div class="form-group">
  <label for="end" id="end1" style="display:none">Kamera je validna do:</label>
  <input type="text" class="form-control datepicker" name="end" id="end" style="display:none"><br> 
</div>


<br><br>


<script>

  function checkMe(){

    var cb = document.getElementById("Check");
    var text = document.getElementById("end1");
    var action = document.getElementById("end");


    if(cb.checked == true){
        text.style.display="block";
        action.style.display="block";

    } else {
      text.style.display="none";
      action.style.display="none";
    } 
  }

  
</script> 


{{-- 'Submit' button --}}
                <div class="form-group">
                {{Form::submit('Submit', ['class' => 'btn btn-primary pull-right' ])}}
                </div>
                



                {!! Form::close() !!}

            </div>
              

            </div>   

          </div>
@endsection

