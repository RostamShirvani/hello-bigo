<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        $this->mapAPIRoutes();
        $this->mapWebSiteRoutes();
        $this->mapWebAdminRoutes();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Define the "web site" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebSiteRoutes()
    {
        $routeFiles = glob(base_path('routes/web/site/*.php'));
        foreach ($routeFiles as $routeFile) {
            Route::middleware('web')
                ->group($routeFile);
        }
    }

    /**
     * Define the "web admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebAdminRoutes()
    {
        $routeFiles = glob(base_path('routes/web/admin/*.php'));
        foreach ($routeFiles as $routeFile) {
            Route::middleware('web')
                ->group($routeFile);
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAPIRoutes()
    {
        $routeFiles = glob(base_path('routes/api/*.php'));
        foreach ($routeFiles as $routeFile) {
            Route::middleware(['api'])
                ->group($routeFile);
        }
    }
}
