<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href={{ file_url('assets/css/bootstrap1.min.css') }} />
</head>

<body>
    <div style="display: flex; justify-content: center; ">
        <div class="card col-md-4  ">
            <div class="card-header">
                <p class="fs-3">Login</p>
            </div>
            <div class="card-body ">
                <form action="{{ $_ENV['BASE_URL'] . 'login' }}" method="POST">
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer p-3">
                @include('admin.components.alert-errors')
            </div>
        </div>
    </div>

</body>

</html>
