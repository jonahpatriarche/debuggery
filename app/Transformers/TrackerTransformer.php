<?php

namespace App\Transformers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TrackerTransformer extends BaseEloquentTransformer implements TransformerInterface
{

    /**
     * Transform tracker item
     *
     * @param array $item
     *
     * @return array $response
     */
    public function item($item)
    {
        $response = $item;

        return $response;
    }
}
