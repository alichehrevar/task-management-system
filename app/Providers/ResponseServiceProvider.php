<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
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
        Response::macro('api', function($data=[],string $message='',int $status=200)
        {
            if ((is_null($data)||(is_object($data)&&$data->count()==0)||(is_array($data)&&count($data)==0))&&($status==200||$status==201)){
                return \response()->json([
                    'data' => [],
                    'message' => 'nothing found',
                    'status' => 404
                ]);
            }
            if ($status == 422) {
                return \response()->json([
                    'data' => $data,
                    'message' => 'validation error',
                    'status' => 422
                ], 422);
            }
            return \response()->json([
                'data' => empty($data) ? ['result' => $message] : $data,
                'message' => $message,
                'status' => $status
            ]);
        });
    }
}
