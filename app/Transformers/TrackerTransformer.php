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
        $response = [
            'name'        => $item['name'],
            'description' => $item['description'],
            'bugger_id'   => $item['bugger_id'],
            'is_active'   => $item['is_active'],
            'is_resolved' => $item['is_resolved'],
            'created_at'  => $this->transformDateString($item['created_at']),
            'updated_at'  => $this->transformDateString($item['updated_at'])
        ];

        return $response;
    }
}
