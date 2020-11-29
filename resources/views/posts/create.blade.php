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
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="contents">Content</label>
                    <input id="contents" type="hidden" name="contents">
                    <trix-editor input="contents"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" id="published_at" class="form-control" name="published_at">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                         Add Post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js" integrity="sha512-DYqCX8kO/IP/uf6iT0+LnI6ft5aDdONwabmbgVxjR94pwCefuJwYwd+NAsKFpH3hk8wP2L3jRn9g61t3r2N9VA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true
        })
    </script>
@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css" integrity="sha512-An9xk8CstwPHW2Vzjj0RA6Gdbi3RUkEMqocdnEtq2C/iKJLKV0JGaJTMgyn2HeolVe0zDtDhXP7OMaTSffCkqw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
