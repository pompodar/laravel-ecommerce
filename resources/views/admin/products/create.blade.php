@extends('layouts.app') {{-- You can adjust the layout based on your application's structure --}}

@section('content')
    <h1>All Products</h1>

    
    <h2>Create Product</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <br>

        <label for="price">Price:</label>
        <input type="number" name="price" required>
        <br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" required>
        <br>

        <label for="categories">Categories:</label>
        <select name="categories[]" id="categories" multiple="multiple">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>

        <label for="tags">Tags:</label>
        <select name="tags[]" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        <br>

        <label for="tags">Attributes:</label>
        <select name="attributes[]" multiple>
            @foreach($attributes as $attribute)
                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
            @endforeach
        </select>
        <br>

        <label for="photo">Photo:</label>
        <input type="file" name="photo">
        <br>

        <button type="submit">Submit</button>
    </form>

@endsection
