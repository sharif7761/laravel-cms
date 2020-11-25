@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
{{--            {{ isset($category) ? 'Edit Category' : 'Create New Category' }}--}}
            Create Post
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{ isset($category) ? $category->name : '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" cols="5" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" id="published_at" class="form-control" name="published_at" value="{{ isset($category) ? $category->name : '' }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" class="form-control" name="image" value="{{ isset($category) ? $category->name : '' }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($category) ? 'Update Category' : 'Add Category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
