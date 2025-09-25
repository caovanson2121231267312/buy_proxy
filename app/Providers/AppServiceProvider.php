<?php

namespace App\Providers;

use Exception;
use App\Models\Proxy;
use App\Models\Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            Paginator::useBootstrap();
        $user = auth()->id();

        $notifications = \App\Models\Notification::where('user_ids', 'LIKE', "%$user%")->latest()->take(100)->get();
        // $notifications = \App\Models\Notification::whereJsonContains('user_ids', auth()->id())->latest()->take(100)->get();

        $data_proxy = Proxy::where('status', 1)
            ->select('proxy_type', 'proxy_type_name')
            ->distinct()
            ->get();

        $data_c1 = Config::whereNull('desc')->get()->pluck('value', 'key')->toArray();
        $data_c2 = Config::whereNotNull('desc')->get()->pluck('desc', 'key')->toArray();
        // dd($data_proxy);

        // Share cho toàn bộ view
        View::share('notifications', $notifications);
        View::share('data_proxy', $data_proxy);
        View::share('data_c1', $data_c1);
        View::share('data_c2', $data_c2);
        } catch (Exception $e) {

        }
    }
}
