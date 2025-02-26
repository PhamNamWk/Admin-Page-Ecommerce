@extends('admin.layout.main')
@section('title')
    Add Product
@endsection

@section('content')
    <div class="container-fluid p-0 ">

        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="f_s_30 f_w_700 text_white">Add New</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href={{ $_ENV['BASE_URL'] . 'dashboard' }}>Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href={{ $_ENV['BASE_URL'] . 'product' }}>Product</a>
                            </li>
                            <li class="breadcrumb-item active">Add New</li>

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
                        <form action="{{ $_ENV['BASE_URL'] . 'product/store' }}" method="post"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name Product</label>
                                <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                                    placeholder="Name Product">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" id="exampleFormControlInput1"
                                    placeholder="Price">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id="exampleFormControlInput1"
                                    placeholder="Stock">
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" name="image" id="formFile">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" name="category" id="category">
                                        <option value="null" selected disabled>Select</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                            </div>


                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Add New</button>
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
