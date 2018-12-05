<?php
namespace App\Http\Controllers;


class BaseController extends Controller
{
    protected $errors = false;
    /**
     * Return a json Response
     *
     * @param mixed $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($data, $status = 200)
    {
        return response()->json($data, $status);
    }
    /**
     * Returns a Successful response for a request
     *
     * @param string $message
     * @param mixed|null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($message, $data = null)
    {
        return $this->jsonResponse([
            'message' => $message,
            'errors' => $this->errors,
            'data' => $data
        ]);
    }
    /**
     * Returns an Error response for a request
     *
     * @param string $message
     * @param int|null $code
     * @param mixed|null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code = null, $data = null)
    {
        $response = [
            'message' => $message,
            'errors' => true,
            'data' => $data,
        ];
        if ($code) {
            $response['code'] = $code;
            return $this->jsonResponse($response, $code);
        }
        return $this->jsonResponse($response);
    }

}
