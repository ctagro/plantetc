<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'title' => 'Plant',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b>Plant</b>',
    'logo_img' => 'img/logo/logo_santa_luiza.jpg',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'menu' => [
        [
            'text' => 'search',
            'search' => true,
            'topnav' => true,
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        // can - verifica se a pessoa logada pode acessar 
        ],
        [
            'text'        => 'Home',
            'url'         => 'admin/home/index',
            'icon'        => 'fas fa-house-user',
         //   'label'       => 4,
         //   'label_color' => 'success',
        ],
        [
            'text'       => 'Meu Perfil',
            'icon_color' => 'yellow',
            'url'  => 'site/profile/profile',
            'icon' => 'fas fa-fw fa-user',
        ],
        
    /*    [
            'text'        => 'Galeria de fotos',
            'url'         => 'site/galeria/galeria',
            'icon'        => 'fas fa-house-user',
         //   'label'       => 4,
         //   'label_color' => 'success',
        ],
      */  
        ['header' => '=========================='],



            [
                'text'    => 'Financeiro',
                'icon'    => 'fas fa-fw fa-share',
                'submenu' => [


                [
                    'text'       => 'Registrar despesas',
                    'icon_color' => 'cyan',
                    'url'        => '/account',
                    'icon'        => 'fas fa-calendar-minus',

                ],

                [
                    'text'       => 'Registrar vendas',
                    'icon_color' => 'cyan',
                    'url'        => '/sale',
                    'icon'        => 'fas fa-calendar-minus',

                ],

                [
                    'text'       => 'Pesquisar Movimentações',
                    'icon_color' => 'green',
                    'url'  => '/account_research',
                    'icon'        => 'fas fa-money-bill-wave',
                ],

                [
                    'text'       => 'Pesquisar Vendas',
                    'icon_color' => 'cyan',
                    'url'        => '/sale_research',
                    'icon'        => 'fas fa-chart-line', 
                ],

                [
                    'text'       => 'Fluxo de caixa',
                    'icon_color' => 'cyan',
                    'url'        => '/cash_flow',
                    'icon'        => 'fas fa-chart-line', 
                ],

            ],
        ],


        ['header' => '=========================='],

        [
            'text'    => 'Atividades',
            'icon'    => 'fas fa-fw fa-share',
            'submenu' => [


            [
                'text'       => 'Registrar Atividades',
                'icon_color' => 'cyan',
                'url'        => '/activity',
                'icon'        => 'fas fa-calendar-plus', 

            ],

            [
                'text'       => 'Pesquisar Atividades',
                'icon_color' => 'green',
                'url'  => '/activity_research',
                'icon'        => 'fas fa-money-bill-wave',
            ],  
            
            
        ],
    ], 
    
    ['header' => '=========================='],

    [
        'text'       => 'Aplicação de Fertilizantes',
        'icon_color' => 'cyan',
        'url'        => '/product_apply',
        'icon'        => 'fas fa-calendar-plus', 

    ],

    [
        'text'       => 'Aplicação de Defensivos',
        'icon_color' => 'cyan',
        'url'        => '/pesticide_apply',
        'icon'        => 'fas fa-calendar-plus', 

    ],

    [
        'text'       => 'Pesquisar Aplicações',
        'icon_color' => 'green',
        'url'  => 'product_apply/product_apply_research',
        'icon'        => 'fas fa-money-bill-wave',
    ],  

    ['header' => '=========================='],

    [
        'text'       => 'Resultado por área',
        'icon_color' => 'cyan',
        'url'        => '/result_area',
        'icon'        => 'fas fa-calendar-plus', 

    ],


    ['header' => '=========================='],

       [
        
        'text'    => 'configurações',
        'icon'    => 'fas fa-fw fa-share',
        'submenu' => [
            [
                'text'       => 'Tipo de atividades',
                'icon_color' => 'green',
                'url'  => '/type_activity',
                'icon'        => 'fas fa-money-bill-wave',
            ],  

            [
                'text'       => 'Funcionários',
                'icon_color' => 'green',
                'url'  => '/worker',
                'icon'        => 'fas fa-money-bill-wave',
            ], 
            
            [
                'text'       => 'Áreas de Plantio',
                'icon_color' => 'green',
                'url'  => '/ground',
                'icon'        => 'fas fa-money-bill-wave',
            ],  

            [
                'text'       => 'Tipo de contas',
                'icon_color' => 'green',
                'url'  => '/accounting',
                'icon'        => 'fas fa-money-bill-wave',
            ],
            
            [
                'text'       => 'Culturas',
                'icon_color' => 'green',
                'url'  => '/crop',
                'icon'        => 'fas fa-money-bill-wave',
            ], 
            
            [
                'text'       => 'Fertilizantes',
                'icon_color' => 'green',
                'url'  => '/product',
                'icon'        => 'fas fa-money-bill-wave',
            ],

            [
                'text'       => 'Defensivos',
                'icon_color' => 'green',
                'url'        => '/pesticide',
                'icon'       => 'fas fa-money-bill-wave',
            ],

            [
                'text'       => 'Compradores',
                'icon_color' => 'green',
                'url'  => '/bayer',
                'icon'        => 'fas fa-money-bill-wave',
            ],
        ],
    ],  

        
    ],


    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
    */

    'livewire' => false,
];
