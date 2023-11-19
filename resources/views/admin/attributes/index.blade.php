@extends('layouts.app')

@section('content')
    <h1>All Attributes</h1>

    <a href="{{ route('admin.attributes.create') }}">add an attribute</a>

    <ul>
        @foreach ($attributes as $attribute)
            <li>{{ $attribute->name }}</li>
        @endforeach
    </ul>

    {{ $attributes->links() }}

@endsection
