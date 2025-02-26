@extends('admin.layout.main')
@section('title')
    Detail Category
@endsection

@section('content')
    <div class="container-fluid p-0 ">

        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="f_s_30 f_w_700 text_white">Detail Category</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href={{ $_ENV['BASE_URL'] . 'dashboard' }}>Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href={{ $_ENV['BASE_URL'] . 'category' }}>Category</a></li>
                            <li class="breadcrumb-item active">Detail</li>

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
                        <div class="table-responsive">
                            <table class="table table-light">
                                <thead>
                                    <tr>
                                        <th scope="col">Thông tin</th>
                                        <th scope="col"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row" class="text-uppercase">Image</td>
                                        <td>
                                            @if ($category['image'] === null)
                                                <span>Không có ảnh</span>
                                            @else
                                            @endif
                                            <img src=" {{ $_ENV['BASE_URL'] . $category['image'] }}" alt width="90">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-uppercase">ID</td>
                                        <td>{{ $category['id'] }}</td>

                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-uppercase">Category Name</td>
                                        <td>{{ $category['name'] }}</td>

                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-uppercase">status</td>
                                        <td>
                                            <p
                                                class="{{ $category['status'] == 1 ? 'badge bg-success' : 'badge bg-danger' }}">
                                                {{ $category['status'] == 1 ? 'Active' : 'Hidden' }}</p>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-uppercase">Description</td>
                                        <td>{{ $category['description'] }}</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>


                        <div class="row justify-content-end mt_30">


                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
