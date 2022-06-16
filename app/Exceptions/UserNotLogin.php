<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Nette\Schema\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class UserNotLogin extends Exception
{

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response([
            'errors' => [
                'message' => $this->getMessage(),
                'status' => Response::HTTP_UNAUTHORIZED
            ]
        ], Response::HTTP_UNAUTHORIZED);
    }
}
