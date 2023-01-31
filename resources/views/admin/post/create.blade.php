@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger my-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- {{ Auth::user()->id }} --}}

    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.post.store') }}" class="mx-5 my-3">

        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="string" class="form-control @error('title') is-invalid @enderror" id="">
            {{-- Errori inline --}}
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror" id=""></textarea>
            @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select class="form-control" name="category_id" id="">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>

            @foreach ($tags as $tag)
                <label for="">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                    {{ $tag->name }}
                </label>
            @endforeach

        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input name="image" type="file" class="form-control-file">

        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@endsection
