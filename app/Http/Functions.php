<?php

use Illuminate\Support\Facades\Config;

// Key Value Form Json
function kvfj($json, $key)
{
    if ($json == null) :
        return null;
    else :
        $json = $json;
        $json = json_decode($json, true);
        if (array_key_exists($key, $json)) :
            return $json[$key];
        else :
            return null;
        endif;
    endif;
}

function getModulesArray()
{
    $a = [
        '0' => 'Eventos',
        // '1' =>  'Web',
    ];
    return $a;
}

function getUrlFileFromUploads($file, $size = null)
{
    if (!is_null($file)) :
        $file = json_decode($file, true);
        if ($size) :
            return url('/uploads/' . $file['path'] . '/' . $size . '_' . $file['finalName']);
        else :
            return url('/uploads/' . $file['path'] . '/' . $file['finalName']);
        endif;
    endif;
}

function getRoleUserArray($mode, $id)
{
    $roles = [
        '0' => 'Usuario',
        '1' => 'Administrador'
    ];

    if (!is_null($mode)) :

        return $roles;
    else :
        return $roles[$id];
    endif;
}

function getUsersStatusArray($mode, $id)
{
    $status = [
        '0' => 'Registrado',
        '1' => 'Verificado',
        '100' => 'Baneado'
    ];

    if (!is_null($mode)) :

        return $status;
    else :
        return $status[$id];
    endif;
}

function user_permissions()
{
    $permission = [
        'dashboard' => [
            'icon'  => '<i class="fas fa-home"></i>',
            'title' => 'Modulo Dashboard',
            'keys'  => [
                'dashboard' => _sl('settings.dashboard.dashboard'),
                'dashboard_small_stats' => _sl('settings.dashboard.dashboard_small_stats'),
                'dashboard_sell_today' => _sl('settings.dashboard.dashboard_sell_today'),
            ]
        ],

        'products' => [
            'icon'  => '<i class="fas fa-boxes"></i>',
            'title' => 'Modulo Productos',
            'keys'  => [
                'products' => _sl('settings.products.products'),
                'product_add'  => _sl('settings.products.product_add'),
                'product_edit'  => _sl('settings.products.product_edit'),
                'product_search'  => _sl('settings.products.product_search'),
                'product_delete'  => _sl('settings.products.product_delete'),
                'product_gallery_add'  => _sl('settings.products.product_gallery_add'),
                'product_gallery_delete'  => _sl('settings.products.product_gallery_delete'),
                'product_inventory'  => _sl('settings.products.product_inventory'),
            ]
        ],

        'categories' => [
            'icon'  => '<i class="far fa-folder-open"></i>',
            'title' => 'Modulo Categorias',
            'keys'  => [
                'categories' => _sl('settings.categories.categories'),
                'category_add' => _sl('settings.categories.category_add'),
                'category_edit' => _sl('settings.categories.category_edit'),
                'category_delete' => _sl('settings.categories.category_delete'),
            ]
        ],
        'users' => [
            'icon'  => '<i class="fas fa-user-friends"></i>',
            'title' => 'Modulo Dashboard',
            'keys'  => [
                'user_list' => _sl('settings.users.user_list'),
                'user_view' => _sl('settings.users.user_view'),
                'user_edit' => _sl('settings.users.user_edit'),
                'user_banned' => _sl('settings.users.user_banned'),
                'user_permissions' => _sl('settings.users.user_permissions'),
            ]
        ],

        'settings' => [
            'icon'  => '<i class="fa fa-cogs" aria-hidden="true"></i>',
            'title' => 'Modulo de Configuraciones',
            'keys'  => [
                'settings' => _sl('settings.settings.settings'),
            ]
        ],

        'sliders' => [
            'icon'  => '<i class="fas fa-images" aria-hidden="true"></i>',
            'title' => 'Sliders',
            'keys'  => [
                'sliders_list'  => _sl('settings.sliders.sliders_list'),
                'slider_add'    => _sl('settings.sliders.slider_add'),
                'slider_edit'   => _sl('settings.sliders.slider_edit'),
                'slider_delete' => _sl('settings.sliders.slider_delete'),
            ]
        ],

        'orders' => [
            'icon'  => '<i class="fas fa-clipboard-list"></i>',
            'title' => 'Modulo de Órdenes',
            'keys'  => [
                'orders_list' => _sl('settings.orders.orders_list'),
                'order_view' => _sl('settings.orders.order_view'),
                'order_change_status' => _sl('settings.orders.order_change_status'),
            ]
        ],
        'coverage' => [
            'icon'  => '<i class="fas fa-shipping-fast"></i>',
            'title' => 'Cobertura de Envíos',
            'keys'  => [
                'coverage_list' => _sl('settings.coverage.coverage_list'),
                'coverage_add' => _sl('settings.coverage.coverage_add'),
                'coverage_edit' => _sl('settings.coverage.coverage_edit'),
                'coverage_delete' => _sl('settings.coverage.coverage_delete'),
            ]
        ]
    ];

    return $permission;
}

function getUserYears()
{
    $currentYear = date('Y');
    $minimumAge = $currentYear - 18;
    $maximumAge = $minimumAge - 62;

    return [$minimumAge, $maximumAge];
}

function getMonths($mode, $key)
{
    $month = [
        '01'  => _sl('g.month.january'),
        '02'  => _sl('g.month.february'),
        '03'  => _sl('g.month.march'),
        '04'  => _sl('g.month.april'),
        '05'  => _sl('g.month.may'),
        '06'  => _sl('g.month.june'),
        '07'  => _sl('g.month.july'),
        '08'  => _sl('g.month.august'),
        '09'  => _sl('g.month.september'),
        '10' => _sl('g.month.october'),
        '11' => _sl('g.month.november'),
        '12' => _sl('g.month.december')
    ];

    if ($mode == 'list') {
        return $month;
    } else {
        return $month[$key];
    }
}

function getShippingMethod($method = null)
{
    $status = [
        '0' => _sl('settings.status.free_shipping'),
        '1' => _sl('settings.status.fixed_price'),
        '2' => _sl('settings.status.variable_price_by_location'),
        '3' => _sl('settings.status.free_shipping_minimum_amount')
    ];

    if (is_null($method)) :
        return $status;
    else :
        return $status[$method];
    endif;
}

function getCoverageType($type = null)
{
    $status = [
        '0' => 'Departamento',
        '1' => 'Ciudad',
        '2' => 'Barrio',
    ];

    if (is_null($type)) :
        return $status;
    else :
        return $status[$type];
    endif;
}

function getCoverageStatus($status = null)
{
    $list = [
        '0' => _sl('settings.orders.getCoverageStatus.inactive'),
        '1' => _sl('settings.orders.getCoverageStatus.active')
    ];

    if (is_null($status)) :
        return $list;
    else :
        return $list[$status];
    endif;
}

function getEnableOrNotEnable($status = null)
{
    $list = [
        '0' => _sl('settings.orders.getEnableOrNotEnable.inactive'),
        '1' => _sl('settings.orders.getEnableOrNotEnable.active')
    ];

    if (is_null($status)) :
        return $list;
    else :
        return $list[$status];
    endif;
}

function getPaymentsMethods($method = null)
{
    $list = [
        '0' => _sl('settings.list_method_payment.cash'),
        '1' => _sl('settings.list_method_payment.bank_transfer'),
        '2' => _sl('settings.list_method_payment.paypal'),
        '3' => _sl('settings.list_method_payment.credit_card')
    ];


    // Si $method es nulo o no está definido, devuelve una cadena vacía
    if (is_null($method) || !array_key_exists($method, $list)) {
        return '';
    } else {
        return $list[$method];
    }
}

function getOrderStatus($status = null)
{
    $list = [
        '0' => _sl('settings.list.in_process'),
        '1' => _sl('settings.list.pending_payment_confirmation'),
        '2' => _sl('settings.list.payment_received'),
        '3' => _sl('settings.list.processing_order'),
        '4' => _sl('settings.list.order_shipped'),
        '5' => _sl('settings.list.ready_for_pickup'),
        '6' => _sl('settings.list.order_delivered'),
        '100' => _sl('settings.list.order_rejected')
    ];

    if (is_null($status)) :
        return $list;
    else :
        return $list[$status];
    endif;
}

function getOrderType($status = null)
{
    $list = [
        '0' => _sl('settings.order_type.home_delivery'),
        '1' => _sl('settings.order_type.to_go')
    ];

    if (is_null($status)) :
        return $list;
    else :
        return $list[$status];
    endif;
}

function number($number)
{
    return number_format($number, 2, '.', ',') . '' . Config::get('configSite.currency');
}


function getTemplatesOfPlatform($template = null)
{
    $list = [
        'default' => 'Default',
        'moderno' => 'Moderno'
    ];

    if (is_null($template)) :
        return $list;
    else :
        return $list[$template];
    endif;
}

function _sl($key)
{
    return __('template_' . config('configSite.template') . '.' . $key);
}

function getAvailableLanguajes()
{
    $languajes =  ['en' => _sl('g.lang_en'), 'es' => _sl('g.lang_es')];

    return $languajes;
}
