@if (!empty($_SESSION['errors']))
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($_SESSION['errors'] as $error)
                <li>{{ $error }}</li>
            @endforeach
            @php
                unset($_SESSION['errors']);
            @endphp
        </ul>
    </div>


@endif
