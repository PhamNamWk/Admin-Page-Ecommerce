@extends('admin.layout.main')
@section('title')
    Update Category
@endsection

@section('content')
    <div class="container-fluid p-0 ">

        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="f_s_30 f_w_700 text_white">Update Category</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href={{ $_ENV['BASE_URL'] . 'dashboard' }}>Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href={{ $_ENV['BASE_URL'] . 'category' }}>Category</a></li>
                            <li class="breadcrumb-item active">Update</li>

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
                        <form action="{{ $_ENV['BASE_URL'] . 'category/post-update/' . $category['id'] }}" method="post"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                                    value="{{ $category['name'] }}" placeholder="Category Name">
                            </div>
                            <div class="mb-3">
                                @if ($category['image'] != null)
                                    <img src="{{ $_ENV['BASE_URL'] . $category['image'] }}" width="90" alt="">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>

                                <input class="form-control" type="file" name="image" id="formFile">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{ $category['description'] }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Active</label>
                                <input class="form-check-input p-2 mx-2" type="checkbox" name="status"
                                    id="flexCheckChecked" {{ $category['status'] ? 'checked' : '' }}>

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
