<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserStripeCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $request = getJsonDataValues($request);
        $userId = $request['user_id'] ?? null;
        if (empty($userId)) {
            return response()->json([
                'error' => true,
                'message' => 'User ID is required'
            ], 400);
        }
        if (is_null($user = $this->findUser($userId))) {
            return response()->json([
                'error' => true,
                'message' => 'User not found'
            ], 400);
        }
        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
        }
        return $response;
    }

    private function findUser($userId)
    {
        return User::find($userId);
    }
}
