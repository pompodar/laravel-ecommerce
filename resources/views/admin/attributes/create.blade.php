@extends('layouts.app') {{-- You can adjust the layout based on your application's structure --}}

@section('content')
    <h1>Create Attribute</h1>

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

    <form action="{{ route('admin.attributes.store') }}" method="post">
        @csrf

        <label for="name">Attribute Name:</label>
        <input type="text" name="name" id="name" required>

        <button type="submit">Create Attribute</button>
    </form>
@endsection
