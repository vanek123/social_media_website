@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-center h-100">
        <form action="/p" enctype="multipart/form-data" method="POST" class="shadow p-3 mb-5 rounded" style="background-color: #1E1E24">
            @csrf
    
            <div class="row p-5 text-light">
                <div class="col-8 offset-2">
    
                         <h1>Add New Post</h1>

    
                    <div class="row mb-3">

                       
                        <label for="caption" class="col-md-4 col-form-label">Post Caption</label>
        
                            <input id="caption" 
                            type="text" 
                            class="form-control @error('caption') is-invalid @enderror" 
                            name="caption"
                            value="{{ old('caption') }}"  
                            autocomplete="caption" autofocus>
        
                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                            <div class="row">
                                <label for="image" class="col-md-4 col-form-label">Post Image/Video</label>
                                <input type="file" class="form-control-file" id="media" name="media">
    
                                @error('media')
                                        <strong>{{ $message }}</strong>
                                @enderror   
                            </div>
    
                            <div class="pt-4">
                                <button class="btn btn-primary">Add New Post</button>
                            </div>
                    </div> 
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
