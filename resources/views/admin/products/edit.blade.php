@extends('layouts.dashboard')

@section('content')

    <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="breadcrumbs mb-3">
                    <span class="text-muted fw-light"><a href="{{ route('admin.index')}}">Dashboard</a> / </span>
                    <span class="text-muted fw-light"><a href="{{ route('admin.products.index')}}">Products</a> / </span>
                    <span class="text-muted fw-light"><a href="{{ route('admin.products.show', ['slug' => $product->slug]) }}">{{ $product->name }}</a> / </span>

                </h4>

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

              <!-- Basic Layout -->
              <div class="row">

                <div class="col-xl">
                  <div class="card mb-4">

                    <div class="card-body">
                      <form action="{{ route('admin.products.update', $product) }}" method="post" enctype="multipart/form-data">
                        
                        @csrf
                        
                        @method('put')
                      
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Name</label>
                          <input name="name" type="text" value="{{ $product->name }}" class="form-control" id="basic-default-fullname" placeholder="" required/>
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-message">Description</label>
                          <textarea
                            name="description"
                            id="basic-default-message"
                            class="form-control"
                            placeholder=""
                            required >{{ $product->description }}
                        </textarea>
                        </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Price</label>
                          <input name="price" type="number" value="{{ $product->price }}" class="form-control" id="basic-default-company" placeholder="" required/>
                        </div>

                        <div class="mb-3">
                        
                            <label class="form-label" for="photo">Photo:</label>
                        
                            <input class="form-control" type="file" name="photo">

                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">Stock</label>
                          <input name="stock" type="number" value="{{ $product->stock }}" class="form-control" id="basic-default-company" placeholder="" required/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="categories">Categories:</label>
                            <select class="form-control" name="categories[]" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="categories">Attributes:</label>
                            <select class="form-control" name="attributes[]" multiple>
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->id }}" {{ in_array($attribute->id, $selectedAttributes) ? 'selected' : '' }}>
                                        {{ $attribute->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Edit</button>
                      </form>
                    </div>

                  </div>
                </div>
            </div>
        </div>
    </div>
                
@endsection
