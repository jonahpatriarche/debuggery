<?php

namespace App\Transformers;

use App\Exceptions\TransformationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEloquentTransformer
{

    /**
     * Transformed Response.
     *
     * @var array
     */
    protected $response = [];

    /**
     * Transform object(s) into the correct output format.
     *
     * @param  mixed $data
     *
     * @return array
     */
    public function transform($data)
    {
        if ($data instanceof Collection) {
            $this->response = $this->transformCollection($data->all());
        }

        elseif (is_array($data)) {
            $this->response = $data;
        }

        elseif ($data instanceof Model) {
            $this->response = $this->item($data);
        }

        else {
            throw new TransformationException('Unrecognised Data Type');
        }

        return $this->response;
    }

    /**
     * Transform a collection object.
     *
     * @param  array $collection
     *
     * @return array
     */
    public function transformCollection($collection)
    {
        return array_map([$this, 'item'], $collection);
    }


    /**
     * Template for individual object data.
     *
     * @param  array $item
     *
     * @return array
     */
    abstract public function item($item);

}
