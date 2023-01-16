<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class ResponseTimeMiddleware
{

    public function handle(Request $request, Closure $next) {
        $startTime = round(microtime(true) * 1000);
        $response = $next($request);
        $endTime = round(microtime(true) * 1000);
        $diffTime = $endTime - $startTime;
        $oldContent = json_decode($response->getContent(), true);
        $newContent = [
            "response" => $oldContent,
            "response_time" => sprintf('%.2fms', ($diffTime/1000)),
        ];
        $response->setContent($newContent);
        return $response;
    }

}
