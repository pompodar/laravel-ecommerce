@extends('layouts.dashboard')

@section('content')

    <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="breadcrumbs mb-3">
                <span class="text-muted fw-light"><a href="{{ route('admin.index') }}">Dashboard</a> /</span>
            
                <span class="text-muted fw-light"><a href="{{ route('admin.products.create') }}">add a product</a></span>

            </h4>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Variations</th>
                        <th>Stock</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($products as $product)
                            
                            <tr>
                                <td>
                                    
                                    <img src="{{ '/' . $product->image }}" class="product-image bx bx-sm me-3">
                                    
                                    <a href="{{ route('admin.products.show', ['slug' => $product->slug]) }}">

                                        <span class="fw-medium">{{$product->name}}</span>
                                    
                                    </a>
                                
                                </td>
                                <td>{{$product->price}}</td>
                                <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    
                                    @foreach ($product->variations as $variation)
                                        
                                        <li
                                        data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom"
                                        data-bs-placement="top"
                                        class="avatar avatar-xs pull-up"
                                        title="{{ $variation->price }}">
                                        <img src="/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                        </li>

                                    @endforeach
                                
                                </ul>
                                </td>
                                <td><span class="badge bg-label-primary me-1">{{$product->stock}}</span></td>
                                <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">

                                    <a class="dropdown-item" href="{{ route('admin.products.edit', ['product' => $product->id]) }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>

                                    <!-- Delete Button -->
                                    <form method="post" action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" type="submit" onclick="return confirm('Are you sure you want to delete this product?')"><i class="bx bx-trash me-1"></i>Delete</button>
                                    </form>
                        
                                    </div>
                                </div>
                                </td>
                            </tr>

                        @endforeach
                      
            
                    </tbody>
                  </table>
                  
                </div>

              </div>

              {{ $products->links() }}

              <!--/ Basic Bootstrap Table -->

            </div>
            <!-- / Content -->

        </div>    

@endsection
