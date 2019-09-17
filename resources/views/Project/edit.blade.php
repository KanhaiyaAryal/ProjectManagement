
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Project') }}</div>
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
                        <form method="post" action="{{ route('project.update',[$project->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-5">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $project->name }}" required autocomplete="name" autofocus>
                                     
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descriptions" class="col-md-4 col-form-label text-md-right">{{ __('Descriptions') }}</label>
                                <div class="col-md-6">
                                    <input id="descriptions" type="text" class="form-control @error('name') is-invalid @enderror" name="descriptions" value="{{ $project->descriptions }}" required autocomplete="descriptions" autofocus>
                                     
                                </div>
                            </div>
                            <div class="form-group row">
                                 <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>
                                 <div class="col-md-6">
                                    <select class="form-control" name="company_id">
                                    <option>Select Company</option>

                                    @foreach ($company as $companys)
                                      <option value="{{ $companys->id }}">{{ $companys->name }}
                                      </option>
                                    @endforeach    
                                    </select>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label for="days" class="col-md-4 col-form-label text-md-right">{{ __('How many Days?') }}</label>
                                <div class="col-md-4">
                                    <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days" value="{{ $project->days }}" required autocomplete="days" autofocus>
                                     
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                 {{ __('Update') }}
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