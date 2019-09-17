@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type = "button" class="close" data-dismiss = "alert">x</button> <strong>{{ $message }}</strong>!
    </div>
@endif
<div class="album py-5 bg-light">
    <div class="container">       
      <div class="row">
        @if($project->count() > 0)
        @foreach($project as $projects)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
           <svg class="bd-placeholder-img card-img-top" width="100%" height="225" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $projects->name }}</text></svg>
            <div class="card-body">
              <p class="card-text">{{ $projects->descriptions }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="/project/{{ $projects->id }}">View</a></button>
                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="/project/{{ $projects->id }}/edit">Edit</a></button>                    

                </div>
                <small class="text-muted"> {{ $projects->updated_at }}</small>
              </div>
            </div>
            
          </div>
        </div>
        @endforeach
        @else
        <li class="list-group-item" style="width: 900px; margin: 0 auto;">
            <small class="text" style="font-size: 15px;"> There is no project list!</small>
        </li>
        @endif 
      </div>
    </div>
  </div>

@endsection