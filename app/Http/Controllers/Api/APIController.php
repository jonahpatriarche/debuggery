<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TransformationException;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HTTP;
use Illuminate\Support\Facades\Log;

class APIController extends Controller
{

    /**
     * @var
     */
    protected $transformer;

    /**
     * @var
     */
    protected $response_code;

    /**
     * Abort the current request.
     *
     * @param  integer $response_code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function abort($response_code, $message = null)
    {
        $message = $message ?: $this->getMessage($response_code);
        $this->setCode($response_code);

        return $this->sendResponse([
            'error' => [
                'message' => $message,
                'code'    => $response_code
            ]
        ]);
    }

    /**
     * Confirm the current request was successful.
     *
     * @param  integer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirm($response_code, $message = null)
    {
        $message = $message ?: $this->getMessage($response_code);
        $this->setCode($response_code);

        return $this->sendResponse([
            'message' => $message,
            'code'    => $response_code
        ]);
    }

    /**
     * Transform data and send response.
     *
     * @param \Illuminate\Database\Eloquent\Model|
     *        \Illuminate\Contracts\Pagination\LengthAwarePaginator|
     *        \Illuminate\Database\Eloquent\Collection
     * @param integer|null
     * @param array|null
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $response_code = null, $headers = [])
    {
        if ($response_code) {
            $this->setCode($response_code);
        }

        try {
            $response = $this->transformer->transform($data);
        }

        catch (TransformationException $e) {
            Log::error($e->getTraceAsString());

            return $this->abort(HTTP::HTTP_I_AM_A_TEAPOT, 'Transformation Exception occurred');
        }

        return $this->sendResponse($response, $headers);
    }

    /**
     * Send response to browser.
     *
     * @param  array $data
     * @param  array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResponse($data, $headers = [])
    {
        return JsonResponse::create($data, $this->getCode(), $headers);
    }

    /**
     * Set the response code.
     *
     * @param integer $code
     */
    public function setCode($response_code)
    {
        $this->response_code = $response_code;

        return $this;
    }

    /**
     * Get the response code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->response_code;
    }

    /**
     * Get the status text.
     *
     * @param  integer $response_code
     *
     * @return string
     */
    public function getMessage($response_code = null)
    {
        if (is_null($response_code)) {
            $response_code = $this->getCode();
        }

        return HTTP::$statusTexts[$response_code];
    }
}
