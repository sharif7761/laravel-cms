@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? 'Edit Post' : 'Create New Post' }}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(isset($post))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="5" rows="5">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="contents">Content</label>
                    <input id="contents" type="hidden" name="contents" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="contents"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" id="published_at" class="form-control" name="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
                </div>
                @if(isset($post))
                    <div class="form-group">
                        <img width="120px" height="60px" src="{{ asset('/storage/'.$post->image) }}" alt="post">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" id="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if(isset($post))
                                    @if($category->id == $post->category_id)
                                     selected
                                    @endif
                                @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if($tags->count() > 0)
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if(isset($post))
                                    @if($post->hasTag($tag->id))
                                        selected
                                    @endif
                                @endif
                            >
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{ isset($post) ? 'Update Post' : 'Add Post' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js" integrity="sha512-DYqCX8kO/IP/uf6iT0+LnI6ft5aDdONwabmbgVxjR94pwCefuJwYwd+NAsKFpH3hk8wP2L3jRn9g61t3r2N9VA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true
        });

        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>
@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css" integrity="sha512-An9xk8CstwPHW2Vzjj0RA6Gdbi3RUkEMqocdnEtq2C/iKJLKV0JGaJTMgyn2HeolVe0zDtDhXP7OMaTSffCkqw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
