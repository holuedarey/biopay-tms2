<?php

namespace App\Providers;

use App\Contracts\VirtualAccountInterface;
use App\Driver\Mail\TeqMailTransport;
use App\Models\KycLevel;
use App\Models\Service;
use App\Models\Terminal;
use App\Models\TerminalGroup;
use App\Models\User;
use App\Observers\ApprovalObserver;
use App\Observers\KycLevelObserver;
use App\Observers\TerminalGroupObserver;
use App\Observers\TerminalObserver;
use App\Observers\UserObserver;
use App\Repository\Vfd;
use Cjmellor\Approval\Models\Approval;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VirtualAccountInterface::class, Vfd::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCacheableModels();

        $this->bootObservers();
        $this->bootBladeDirectives();
        $this->bootTeqmailDriver();
        $this->bootCarbonMacros();
        $this->bootLogViewerPermission();
    }


    private function bootBladeDirectives(): void
    {
        Blade::directive('money', fn($value) => "<?php echo moneyFormat($value) ?>" );
        Blade::directive('appName', fn($value) => "<?php echo config('app.name') ?>" );
        Blade::directive('nbsp', fn($value) => "<?php echo str_replace(' ', '&nbsp;', $value) ?>" );
    }

    private function bootObservers(): void
    {
        User::observe(UserObserver::class);
        Approval::observe(ApprovalObserver::class);
        KycLevel::observe(KycLevelObserver::class);
        TerminalGroup::observe(TerminalGroupObserver::class);
        Terminal::observe(TerminalObserver::class);
    }

    private function registerCacheableModels(): void
    {
        $this->app->bind('services',
            fn() => Cache::rememberForever('services', fn() => Service::all())
        );

        $this->app->bind('levels',
            fn() => Cache::rememberForever('kyc-levels', fn() => KycLevel::orderBy('max_balance')->get())
        );

        $this->app->bind('menus',
            fn() => Cache::rememberForever('menus', fn() => Service::whereMenu(true)->get())
        );

        $this->app->bind('terminal_groups',
            fn() => Cache::rememberForever('terminal_groups', fn() => TerminalGroup::all())
        );
    }

    private function bootTeqmailDriver(): void
    {
        Mail::extend('teqmail', function () {
            return new TeqMailTransport;
        });
    }

    private function bootCarbonMacros(): void
    {
        Carbon::macro('greet', function () {
            $hour = now()->format('H');

            if ($hour < 12) return 'Morning';

            if ($hour < 17) return 'Afternoon';

            return 'Evening';
        });
    }

    public function bootLogViewerPermission(): void
    {
        LogViewer::auth(function ($request) {
            return true;
        });
    }
}
