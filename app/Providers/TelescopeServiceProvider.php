<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();
<<<<<<< HEAD
	Telescope::tag(function (IncomingEntry $entry) {
=======

        Telescope::tag(function (IncomingEntry $entry) {
>>>>>>> ffa65d6a977d1a3fe332e0d00cf118d6963503db
            return $entry->type === 'request'
                ? ['status:'.$entry->content['response_status'], 'path:'.$entry->content['uri']]
                : [];
        });
<<<<<<< HEAD
=======

>>>>>>> ffa65d6a977d1a3fe332e0d00cf118d6963503db
        $isLocal = $this->app->environment('local');

        Telescope::filter(function (IncomingEntry $entry) use ($isLocal) {
            return $isLocal ||
                   $entry->isReportableException() ||
                   $entry->isFailedRequest() ||
                   $entry->isFailedJob() ||
                   $entry->isScheduledTask() ||
                   $entry->hasMonitoredTag();
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment('local')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function ($user) {
            return in_array($user->email, [
<<<<<<< HEAD
                'info@getstack.africa',
                'holudare2076@gmail.com'
=======
                'holudare2076@gmail.com',
                'info@getstack.africa',
>>>>>>> ffa65d6a977d1a3fe332e0d00cf118d6963503db
            ]);
        });
    }
}
