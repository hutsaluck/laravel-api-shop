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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render( \Illuminate\Http\Request $request): \Illuminate\Http\Response
    {
        if ($request->is('api/*')) {
            return response([
                'errors' => [
                    'message' => $this->getMessage()
                ]
            ], Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request);
    }
}
