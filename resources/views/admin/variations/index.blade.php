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

        @if ($variation->photos->isNotEmpty())
                <div>
                    <strong>Variation Photos:</strong>
                    <div class="row">
                        @foreach ($variation->photos as $photo)
                            <div class="col-md-3">
                                <img src="{{ asset('storage/' . $photo->photo) }}" alt="Variation Photo" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    @endforeach
@endsection
