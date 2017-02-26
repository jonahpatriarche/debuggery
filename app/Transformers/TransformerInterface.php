<?php

namespace App\Transformers;

interface TransformerInterface
{

    /**
     * Transform item
     *
     * @param $item
     *
     * @return mixed
     */
    public function item($item);

    /**
     * Transform data or array/collection of data
     *
     * @param $data
     *
     * @return mixed
     */
    public function transform($data);
}
