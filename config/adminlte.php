<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Course Grade Management System',

    'title_prefix' => 'CGMS',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => 'CGMS <b>Admin</b>',

    'logo_mini' => '<b>CG</b>MS',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,


    /**
     * General cache time
     */
    'cache_time' => 20,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'lms.menu.main_nav',
        [
            'text'          => 'lms.menu.teachers.title',
            'icon'          => 'users',
            'can'           => 'admin-only',
            'submenu'       => [
                [
                    'text'      => 'lms.menu.teachers.all',
                    'url'       => 'admin/teachers',
                    'icon'      => 'users',
                    'can'       => 'admin-only',

                ],
                [
                    'text'      => 'lms.menu.teachers.portfolio',
                    'url'           => 'admin/portfolio?search_param=all&registration=3',
                    'can'           => 'admin-only',
                    'icon'          => 'folder-open'
                ],
                [
                    'text'      => 'lms.menu.teachers.registration_inspection',
                    'url'           => 'admin/registration/pending?search_param=all&registration=3',
                    'can'           => 'admin-only',
                    'icon'          => 'check-square'
                ],
            ]
        ],
        [
            'text'          => 'lms.menu.course.title',
            'icon'          => 'book',
            'can'           => 'admin-only',
            'submenu'       => [
                [
                    'text'      => 'Master Course',
                    'url'           => 'admin/master-course',
                    'can'           => 'admin-only',
                ],
                [
                    'text'      => 'Category',
                    'can'           => 'admin-only',
                    'submenu'   => [
                        [
                            'text'  => 'Type',
                            'url'   => 'admin/categories/type',
                        ],
                        [
                            'text'  => 'Label',
                            'url'   => 'admin/categories/label',
                        ],
                        [
                            'text'  => 'Sub Label',
                            'url'   => 'admin/categories/sublabel',
                        ],
                        [
                            'text'  => 'Area of Knowledge',
                            'url'   => 'admin/categories/knowledge',
                        ],
                        [
                            'text'  => 'Subject',
                            'url'   => 'admin/categories/subject',
                        ]

                    ]
                ],
                [
                    'text'      => 'lms.menu.course.all',
                    'url'           => 'admin/course',
                    'can'           => 'admin-only',
                ],

//                [
//                    'text'      => 'Course Modality',
//                    'url'           => 'admin/course-modality',
//                    'can'           => 'admin-only',
//                ],
            ],

        ],
        [
            'text'          => 'lms.menu.user.my_portfolio',
            'icon'          => 'folder-open',
            'url'           => 'admin/portfolio', // my/portfolio
            'can'           => 'teacher-only'
        ],
        [
            'text'          => 'lms.menu.user.my_requests',
            'icon'          => 'list-ol',
            'url'           => 'admin/upcoming-courses',
            'can'           => 'teacher-only'
        ],
        [
            'text'          => 'lms.menu.university',
            'url'           => 'admin/university',
            'icon'          => 'building',
            'can'           => 'admin-only',
        ],
        [
            'text'          => 'lms.menu.course.title',
            'icon'          => 'book',
            'url'           => 'admin/course',
            'can'           => 'university-only'
        ],
        [
            'text'  => 'lms.menu.settings.user_management',
            'icon'  => 'user-secret',
            'url'   => 'admin/users',
            'can'       => 'admin-only',
        ],
        [
            'text'    => 'lms.menu.settings.location.title',
            'icon'      => 'map',
            'can'           => 'admin-only',
            'url'     => '#',
            'submenu' => [
                [
                    'text' => 'lms.menu.settings.location.province',
                    'url'  => '/admin/location/province',
                ],
                [
                    'text'    => 'lms.menu.settings.location.canton',
                    'url'     => '/admin/location/canton',
                ],
                [
                    'text'    => 'lms.menu.settings.location.parroquia',
                    'url'     => '/admin/location/parroquia',
                ],
            ],
        ],
        'lms.menu.account_settings',
        [
            'text' => 'lms.menu.profile',
            'url'  => '/admin/profile',
            'icon' => 'user',
        ],
        [
            'text' => 'Change Password',
            'url'  => '/admin/profile/change-password', //admin/settings
            'icon' => 'lock',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
