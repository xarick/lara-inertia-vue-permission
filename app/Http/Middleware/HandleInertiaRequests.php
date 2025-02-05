<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        // dd(
        //     $request->user(),
        //     $this->loadUserPermissions(),
        // );
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'userPermissions' => $this->loadUserPermissions(),
            ],
        ]);
    }

    protected function loadUserPermissions()
    {
        if (auth()->check())
            return auth()->user()->getAllPermissions()->pluck('name');
        return null;
    }
}
