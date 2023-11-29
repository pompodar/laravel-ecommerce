@extends('layouts.dashboard') 

@section('content')

    <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="breadcrumbs mb-3">
                <span class="text-muted fw-light"><a href="{{ route('admin.index')}}">Dashboard</a> / </span>
                <span class="text-muted fw-light"><a href="{{ route('admin.products.index')}}">Products</a> / </span>
              </h4>

              <!-- Examples -->
              <div class="row mb-5">
                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                    <img class="card-img-top" src="{{ '/' . $product->image }}" alt="Card image cap" />
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title">{{ $product->name }}</h5>
                      
                      <p class="card-text">
                        
                        {{ $product->description }}                      
                      
                      </p>

                      <p class="card-text">
                        
                        {{ $product->price }}                      
                      
                      </p>

                      <p class="card-text">
                        
                        Stock: {{ $product->stock }}                      
                      
                      </p>

                        <span class="card-text">Categories:</span>

                      <span class="card-text">
                        
                        @foreach ($product->categories as $category)
                            {{ $category->name }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach                      
                      
                      </span>

                    <br>

                      <span class="card-text">Attributes:</span>

                      <span class="card-text">
                        
                        @foreach ($product->attributes as $attribute)
                            {{ $attribute->name }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach                      
                      
                      </span>

                      <br>

                      <span class="card-text">Variations:</span>

                      <span class="card-text">
                        
                        {{ count($product->variations) }}                     
                      
                      </span>
                    
                      <br>

                      <div class="actions">

                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-outline-primary"><i class="bx bx-edit-alt me-1"></i>Edit</a>

                        <!-- Delete Button -->
                        <form method="post" action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-primary" onclick="return confirm('Are you sure you want to delete this product?')"><i class="bx bx-trash me-1"></i>Delete</button>
                        </form>

                      </div>

                    </div>
                  </div>
                </div>

            </div>
        </div>
    </div>

@endsection