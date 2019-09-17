
@extends('layouts.app')

@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type = "button" class="close" data-dismiss = "alert">x</button> <strong>{{ $message }}</strong>!
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type = "button" class="close" data-dismiss = "alert">x</button> <strong>{{ $message }}</strong>!
    </div>
@endif
<section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">{{ $project->name }}</h1>
      <p class="lead text-muted">{{ $project->descriptions }}</p>
      <p>
        <a href="/project/{{ $project->id }}/edit" class="btn btn-primary my-2">Edit</a>
        <a href="#" class="btn btn-secondary my-2" onclick="
            var result=confirm('Are you sure want to delete this Company?');
            if(result) {
                event.preventDefault();
                document.getElementById('delete-form').submit();
            }">
                    Delete</a></p>
            <form id="delete-form" action="{{ route('project.destroy',[$project->id]) }}" method="POST" style="display: none;">
                  @csrf
                  <input type="hidden" name="_method" value="delete" />
            </form>
             <div class="container">
                <form method="post" action="{{ route('project.addmember') }}">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <input name="project_id" value="{{ $project->id }}" type="hidden">
                         <div class="form-group row">
                            <div class="col-md-4 offset-md-2">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Enter your member" autofocus> 
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Member') }}
                                </button>
                            </div>
                         </div>
                      
                    </div>
                </div>
                </form>
             </div>
            </div>
       </div>
  </section>
<ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Recent Comments</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Comment Box</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab1" data-toggle="pill" href="#pills-profile1" role="tab" aria-controls="pills-profile1" aria-selected="false">Member Lists</a>
  </li>
</ul>
<br>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Recent Comment') }}</div>
               <div class="card-body">
                    <ul class="">
                        @if($project->comments->count() > 0)
                        @foreach($project->comments as $comment)
                        <li class="form-group row">
                            <div class="col-md-1">
                                <img src="http://placehold.it/60x60" class="img-circle" style="border-radius: 50%;">
                            </div>
                            <div class="col-md-9 col-form-label text-md">
                                <h4 class="media-heading">
                                    {{ $comment->user->name }}
                                  
                                    <small class="text-muted">comment on {{ $comment->created_at->format('d M') }}</small>
                                </h4>
                                <p>
                                    {{ $comment->body }}
                                </p>
                                <p class="text-muted">
                                    {{ $comment->url }}
                                </p>
                            </div>
                        </li>
                        @endforeach
                        @else
                        <li class="form-group row">
                            <small class="text-muted" style="font-size: 18px;"> There is no comment in this project. Be the first to comment in this project.</small>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Comment Here') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comment.store') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12 col-form-label text-md-right">
                                <textarea id="comment" rows="3" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required autocomplete="comment" autofocus placeholder="Enter comment"></textarea>

                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-form-label text-md-right">
                                <textarea id="url" rows="2" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}" required autocomplete="url" autofocus placeholder="Enter Url or screenshots"></textarea>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Comment') }}
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="commentable_id" value="{{ $project->id }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>  
  </div>
    <div class="tab-pane fade" id="pills-profile1" role="tabpanel" aria-labelledby="pills-profile-tab1">
        <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Member List') }}</div>
               <div class="card-body">
                    <ul class="">
                        @if($project->users->count() > 0)
                        @foreach($project->users as $user)
                        <li class="form-group row">
                            <div class="col-md-1">
                                <img src="http://placehold.it/60x60" class="img-circle" style="border-radius: 50%;">
                            </div>
                            <div class="col-md-9 col-form-label text-md">
                                <h4 class="media-heading">
                                    {{ $user->name }}
                                  
                                    <small class="text-muted">- {{ $user->email }}</small>
                                    <small class="text-muted">( {{ $user->role->name }} )</small>
                                </h4>
                                
                            </div>
                        </li>
                        @endforeach
                        @else
                        <li class="form-group row">
                            <small class="text-muted" style="font-size: 18px;"> There is no member list in this project.</small>
                        </li>
                        @endif     
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
    
    

@endsection