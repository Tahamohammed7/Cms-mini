@extends('layouts.app')
@section('stylesheet')
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div card card-default>
	<div class="card-header">
		{{isset($post) ? "Update Post" : "Add a New Post"}}
	</div>
{{-- 		  @if ($errors->any())
	  <div class="alert alert-danger">
	  	<ul>
	  		@foreach($errors->all() as $error)
	  		<li>{{ $error }}</li>
	  		@endforeach
	  	</ul>
	  </div>
	  @endif --}}
	<div class="card-body">
		<form action="{{isset($post) ? route('posts.update',$post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			@if(isset($post))
			@method('put')
			@endif
			<div class="form-group">
				<label for="post">Name:</label>
				<input class="@error('title') is-invalid @enderror form-control" type="text" value="{{isset($post) ? $post->title: ""}}" name="title" placeholder="Add a Title">
				@error('title')
				<div class="alert alert-danger">
					{{$message}}
				</div>
				@enderror
			</div>
			<div class="form-group">
				<label for="post description">Description:</label>
				<textarea class="form-control" rows="2" placeholder="Add a Description" name="description">{{isset($post) ? $post->description: ""}}</textarea>
				@error('description')
				<div class="alert alert-danger">
					{{$message}}
				</div>
				@enderror
			</div>
			<div class="form-group">
				<label for="post content">Content:</label>
			 <input id="x" type="hidden" name="content" value="{{isset($post) ? $post->content: ""}}">
             <trix-editor input="x"></trix-editor>
			{{-- 	@error('content')
				<div class="alert alert-danger">
					{{$message}}
				</div>
				@enderror --}}
			</div>
			@if(isset($post))
			<div class="form-group">
				<img src="{{ asset('storage/'.$post->image) }}">
			</div>
			@endif
			<div class="form-group">
				<label for="post image">Image:</label>
				<input class="@error('image') is-invalid @enderror form-control" type="file" value="{{isset($post) ? $post->image: ""}}"
				 name="image">
				@error('image')
				<div class="alert alert-danger">
					{{$message}}
				</div>
				@enderror
			</div>
            <div class="form-group">
                  <label for="selectCategory">Select a category</label>
                  <select name="categoryID" class="form-control" id="selectCategory">
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                @if(!$tags->count() <= 0 && isset($post))
                <div class="form-group">
                  <label for="selectTag">Select a Tag</label>
                  <select name="tags[]" class="form-control tags" id="selectTag" multiple>
                    @foreach ($tags as $tag)
                      <option value="{{$tag->id}}"
                          @if ($post->hasTag($tag->id))
                          	selected
                          @endif
                      	>{{$tag->name}}</option>
                    @endforeach
                  </select>
                </div>
                @endif
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
			<div class="form-group">
				<button type="submit" class="btn btn-success">
					{{isset($post) ? "Update" : "Add"}}
				</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('scripts')
     <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
     <script>
     	$(document).ready(function() {
        $('.tags').select2();
      });
     </script>
@endsection
