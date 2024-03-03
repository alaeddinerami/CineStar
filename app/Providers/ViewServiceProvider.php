<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\NavigationComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // , 'welcome', 'films.index', 'films.search', 'films.show', 'profile.edit', 'reservations.index', 'reservations.create', 'reservations.show'
        View::composer(['layouts.app'],  function ($view) {

            $notifications = Notification::where('user_id', Auth::id())->get();
            // dd($notifications);
            $view->with('notifications', $notifications);
        });
    }
}
