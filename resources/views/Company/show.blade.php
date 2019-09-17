
@extends('layouts.app')

@section('content')
<section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">{{ $company->name }}</h1>
      <p class="lead text-muted">{{ $company->descriptions }}</p>
      <p>
        <a href="/company/{{ $company->id }}/edit" class="btn btn-primary my-2">Edit</a>
        <a href="#" class="btn btn-secondary my-2" onclick="
            var result=confirm('Are you sure want to delete this Company?');
            if(result) {
                event.preventDefault();
                document.getElementById('delete-form').submit();
            }">
            Delete</a>
      </p>
              <form id="delete-form" action="{{ route('company.destroy',[$company->id]) }}" method="POST" style="display: none;">
                  @csrf
                  <input type="hidden" name="_method" value="delete" />
              </form>
    </div>
  </section>

<div class="album py-5 bg-light">
    <div class="container">
     
      <div class="row">
        @foreach($company->projects as $project)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
           <svg class="bd-placeholder-img card-img-top" style="text-align: center;" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $project->name }}</text></svg>
            <div class="card-body">
              <p class="card-text">{{ $project->descriptions }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="/project/{{ $project->id }}">View</a></button>
                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="/project/{{ $project->id }}/edit">Edit</a></button>

                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
            
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

@endsection