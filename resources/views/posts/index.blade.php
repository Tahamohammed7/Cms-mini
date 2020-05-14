@extends('layouts.app')
@section('content')
<div class="clearfix">
 <a href="/posts/create" class="btn float-right btn-success" style="margin-bottom: 10px">Add Post</a>
</div>
<div class="card card-default">
	<div class="card-header">All Posts</div>
    @if($posts->count() > 0)
    <table class="card-body">
    	<table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                   {{--  <th>Description</th>
                    <th>Content</th> --}}
                    <th>Image</th>
                    <th>Active</th>
                </tr>
            </thead>
    		<tbody>
    			@foreach($posts as $post)
    			<tr>
    				<th>
    					{{$post->title}}
    				</th>
    {{--                 <th>
                        {{$post->description}}
                    </th>
                    <th>
                        {!! $post->content !!}
                    </th> --}}
                      <th>
                        <img src="{{ asset('storage/'.$post->image) }}" width="100px" height="50px">
                    </th>
    				<th>
    					<form class="float-right ml-2" action="{{ route('posts.destroy',$post->id) }}" 
    						method="post">
    						@csrf
    						@method('delete')
    						<button class="btn btn-danger btn-sm">
    							{{$post->trashed() ? 'Deleted' : 'Trashed'}}
    						</button>
    					</form>
                        @if(!$post->trashed())
    					<a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary float-right btn-sm">Edit</a>
                        
                        @else
                         <a href="{{ route('trashed.restore',$post->id) }}" class="btn   btn-primary float-right btn-sm">Restore</a>
                        @endif
    				</th>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
          @else
             <div class="card-body">
               <h1 class="text-center">No Posts Yet.</h1>
          </div>
    @endif
    </table>
</div>
@endsection