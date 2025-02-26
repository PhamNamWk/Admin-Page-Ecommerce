@extends('admin.layout.main')
@section('title')
    Update User
@endsection

@section('content')
    <div class="container-fluid p-0 ">

        <div class="row">
            <div class="col-12">
                <div class="page_title_box d-flex align-items-center justify-content-between">
                    <div class="page_title_left">
                        <h3 class="f_s_30 f_w_700 text_white">Update New</h3>
                        <ol class="breadcrumb page_bradcam mb-0">
                            <li class="breadcrumb-item"><a href={{ $_ENV['BASE_URL'] . 'dashboard' }}>Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href={{ $_ENV['BASE_URL'] . 'user' }}>User</a></li>
                            <li class="breadcrumb-item active">Update New</li>

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
                        <form action="{{ $_ENV['BASE_URL'] . 'user/post-update/' . $user['id'] }}" method="post"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="exampleFormControlInput1"
                                    placeholder="Username" value="{{ $user['username'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="exampleFormControlInput1"
                                    placeholder="email" value="{{ $user['email'] }}">
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="formFile" class="form-label">Avatar</label>
                                    <input class="form-control" type="file" name="avatar" id="formFile">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="role" class="form-label">Type</label>
                                    <select class="form-select" name="role" id="role">
                                        <option value="Client" {{ $user['role'] == 'Client' ? 'selected' : '' }}>Client
                                        </option>

                                        <option value="Admin" {{ $user['role'] == 'Admin' ? 'selected' : '' }}>Admin
                                        </option>
                                    </select>

                                </div>
                                <div class="col-6 mb-3">
                                    <label for="formFile" class="form-label">Current Avatar</label>
                                    <img src="{{ $_ENV['BASE_URL'] . $user['avatar'] }}" alt="" width="80"
                                        class="mx-3">
                                </div>

                            </div>


                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Active</label>
                                <input class="form-check-input p-2 mx-2" type="checkbox" name="status"
                                    id="flexCheckChecked" {{ $user['status'] == 1 ? 'checked' : '' }} checked>

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
