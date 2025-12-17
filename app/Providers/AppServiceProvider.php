<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Claim;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.navbar', function ($view) {
            if (Auth::check()) {
                // Ambil semua ID item milik user yang login
                $userItems = Item::where('user_id', Auth::id())->pluck('id')->toArray();

                // Ambil klaim yang status verified = 0 (pending) atau 2 (rejected)
                $pendingClaims = Claim::whereIn('item_id', $userItems)
                    ->whereIn('verified', [0, 2])
                    ->with(['item', 'user'])
                    ->get();

                // Ambil notifikasi belum dibaca
                $notifications = Auth::user()->unreadNotifications()->latest()->get();

                $view->with([
                    'pendingClaims' => $pendingClaims,
                    'notifications' => $notifications,
                ]);
            } else {
                $view->with([
                    'pendingClaims' => collect(),
                    'notifications' => collect(),
                ]);
            }
        });
    }


}
