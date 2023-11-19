@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>

    <h2>Variations:</h2>
    @foreach ($product->variations as $variation)
        <p>Price: ${{ $variation->price }}</p>
        <!-- Add other variation details as needed -->

         @if ($variation->attributeValues->isNotEmpty())
            <ul>
                @foreach ($variation->attributeValues as $attribute)
                    <li>{{ $attribute->attribute->name }}: {{ $attribute->value }}</li>
                @endforeach
            </ul>
        @endif
    @endforeach
@endsection
