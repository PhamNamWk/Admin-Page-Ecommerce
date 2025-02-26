@if (!empty($_SESSION['messages']))
    <div class="alert alert-success" role="alert">
        <ul>
            @foreach ($_SESSION['messages'] as $message)
                <li>{{ $message }}</li>
            @endforeach
            @php
                unset($_SESSION['messages']);
            @endphp

        </ul>
    </div>

@endif
