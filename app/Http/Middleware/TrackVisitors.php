<?php

namespace App\Http\Middleware;

use Closure;
use App\Visitor;
use Illuminate\Support\Facades\Request;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        
        // Check if visitor exists today (or ever, based on requirement "unique visitor")
        // Requirement says: "jumlah pengunjung yang sudah masuk dan tidak boleh duplikat"
        // This usually implies unique IPs forever or unique sessions.
        // I will implement unique by IP address forever as per the simplest interpretation of "duplicate".
        
        $visitor = Visitor::where('ip_address', $ip)->first();

        if (!$visitor) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
