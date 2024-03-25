<div class="main_sidebar" id="main_sidebar">
    <div class="sidebar" id="sidebar">
        @if (Auth::guest())
            <div class="inside">
                <div class="connect">
                    <a href="{{ url('/login') }}" class="btn">Ingresar</a>
                    <a href="{{ url('/register') }}" class="btn btn-blue">Ingresar</a>
                </div>
            </div>
        @else
            <div class="user-profile">
                <div class="inside">
                    <div class="info">
                        @if (is_null(Auth::user()->avatar))
                            <div class="avatar">
                                <img src="{{ url('/static/templates/default/images/avatar_default.png') }}">
                            </div>
                        @else
                            <div class="avatar">
                                <img src="{{ getUrlFileFromUploads(Auth::user()->avatar, '64x64') }}">
                            </div>
                        @endif
                        <div class="user-info">
                            <span>Hola: {{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                            <span>Correo: {{ Auth::user()->email }}</span>
                        </div>
                    </div>

                </div>
                <div class="options">
                    <ul>
                        <li>
                            <a href="{{ url('/account/history/orders') }}">
                                <i class="bi bi-clock-history" aria-hidden="true"></i>
                                <span>Historial de Compras</span>
                            </a>
                        </li>
                        <li>
                            <a ref="{{ url('/account/address') }}">
                                <i class="bi bi-geo-alt" aria-hidden="true"></i>
                                <span>Direcciones de Entregas</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/account/edit') }}">
                                <i class="bi bi-gear" aria-hidden="true"></i>
                                <span>Detalles</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}">
                                <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
                                <span>Salir</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        <ul>
            <li><a href="{{ url('/') }}"><i class="bi bi-house"></i> Inicio</a></li>
            <li><a href="{{ url('/') }}"><i class="bi bi-person-badge"></i> Nosotros</a></li>
            <li><a href="{{ url('/') }}"><i class="bi bi-tags"></i> Ofertas</a></li>
            <li><a href="{{ url('/') }}"><i class="bi bi-newspaper"></i> Blog</a></li>
            <li><a href="{{ url('/') }}"><i class="bi bi-envelope-open"></i> Contactos</a></li>
        </ul>
    </div>
</div>
