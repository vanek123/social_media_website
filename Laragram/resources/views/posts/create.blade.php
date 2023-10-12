@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Add New Post</h1>
                </div>

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
@endsection
