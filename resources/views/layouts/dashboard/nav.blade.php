<div class="sidebar" data-color="orange">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a class="simple-text logo-mini" href="#">
            SB
        </a>
        <a class="simple-text logo-normal" href="#">
            Social Bot
        </a>
        <div class="navbar-minimize">
            <button class="btn btn-simple btn-icon btn-neutral btn-round" id="minimizeSidebar">
                <i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>
                <i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ asset('uidash/img/'.Auth::user()->profile_img) }}"/>
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        James Amos
                        <b class="caret">
                        </b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('profile') }}">
                                <span class="sidebar-mini-icon">
                                    MP
                                </span>
                                <span class="sidebar-normal">
                                    Perfil
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">
                                    EP
                                </span>
                                <span class="sidebar-normal">
                                    Editar Perfil
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="sidebar-mini-icon">
                                    S
                                </span>
                                <span class="sidebar-normal">
                                    Settings
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="{{ setActive('app/dashboard') }}">
                <a href="{{ route('dashboard') }}">
                    <i class="now-ui-icons design_app">
                    </i>
                    <p>
                        Inicio
                    </p>
                </a>
            </li>
            <li class="{{ setActive('app/follows') }}">
                <a href="{{ route('follows.index') }}">
                    <i class="now-ui-icons ui-2_favourite-28">
                    </i>
                    <p>
                        Siguiendo
                    </p>
                </a>
            </li>
            <li class="{{ setActive('app/orders') }}">
                <a href="{{ route('orders.index') }}">
                    <i class="now-ui-icons shopping_cart-simple">
                    </i>
                    <p>
                        Ordenes
                    </p>
                </a>
            </li>
        </ul>
    </div>
</div>