@if(isset($delete_endpoint))
    <form method="POST" action="{{ route($delete_endpoint, ['id' => $model_id]) }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit"
                id="{{"delete" . $model_id }}"
                class="btn btn-default  btn-xs outline round pull-right"
                style="margin-left: 5px;">
            <span class="glyphicon glyphicon-remove" style="color:red; background:transparent"
                  aria-hidden="true"></span>
        </button>
    </form>
@endif

@if(isset($show_endpoint))
    <a href="{{ route($show_endpoint, ['id' => $model_id]) }}"
       type="button"
       id="{{"show" . $model_id }}"
       class="btn btn-default btn-xs outline round pull-right"
        style="margin-left:5px;">
        <span class="glyphicon glyphicon-eye-open" style="color:#0099cc; background:transparent;"
              aria-hidden="true"></span>
    </a>
@endif

@if(isset($edit_endpoint))
    <a href="{{ route($edit_endpoint, ['id' => $model_id]) }}"
        type="button"
        id="{{"edit" . $model_id }}"
        class="btn btn-default btn-xs outline round pull-right"
        style="margin-left: 5px">
        <span class="glyphicon glyphicon-pencil" style="color:#5cb85c; background:transparent;"
        aria-hidden="true"></span>
    </a>
@endif

