@extends('admin.layout.main')

@section('title')
    Category
@endsection
@section('content')
    <div class="container-fluid p-0 ">

        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="f_s_30 f_w_700 text_white">List Categories</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href={{ $_ENV['BASE_URL'] . 'dashboard' }}>Dashboard</a></li>
                            <li class="breadcrumb-item active">Category</li>

                        </ol>
                    </div>
                    <a href={{ $_ENV['BASE_URL'] . 'category/add' }} class="white_btn3"><i class="ti-plus"></i> Add
                        New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card QA_section border-0">
                    <div class="card-body QA_table ">
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2 my-3">
                                <div class="search_inner">
                                    {{-- //search --}}
                                    <form action="{{ $_ENV['BASE_URL'] . 'category' }}" Active="" method="GET">
                                        <div class="search_field">
                                            <input type="text" name="keyWord" placeholder="Search content here...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        @include('admin.components.alert-messages')
                        <div class="table-responsive shopping-cart ">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">ID</th>
                                        <th class="border-top-0">Category Name</th>
                                        <th class="border-top-0">Image</th>
                                        <th class="border-top-0">Description</th>
                                        <th class="border-top-0">Status</th>

                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($categories))
                                        @foreach ($categories['data'] as $category)
                                            <tr>
                                                <td>{{ $category['id'] }}</td>

                                                <td>
                                                    <p class="d-inline-block align-middle mb-0 text-dark">
                                                        {{ $category['name'] }}
                                                    </p>
                                                </td>
                                                <td class="d-inline-block align-middle justify-center"><img
                                                        src="{{ $category['image'] === null ? '#' : $_ENV['BASE_URL'] . $category['image'] }}"
                                                        alt width="60"></td>
                                                <td>{{ substr($category['description'], 0, 20) . '...' }}</td>
                                                <td>
                                                    <p
                                                        class="{{ $category['status'] == 1 ? 'badge bg-success' : 'badge bg-danger' }}">
                                                        {{ $category['status'] == 1 ? 'Active' : 'Hidden' }}</p>
                                                </td>
                                                <td>
                                                    <a href="{{ $_ENV['BASE_URL'] . 'category/update/' . $category['id'] }}"
                                                        class="text-success me-2"><i class="ti-pencil-alt"></i></a>
                                                    <a href="{{ $_ENV['BASE_URL'] . 'category/delete/' . $category['id'] }}"
                                                        onclick="return confirm('Bạn có chắc muốn xóa không ?')"
                                                        class="text-danger ms-2"><i class="ti-close"></i></a>
                                                    <a href="{{ $_ENV['BASE_URL'] . 'category/show/' . $category['id'] }}"
                                                        class="text-primary ms-2"><i class="ti-receipt"></i></a>
                                                </td>
                                        @endforeach
                                    @else
                                        <tr class="text-center">
                                            <td colspan="6">No data avalable in table</td>
                                        </tr>
                                    @endif






                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="row justify-content-end mt_30">

                            <nav aria-label="Page navigation" class="d-flex">
                                <ul class="pagination">
                                    @for ($i = 1; $i <= $categories['totalPage']; ++$i)
                                        <li class="page-item @if ($categories['page'] == $i) active @endif">
                                            <a class="page-link"
                                                href="{{ $_ENV['BASE_URL'] }}category/?page={{ $i }}&limit={{ $categories['limit'] }}{{ isset($_GET['keyWord']) ? '&keyWord=' . $_GET['keyWord'] : '' }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                </ul>
                            </nav>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
