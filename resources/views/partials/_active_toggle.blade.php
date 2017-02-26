@if($active === true)
    <button type="submit" class="btn btn-default btn-sm" formaction="{{ $endpoint }}">
        <span class="glyphicon glyphicon-off" style="color:#5cb85c; background:transparent" aria-hidden="true"></span>
    </button>
@else
    <button type="submit" class="btn btn-default btn-sm" formaction="{{ $endpoint }}">
        <span class="glyphicon glyphicon-off" style="color:red; background:transparent" aria-hidden="true"></span>
    </button>
@endif
