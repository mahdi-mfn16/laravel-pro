@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('profile') }}" class="{{ request()->path() === 'profile' ? 'active' : '' }}">index</a>
                        </li>
                        <li>
                            <a href="{{ route('two-verify') }}" class="{{ request()->path() === 'profile/two-verify' ? 'active' : '' }}">two verify</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @yield('main')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
