@extends('layouts.app')

@section('content')
<div class="container vh-100">
    <div class="d-flex justify-content-center align-items-center h-100">
        <form action="/profile/{{ $user->id }}" class="shadow p-3 mb-5 bg-white rounded border border-light p-5" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PATCH')
    
            <div class="row">
                <div class="col-8 offset-2">
    
                        <h1>Edit Profile</h1>
    
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label">Title</label>
        
                            <input id="title" 
                            type="text" 
                            class="form-control @error('title') is-invalid @enderror" 
                            name="title"
                            value="{{ old('title') ?? $user->profile->title ?? ''}}"  
                            autocomplete="title" autofocus>
        
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div> 
    
                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label">Description</label>
        
                            <input id="description" 
                            type="text" 
                            class="form-control @error('description') is-invalid @enderror" 
                            name="description"
                            value="{{ old('description') ?? $user->profile->description ?? '' }}"  
                            autocomplete="description" autofocus>
        
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div> 
    
                    <div class="row mb-3">
                        <label for="url" class="col-md-4 col-form-label">URL</label>
        
                            <input id="url" 
                            type="text" 
                            class="form-control @error('url') is-invalid @enderror" 
                            name="url"
                            value="{{ old('url') ?? $user->profile->url ?? '' }}"  
                            autocomplete="url" autofocus>
        
                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                            <div class="row">
                                <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                                <input type="file" class="form-control-file" id="media" name="media">
    
                                @error('media')
                                        <strong>{{ $message }}</strong>
                                @enderror   
                            </div>
    
                            <div class="pt-4">
                                <button class="btn btn-primary">Save Profile</button>
                            </div>
                    </div> 
                </div>
            </div>
        </form>
    </div>
    
</div>
@endsection
