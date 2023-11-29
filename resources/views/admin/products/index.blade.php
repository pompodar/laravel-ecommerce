@extends('layouts.dashboard')

@section('content')

    <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">Products /</span></h4>

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
                                    
                                    <span class="fw-medium">{{$product->name}}</span>
                                
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
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                    >
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        ><i class="bx bx-trash me-1"></i> Delete</a
                                    >
                                    </div>
                                </div>
                                </td>
                            </tr>

                        @endforeach
                      
            
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->

            </div>
            <!-- / Content -->

        </div>    

@endsection
