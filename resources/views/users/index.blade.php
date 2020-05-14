@extends('layouts.app')
@section('content')
<div class="card card-default">
	<div class="card-header">All Users</div>
    @if($users->count() > 0)
    <table class="card-body">
    	<table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                   {{--  <th>Description</th>
                    <th>Content</th> --}}
                    <th>Role</th>
                    <th>Image</th>
                </tr>
            </thead>
    		<tbody>
    			@foreach($users as $user)
    			<tr>
    				<th>
    					{{$user->name}}
    				</th>
                    <th>
                        @if (!$user->isAdmin())
                        <form action="{{ route('users.make-admin',$user->id) }}" method="post">
                            @csrf
                            <button class="btn btn-success" type="submit">
                                Make admin
                            </button>
                        </form>
                        @else
                        {{$user->role}}
                        @endif
                    </th>
    {{--                 <th>
                        {{$post->description}}
                    </th>
                    <th>
                        {!! $post->content !!}
                    </th> --}}
                      <th>
                       <img src="{{$user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar()}}" style="border-radius: 50%" width="60px" height="60px">
                    </th>
    {{-- 				<th>
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
    				</th> --}}
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
          @else
             <div class="card-body">
               <h1 class="text-center">No Users Yet.</h1>
          </div>
    @endif
    </table>
</div>
@endsection
