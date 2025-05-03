<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Agent;
use App\Http\Controllers\Approvals;
use App\Http\Controllers\AssignUserRole;
use App\Http\Controllers\ChangeSuperAgent;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Fees;
use App\Http\Controllers\GeneralLedgers;
use App\Http\Controllers\KycDocs;
use App\Http\Controllers\KycLevels;
use App\Http\Controllers\Ledger;
use App\Http\Controllers\Loans;
use App\Http\Controllers\ManageUserLevel;
use App\Http\Controllers\Menus;
use App\Http\Controllers\Permissions;
use App\Http\Controllers\Processors;
use App\Http\Controllers\Providers;
use App\Http\Controllers\Roles;
use App\Http\Controllers\Services;
use App\Http\Controllers\Routing;
use App\Http\Controllers\Statistics;
use App\Http\Controllers\TerminalGroupTerminals;
use App\Http\Controllers\TerminalMenus;
use App\Http\Controllers\TerminalProcessors;
use App\Http\Controllers\Terminals;
use App\Http\Controllers\Transactions;
use App\Http\Controllers\UserKyc;
use App\Http\Controllers\Users;
use App\Http\Controllers\VfdWebhook;
use App\Http\Controllers\Wallets;
use App\Http\Controllers\TerminalGroups;
use App\Http\Controllers\WalletTransactions;
use App\Http\Controllers\VirtualAccountCredits;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppUpdatesController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\TerminalMonitoring;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('/', 'dashboard');
    Route::get('/dashboard',                 Dashboard::class)->name('dashboard');

    Route::get('statistics/{user?}',       Statistics::class)->name('statistics');

    Route::prefix('manage-users')->group(function () {
        Route::controller(Admin::class)->prefix('admins')->name('admins.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/register', 'create')->name('register');
        });

        Route::controller(Agent::class)->name('agents.')->group(function () {
            Route::get(str(Role::AGENT)->lower(), 'index')->name('index');
            Route::get('onboard', 'create')->name('onboard');
        });

        Route::controller(Agent::class)->name('super-agents.')->group(function () {
            Route::get(str(Role::SUPERAGENT)->lower(), 'index')->name('index');
        });
    });

    Route::controller(GeneralLedgers::class)->prefix('general-ledger')->name('general-ledger.')->group(function () {
        Route::get('/', 'show')->name('show');
        Route::get('/others', 'index')->name('others');
        Route::post('/{gl}/update', 'update')->name('update');
    });

    Route::get('/activities', [ActivityLogController::class, 'index'])->name('activities');

    Route::controller(AppUpdatesController::class)->prefix('app-update')->name('app-updates.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/create', 'create')->name('create');
    });

    Route::resource('users',                        Users::class)->only(['show', 'edit', 'update', 'store']);
    Route::resource('terminals',                    Terminals::class)->except(['destroy', 'edit', 'create']);
    Route::resource('users.kyc',                    UserKyc::class)->shallow()->only(['index', 'store']);
    Route::resource('users.manage-level',           ManageUserLevel::class)->only(['store']);
    Route::resource('kyc-docs',                     KycDocs::class)->shallow()->except(['edit', 'show']);
    Route::resource('transactions',                 Transactions::class)->only('index');
    Route::resource('kyc-levels',                   KycLevels::class)->only(['index', 'store', 'update']);
    Route::resource('ledger',                       Ledger::class)->only('index');
    Route::resource('approvals',                    Approvals::class)->only(['index', 'update', 'destroy']);
    Route::resource('roles',                        Roles::class)->except(['edit', 'destroy']);
    Route::resource('permissions',                  Permissions::class)->only(['index', 'store', 'update']);
    Route::resource('roles.users',                  AssignUserRole::class)->only(['store', 'destroy']);
    Route::resource('services',                     Services::class)->only(['index', 'update']);
    Route::resource('terminal-groups',              TerminalGroups::class);
    Route::resource('terminal-groups.terminals',    TerminalGroupTerminals::class)->only('index');
    Route::resource('providers',                    Providers::class)->only(['index', 'store', 'destroy']);
    Route::resource('menus',                        Menus::class)->only('index');
    Route::resource('terminals.menus',              TerminalMenus::class)->only(['index', 'store']);
    Route::resource('terminal-monitoring',          TerminalMonitoring::class)->only(['index', 'update', 'create', 'store']);
    Route::resource('wallets',                      Wallets::class)->only(['index', 'update']);
    Route::resource('wallet-transactions',          WalletTransactions::class)->only('index');
    Route::resource('processors',                   Processors::class)->only(['index', 'store', 'update']);
    Route::resource('terminal-processors',          TerminalProcessors::class)->only(['index', 'update', 'store']);
    Route::resource('routing',                      Routing::class)->only(['index', 'show']);
    Route::resource('loans',                        Loans::class)->only(['index', 'update']);
    Route::resource('virtual-account-credits',      VirtualAccountCredits::class)->only('index');
    Route::get('/terminal/{id}', [Terminals::class, 'show'])->name('termina.show');

    Route::post('change-super-agent/{user}',             ChangeSuperAgent::class)->name('change-super-agent');

    Route::get('kyc-documents', [KycDocs::class, 'display'])->name('display');
    Route::get('/services/json', [Services::class, 'jsonData'])->name('services.json');

    Route::resource('terminal-groups.fees', Fees::class)->only(['index', 'edit', 'update'])->shallow();
});


Route::post('vfd-impact-callback', VfdWebhook::class)->withoutMiddleware(VerifyCsrfToken::class);

require __DIR__ . '/auth.php';
