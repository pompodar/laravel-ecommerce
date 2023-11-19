@extends('layouts.app') {{-- You can adjust the layout based on your application's structure --}}

@section('content')
    <h1>Create Category</h1>

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

    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf

        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" required>

        <!-- Add other form fields as needed -->

        <button type="submit">Create Category</button>
    </form>
@endsection
