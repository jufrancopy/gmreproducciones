<?php

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
                'dashboard' => 'Puede ver el Dashboard',
                'dashboard_small_stats' => 'Puede ver las Estadíticas rápidas',
                'dashboard_sell_today' => 'Puede ver facturaciones del día',
            ]
        ],

        'products' => [
            'icon'  => '<i class="fas fa-boxes"></i>',
            'title' => 'Modulo Productos',
            'keys'  => [
                'products' => 'Puede listar productos',
                'product_add'  => 'Puede agregar productos',
                'product_edit'  => 'Puede editar productos',
                'product_search'  => 'Puede buscar productos',
                'product_delete'  => 'Puede eliminar producto',
                'product_gallery_add'  => 'Puede agregar imagenes a la Galería',
                'product_gallery_delete'  => 'Puede eliminar imagenes de la Galería',
                'product_inventory'  => 'Puede administrar el inventario de un producto',
            ]
        ],

        'categories' => [
            'icon'  => '<i class="far fa-folder-open"></i>',
            'title' => 'Modulo Categorias',
            'keys'  => [
                'categories' => 'Puede ver las Categorías',
                'category_add' => 'Puede agregar Categorías',
                'category_edit' => 'Puede editar Categorías',
                'category_delete' => 'Puede borrar Categorías',
            ]
        ],
        'users' => [
            'icon'  => '<i class="fas fa-user-friends"></i>',
            'title' => 'Modulo Dashboard',
            'keys'  => [
                'user_list' => 'Puede listar usuarios',
                'user_edit' => 'Puede editar usuarios',
                'user_banned' => 'Puede bannear usuarios',
                'user_permissions' => 'Puede administrar permisos a usuarios',
            ]
        ],

        'settings' => [
            'icon'  => '<i class="fa fa-cogs" aria-hidden="true"></i>',
            'title' => 'Modulo de Configuraciones',
            'keys'  => [
                'settings' => 'Puede modificar las Configuraciones',
            ]
        ],

        'sliders' => [
            'icon'  => '<i class="fas fa-images" aria-hidden="true"></i>',
            'title' => 'Sliders',
            'keys'  => [
                'sliders_list'  => 'Puede listar Sliders',
                'slider_add'    => 'Puede agregar Sliders',
                'slider_edit'   => 'Puede editar Sliders',
                'slider_delete' => 'Puede eliminar Sliders',
            ]
        ],

        'orders' => [
            'icon'  => '<i class="fas fa-clipboard-list"></i>',
            'title' => 'Modulo de Órdenes',
            'keys'  => [
                'orders_list' => 'Puede ver el listado de órdenes',
            ]
        ],
        'coverage' => [
            'icon'  => '<i class="fas fa-shipping-fast"></i>',
            'title' => 'Cobertura de Envíos',
            'keys'  => [
                'coverage_list' => 'Puede ver el listado envíos',
                'coverage_add' => 'Puede agregar cobertura de envío',
                'coverage_edit' => 'Puede editar cobertura de envío',
                'coverage_delete' => 'Puede borrar cobertura de envío',
            ]
        ]
    ];

    return $permission;
}

function getUserYears(){
    $currentYear = date('Y');
    $minimumAge = $currentYear - 18;
    $maximumAge = $minimumAge - 62;

    return [$minimumAge, $maximumAge];
}

function getMonths($mode, $key){
    $month = [
         '01'  => 'Enero',
         '02'  => 'Febrero',
         '03'  => 'Marzo',
         '04'  => 'Abril',
         '05'  => 'Mayo',
         '06'  => 'Junio',
         '07'  => 'Julio',
         '08'  => 'Agosto',
         '09'  => 'Setiembre',
         '10' => 'Octubre',
         '11' => 'Noviembre',
         '12' => 'Diciembre'
    ];
    if($mode == 'list'){
        return $month;
    }else{
        return $month[$key];
    }
}

function getShippingMethod($method = null)
{
    $status = [
        '0' => 'Envío gratuito',
        '1' => 'Precio Fijo',
        '2' => 'Precio Variable por Ubicación',
        '3' => 'Envío Gratuito / Monto Mínimo'
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

function getCoverageStatus($status = null){
    $list = [
        '0' => 'Inactivo',
        '1' => 'Activo'
    ];

    if (is_null($status)) :
        return $list;
    else :
        return $list[$status];
    endif;
}
