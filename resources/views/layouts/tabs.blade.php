@extends('layouts.app')

@section('content')
    
{{--  Navigacijski bar --}}

    <div class="row align-items-md-stretch">
        <div class="col-md-10">
          <div class="h-100 p-5 bg-light border rounded-3">
             
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                <a class="nav-link {{ request()->is('livecam/unos') ? 'active' : null }} font-weight-bold" href="{{ url('livecam/unos') }}" role="tab">Unos nove kamere</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('livecam/prikaz') ? 'active' : null }} font-weight-bold" href="{{ url('livecam/prikaz') }}" role="tab">Postojeće kamere</a>
                </li>
            </ul>
        
        <div class="container">
            <main class="py-4">
                 @yield('content2')
            </main>
        </div>

            </div>
        </div>
    </div>
@endsection