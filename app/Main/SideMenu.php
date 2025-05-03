<?php

namespace App\Main;

use App\Models\Role;
use App\Models\User;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @return array
     */
    public static function menu(): array
    {
        return [
            'dashboard' => [
                'icon' => 'ui-home',
                'route_name' => 'dashboard',
                'title' => 'Dashboard'
            ],

            'stats' => [
                'icon' => 'chart-bar-graph',
                'route_name' => 'statistics',
                'title' => 'Statistics'
            ],

            'terminals' => [
                'icon' => 'android-tablet',
                'title' => 'Terminals',
                'sub_menu' => [
                    'group' => [
                        'route_name' => 'terminal-groups.index',
                        'title' => 'Profiles',
                        'permission' => 'read groups'
                    ],

                    'list' => [
                        'route_name' => 'terminals.index',
                        'title' => 'List',
                        'permission' => 'read terminals'
                    ],

                    'terminal-processor' => [
                        'route_name' => 'terminal-processors.index',
                        'title' => 'Processors',
                        'permission' => 'read terminal-processors'
                    ],

                    'menus' => [
                        'route_name' => 'menus.index',
                        'title' => 'Menus',
                        'permission' => 'read menus'
                    ],

                    'terminal-monitoring' => [
                        'route_name' => 'terminal-monitoring.index',
                        'title' => 'Terminal Monitoring',
                        'permission' => 'read menus'
                    ]
                ]
            ],

            'wallets' => [
                'icon' => 'credit-card',
                'title' => 'Wallets',
                'sub_menu' => [
                    'index' => [
                        'route_name' => 'wallets.index',
                        'title' => 'List'
                    ],

                    'transactions' => [
                        'route_name' => 'wallet-transactions.index',
                        'title' => 'Transactions'
                    ],
                ],
                'permission' => 'read wallets'
            ],

            'Transactions' => [
                'icon' => 'chart-line-alt',
                'route_name' => 'transactions.index',
                'title' => 'Transactions',
                'permission' => 'read transactions'
            ],

            /*'loans' => [
                'icon' => 'share-2',
                'route_name' => 'loans.index',
                'title' => 'Loans',
                'permission' => 'read loans'
            ],*/

            'general-ledger' => [
                'icon' => 'chart-flow',
                'title' => 'General Ledger',
                'route_name' => 'general-ledger.show',
                'permission' => 'read general ledger'
            ],

            'ledger' => [
                'icon' => 'chart-radar-graph',
                'title' => 'Ledger',
                'route_name' => 'ledger.index',
                'permission' => 'read ledger'
            ],

            'users' => [
                'icon' => 'users',
                'title' => 'User Management',
                'sub_menu' => [
                    'staff' => [
                        'route_name' => 'admins.index',
                        'title' => User::GROUPS[0],
                        'permission' => 'read admin'
                    ],

                    'super-agent' => [
                        'route_name' => 'super-agents.index',
                        'title' => str(Role::SUPERAGENT)->lower()->ucfirst(),
                        'permission' => 'read admin'
                    ],

                    'agents' => [
                        'route_name' => 'agents.index',
                        'title' => str(Role::AGENT)->lower()->ucfirst(),
                        'permission' => 'read customers'
                    ],
                ]
            ],

            'kyc-details' => [
                'icon' => 'document-folder',
                'title' => 'KYC Management',
                'sub_menu' => [
                    'kyc-level' => [
                        'route_name' => 'kyc-levels.index',
                        'title' => 'KYC Level',
                        'permission' => 'read kyc-level'
                    ],

                    'kyc-docs' => [
                        'route_name' => 'kyc-docs.index',
                        'title' => 'KYC Documents',
                        'permission' => ['read customers', 'read kyc-level']
                    ],
                ],
            ],

            'access-control' => [
                'icon' => 'company',
                'title' => 'Access Control',
                'route_active' => 'roles.index, roles.create',
                'sub_menu' => [
                    'index' => [
                        'route_name' => 'roles.index',
                        'title' => 'Roles'
                    ],

                    'transactions' => [
                        'route_name' => 'permissions.index',
                        'title' => 'Permissions'
                    ],
                ],
                'permission' => 'read roles'
            ],

            'settings' => [
                'icon' => 'ui-settings',
                'title' => 'Settings',
                'sub_menu' => [
                    'services' => [
                        'route_name' => 'services.index',
                        'title' => 'Services and Providers'
                    ],
                    'processor' => [
                        'route_name' => 'processors.index',
                        'title' => 'Processors',
                        'permission' => 'read terminal-processors'
                    ],
                    'routing' => [
                        'icon' => 'send',
                        'route_name' => 'routing.index',
                        'title' => 'Routing',
                    ],

                    //                    'settlement' => [
                    ////                        'route_name' => 'manage-users.agents',
                    //                        'title' => 'Settlements'
                    //                    ],
                ],
                'permission' => 'read settings'
            ],

            'approvals' => [
                'icon' => 'tasks-alt',
                'route_name' => 'approvals.index',
                'title' => 'Approvals',
                'permission' => 'approve actions'
            ],

            'app-management' => [
                'title' => 'App Management',
                'icon' => 'brand-android-robot',
                //                'sub_menu' => [
                //                    'app' => [
                //                        'title' => 'App Updates',
                //                        'route_name' => 'app-updates.index',
                //                    ]
                //                ],
                'route_name' => 'app-updates.index',
                'permission' => 'read settings',
            ],

            'activities' => [
                'icon' => 'ui-calendar',
                'route_name' => 'activities',
                'title' => 'Audit Trail',
                'permission' => 'read admin'
            ],

        ];
    }
}
