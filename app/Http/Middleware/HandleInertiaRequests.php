<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'slug' => Auth::user()->slug,
                        'phone' => Auth::user()->phone,
                        'image' => Auth::user()->image,
                        'created_at' => Auth::user()->created_at,
                        'role_id' => Auth::user()->role_id,
                        'role' => Auth::user()->role->slug,
                    ] : null,
                ];
            },
            'flash' => [
                'success' => function() use ($request){return $request->session()->get('success');} ,
                'error' => $request->session()->get('error') ,
                'status' => $request->session()->get('status') ,
            ],
            'app_name' => env('APP_NAME'),
            'app_description' => env('APP_DESCRIPTION'),
        ]);
    }
}
