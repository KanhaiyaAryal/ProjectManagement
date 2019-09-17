
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Company') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form method="post" action="{{ route('company.store') }}">
                            {{ csrf_field() }}
                            @method('post')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
                                     
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descriptions" class="col-md-4 col-form-label text-md-right">{{ __('Descriptions') }}</label>
                                <div class="col-md-6">
                                    <input id="descriptions" type="text" class="form-control @error('name') is-invalid @enderror" name="descriptions" required autocomplete="descriptions" autofocus>
                                     
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                 {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection