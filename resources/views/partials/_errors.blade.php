@if (isset($errors))
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <ul>
                <li>{{ $error }}</li>
            </ul>
        </div>
    @endforeach
@endif
