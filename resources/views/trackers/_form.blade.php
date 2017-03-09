<form method="POST" action="{{ $route }}">

    {{ csrf_field() }}
    <input type="hidden" name="_method" value="{{ $_method }}">
    <p class="control">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" autofocus>
    </p>
    @if($_method == 'POST')
        <p class="control">
            <label for="dump" class="label">
                <input type="checkbox" name="dump" id="dump">
                Ran <code>composer dump-autoload</code>
            </label>
        </p>
        <p class="control">
            <label for="clear-cache" class="label">
                <input type="checkbox" name="clear-cache" id="clear-cache">
                Ran <code>php artisan cache:clear</code>
            </label>
        </p>
        <p class="control">
            <label for="clear-config" class="label">
                <input type="checkbox" name="clear-config" id="clear-config">
                Ran <code>php artisan config:clear</code>
            </label>
        </p>
        <p class="control">
            <label for="db-connection" class="label">
                <input type="checkbox" name="db-connection" id="db-connection">
                Checked database connection
            </label>
        </p>
    @endif
    <div class="control is-grouped">
        <p class="control">
            <button class="button is-primary">Submit</button>
        </p>
        <p class="control">
            <button class="button is-link" href="{{ back() }}">Cancel</button>
        </p>
    </div>
</form>
