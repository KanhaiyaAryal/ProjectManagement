@extends('layouts.app')

@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type = "button" class="close" data-dismiss = "alert">x</button> <strong>{{ $message }}</strong>!
    </div>
@endif
<div class="card text-white bg-primary mb-3 col-md-12 col-md-offsert-3">
    <div class="row">
        <div class="card-header col-md-7">Company Lists</div>
        <div class="col-md-5"><button type="button" class="btn btn-light"><a href="/company/create">Create Company</a></button></div>
    </div>
  <div class="card-body" style="color: black;">
      <ul class="list-group list-group-flush">
        @if($companies->count() > 0)
        @foreach($companies as $company)
         <li class="list-group-item"><a href="/company/{{ $company->id }}">{{ $company->name }}</a></li>
        <li class="list-group-item">{{ $company->descriptions }}</li>
        <br/>
        @endforeach
        @else
        <li class="list-group-item">
            <small class="text-muted" style="font-size: 15px;"> There is no company list. Crate new company by clicking on 'Create Company'!</small>
        </li>
        @endif  
      </ul>
   </div>
</div>

@endsection