@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-primary float-right">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
            @if($posts->count() > 0)
                <table class="table">
                    <thead>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    {{ $post->title }}
                                </td>
                                <td>
                                    <img width="120px" height="60px" src="{{ asset('/storage/'.$post->image) }}" alt="post">
                                </td>
                                <td>
                                    @if(!$post->trashed())
                                        <button class="btm btn-success btn-sm">Edit</button>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btm btn-danger btn-sm">
                                           {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Posts Yet</h3>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-bold">
                                    Are you sure you want to delete this post?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
