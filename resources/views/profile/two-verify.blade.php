@extends('profile.layout')

@section('main')

@if ($errors->any())

<div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </ul>
</div>
    
@endif

<form method="POST" action="{{ route('two-verify') }}">
                        @csrf

                        <div class="form-group">
                            <label for="type" >type</label>

                            <select class="form-control" name="type" id="type">

                                @foreach (config('two_verify.type') as $key=>$val)
                                <option {{ old('type') == $key || auth()->user()->two_verify_type == $key ? 'selected' : '' }} value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                                    
                            </select>
                      
                        </div>

                        <div class="form-group">
                            
                            <label for="mobile" >mobile</label>

                            <input class="form-control" name="mobile" id="mobile" value="{{ auth()->user()->mobile }}" type="text">

                            
                        </div>

                        <div class="form-group">
                           
                                <button type="submit" class="btn btn-primary form-control">
                                    update
                                </button>

                            
                        </div>
                    </form>

@endsection