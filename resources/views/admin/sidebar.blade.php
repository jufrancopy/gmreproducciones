<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{url('/static/images/Logo_GMRE-03.png')}}" class="img-fluid">
        </div>
        <div class="user">
            <span class="subtitle">Hola,</span>
            <div class="name">
                {{Auth::user()->name}}{{Auth::user()->lastname}}
                <a href="{{ url('/logout') }}" data-toogle="tooltip" data-toggle="tooltip" data-placement="top"
                    title="Salir">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
            <div class="email">
                {{Auth::user()->email}}
            </div>
            <a href="/">Ver Sitio</a>
        </div>
    </div>

    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permissions, 'dashboard'))
            <li>
                <a href="{{url('/admin')}}" class="lk-dashboard">
                    <i class="fas fa-tachometer-alt"> </i>Dashboard
                </a>
            </li>
            @endif
            
            @if(kvfj(Auth::user()->permissions, 'products'))
            <li>
                <a href="{{url('/admin/products/1')}}" 
                class="lk-products lk-product_add lk_product_search 
                    lk-product_edit lk-product_gallery_add lk-product_inventory">
                    <i class="fas fa-boxes"> </i>Productos
                </a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'categories'))
            <li>
                <a href="{{url('/admin/categories/0')}}" class="lk-categories lk-category_add lk-category_edit lk-category_delete">
                    <i class="far fa-folder-open"></i>Categorias
                </a>
            </li>
            @endif
            
            
            @if(kvfj(Auth::user()->permissions, 'user_list'))
            <li>
                <a href="{{url('/admin/users/all')}}" class="lk-user_list lk_usr_edit lk-user_permissions">
                    <i class="fas fa-user-friends"> </i>Usuarios
                </a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'ordersx_list'))
            <li>
                <a href="{{url('/admin/orders/all')}}" class="lk-user">
                    <i class="fas fa-clipboard-list"></i>Órdenes
                </a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'coverage_list'))
            <li>
                <a href="{{url('/admin/coverage')}}" class="lk-coverage_list lk-coverage_edit">
                    <i class="fas fa-shipping-fast" aria-hidden="true"></i>Envíos
                </a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'sliders_list'))
            <li>
                <a href="{{url('/admin/sliders')}}" class="lk-sliders_list lk-slider_edit">
                    <i class="fas fa-images" aria-hidden="true"></i>Sliders
                </a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permissions, 'settings'))
            <li>
                <a href="{{url('/admin/settings')}}" class="lk-settings">
                    <i class="fa fa-cogs" aria-hidden="true"></i>Configuraciones
                </a>
            </li>
            @endif

            <li>
                <a href="{{route('timeline-profiles.index')}}" class="lk-user_list lk_usr_edit">
                    <i class="fas fa-user-friends"> </i>Timeline
                </a>
            </li>
        </ul>
    </div>
</div>