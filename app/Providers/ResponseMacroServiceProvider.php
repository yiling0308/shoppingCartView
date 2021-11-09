<?php

namespace App\Providers;

use App\Enums\StatusCodeEnum;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function (
            $data = null,
            $message = null,
            $status = StatusCodeEnum::SUCCESS,
            $code = SymfonyResponse::HTTP_OK
        ) {
            return response()->json([
                'status' => $status,
                'message' => $message ?? __('messages.success'),
                'dataGrid' => $data,
            ], $code);
        });

        Response::macro('fail', function (
            $data = null,
            $message = null,
            $status = StatusCodeEnum::FAIL,
            $code = SymfonyResponse::HTTP_BAD_REQUEST
        ) {
            return response()->json([
                'status' => $status,
                'message' => $message ?? __('messages.fail'),
                'dataGrid' => $data,
            ], $code);
        });
    }
}
