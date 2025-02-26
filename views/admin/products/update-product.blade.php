@extends('admin.layout.main')
@section('title')
    Update Product
@endsection

@section('content')
    <div class="container-fluid p-0 ">

        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="f_s_30 f_w_700 text_white">Update Product</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href={{ $_ENV['BASE_URL'] . 'dashboard' }}>Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href={{ $_ENV['BASE_URL'] . 'product' }}>Product</a>
                            </li>
                            <li class="breadcrumb-item active">Update Product</li>

                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card QA_section border-0">
                    <div class="card-body QA_table ">
                        @include('admin.components.alert-errors')
                        <form action="{{ $_ENV['BASE_URL'] . 'product/post-update/' . $product['id'] }}" method="post"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name Product</label>
                                <input type="text" class="form-control" name="name" value="{{ $product['name'] }}"
                                    id="exampleFormControlInput1" placeholder="Name Product">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                                    <input type="number" class="form-control" name="price"
                                        value="{{ $product['price'] }}" id="exampleFormControlInput1" placeholder="Price">
                                </div>
                                <div class="col-md-6  mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Stock</label>
                                    <input type="number" class="form-control" name="stock"
                                        value="{{ $product['stock'] }}" id="exampleFormControlInput1" placeholder="Stock">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" name="image" id="formFile">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" name="category" id="category">
                                        <option value="null" disabled>Select</option>

                                        @foreach ($categories as $category)
                                            @if ($product['category_id'] == $category['id'])
                                                <option value="{{ $category['id'] }}"selected>{{ $category['name'] }}
                                                </option>
                                            @else
                                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{ $product['description'] }}</textarea>
                            </div>

                            <div class="col-6 mb-3 ">
                                <label for="formFile" class="form-label">Current Image</label>
                                <img class="mx-3" src="{{ $_ENV['BASE_URL'] . $product['image'] }}" alt=""
                                    width="90">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>

                        <div class="row justify-content-end mt_30">


                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
