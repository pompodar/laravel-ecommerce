@extends('layouts.app')

@section('content')
    <h1>Add Variation for {{ $product->name }}</h1>

    <form action="{{ route('admin.variations.store', $product) }}" method="post">
        @csrf

        <label for="price">Price:</label>
        <input type="number" name="price" value="{{ old('price') }}" step="0.01" required>
        <br>

        @foreach($product->attributes as $attribute)
            <label for="attributes[{{ $attribute->id }}][value]">{{ $attribute->name }}:</label>
            <input type="text" name="attributes[{{ $attribute->id }}][value]" value="{{ old('attributes.'.$attribute->id.'.value') }}" required>
            <input type="hidden" name="attributes[{{ $attribute->id }}][attribute_id]" value="{{ $attribute->id }}">
            <br>
        @endforeach

        <button type="submit">Add Variation</button>
    </form>
@endsection
