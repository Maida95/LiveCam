@extends('layouts.tabs')

@section('content2')
    
        <div class="tab-pane {{ request()->is('livecam/prikaz') ? 'active' : null }}" id="{{ url('livecam/prikaz') }}" role="tabpanel">
            <br>
            <h4> Prikaz postojećih kamera </h4>
        </div>
        <hr>

        <div class="container pt-1>
            <div class="row justify-content-center text-nowrap">
                <div class="col-md-14">
                    <div class="card">
                        {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
    
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <br>
    
                            @if(is_countable($forms) && count($forms) > 0)
                                <table class="table table-striped max-width">
{{-- setting colum width: <th class="col-sm-3"> --}}
                                    <tr>
                                        <th>Naziv kamere</th>
                                        <th>Slika</th>
                                        <th>Datum kreiranja kamere</th>
                                        <th>Datum isteka kamere</th>
                                        <th>Kamera je aktivna</th>
                                        <th>Akcija</th>
                                        <th></th>
                                    </tr>
                                        @foreach($forms as $form)
                                            <tr>
                                                <td>{{$form->text}}</td>
                                                <td><img style="width:70%" src="/storage/images/{{ $form->image }}"></td>
                                                <td>{{ $form->created_at }}</td>
                                                <td class="text-center">
                                                    @if(!isset($form->end))
                                                        Neograničeno
                                                    @else
                                                        {{ $form->end }}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($form->active) 
                                                        Da
                                                    @else
                                                        Ne
                                                    @endif
                                                </td>
                                                <td><a href="/forms/{{ $form->id }}/edit" class="btn btn-light ">Edit</a></td>
                                                <td>
                                                    {!! Form::open(['action' => ['App\Http\Controllers\FormsController@destroy', $form->id], 'method' => 'DELETE', 'class' => 'pull-right' ]) !!}
                                                    {{ Form::submit('Delete',['class' => 'btn btn-dark']) }}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                </table>

                            @else
                                <p> Nema aktivnih live kamera </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
            
       
    

@endsection