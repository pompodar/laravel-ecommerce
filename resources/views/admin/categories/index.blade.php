@extends('layouts.app')

@section('content')
    <h1>All Categories</h1>

    <a href="{{ route('admin.categories.create') }}">add a category</a>

    <ul>
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>

    {{ $categories->links() }}

@endsection
