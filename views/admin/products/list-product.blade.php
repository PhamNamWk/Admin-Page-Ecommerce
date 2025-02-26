@extends('admin.layout.main')

@section('title')
    Product
@endsection
@section('content')
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">

                                <h3 class="m-0"> <a href="{{ $_ENV['BASE_URL'] . 'dashboard' }}"
                                        class="text-dark">Dashboard</a>
                                    > Product</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>List Products</h4>
                                <div class="box_right d-flex lms_block">

                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{ $_ENV['BASE_URL'] . 'product' }}" Active="#"
                                                method="GET">
                                                <div class="search_field">
                                                    <input type="text" name="keyWord"
                                                        placeholder="Search content here...">
                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        <a href="{{ $_ENV['BASE_URL'] . 'product/add' }}" data-bs-toggle="modal"
                                            data-bs-target="#addcategory" class="btn_1">Add New</a>
                                    </div>
                                </div>
                            </div>
                            @include('admin.components.alert-messages')
                            <div class="QA_table mb_30">

                                <table class="table  ">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Category</th>

                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($products['data']))
                                            @foreach ($products['data'] as $product)
                                                <tr>
                                                    <td scope="row"> {{ $product['id'] }}</td>
                                                    <td>
                                                        <img src="{{ $product['image'] != null ? $_ENV['BASE_URL'] . $product['image'] : '#' }}"
                                                            alt width="60">
                                                        <p class="d-inline-block  mb-0">
                                                            <a href class="d-inline-block  mb-0 ">{{ $product['name'] }}</a>
                                                        </p>
                                                    </td>
                                                    <td>{{ $product['price'] }}</td>
                                                    <td>{{ $product['stock'] }}</td>
                                                    <td>{{ $product['category'] }}</td>
                                                    <td>
                                                        <a href="{{ $_ENV['BASE_URL'] . 'product/update/' . $product['id'] }}"
                                                            class="text-success me-2"><i class="ti-pencil-alt"></i></a>
                                                        <a href="{{ $_ENV['BASE_URL'] . 'product/delete/' . $product['id'] }}"
                                                            onclick="return confirm('Bạn có chắc muốn xóa không ?')"
                                                            class="text-danger ms-2"><i class="ti-close"></i></a>
                                                        <a href="{{ $_ENV['BASE_URL'] . 'product/show/' . $product['id'] }}"
                                                            class="text-primary ms-2"><i class="ti-receipt"></i></a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <td colspan="6" class="text-center">No data avalable in table</td>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row justify-content-end mt_30">

                                <nav aria-label="Page navigation" class="d-flex">
                                    <ul class="pagination">
                                        @for ($i = 1; $i <= $products['totalPage']; ++$i)
                                            <li class="page-item @if ($products['page'] == $i) active @endif">
                                                <a class="page-link"
                                                    href="{{ $_ENV['BASE_URL'] }}product/?page={{ $i }}&limit={{ $products['limit'] }}{{ isset($_GET['keyWord']) ? '&keyWord=' . $_GET['keyWord'] : '' }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
            </div>
        </div>
    </div>
@endsection
