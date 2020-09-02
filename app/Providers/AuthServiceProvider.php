<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 開発者
       Gate::define('admin', function ($user) {
         return ($user->role == 1024);
       });
       // 全コンテンツを視聴できるユーザー
       Gate::define('all-contents', function ($user) {
         return ($user->role == 10);
       });
       // 本当録が終わっていて、口コミ登録をしていないユーザー
       Gate::define('register', function ($user) {
         return ($user->role == 5);
       });
        // 仮登録段階のユーザー
        Gate::define('pre-register', function ($user) {
          return ($user->role == 3);
        });

    }
}
