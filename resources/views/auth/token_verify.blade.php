@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Auth Verify Again
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('token-verify') }}" class="form-group">
                        @csrf
                        <div class="">
                            <label for="token">token</label>
                            <input class="form-control  @error('token') is-invalid @enderror" name="token" type="text">
                            @error('token')
                                <span class="invalid-feedback">{{ $message }}</span>
                    
                            @enderror
                        </div>
                        <div class="">
                            <button class="form-control btn btn-primary">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
