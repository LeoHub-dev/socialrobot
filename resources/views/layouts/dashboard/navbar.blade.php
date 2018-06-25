<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute bg-primary fixed-top">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button class="navbar-toggler" type="button">
                    <span class="navbar-toggler-bar bar1">
                    </span>
                    <span class="navbar-toggler-bar bar2">
                    </span>
                    <span class="navbar-toggler-bar bar3">
                    </span>
                </button>
            </div>
            <a class="navbar-brand" href="#pablo">
                Dashboard
            </a>
        </div>
        <button aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navigation" data-toggle="collapse" type="button">
            <span class="navbar-toggler-bar navbar-kebab">
            </span>
            <span class="navbar-toggler-bar navbar-kebab">
            </span>
            <span class="navbar-toggler-bar navbar-kebab">
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
                <div class="input-group no-border">
                    <input class="form-control" placeholder="Search..." type="text" value="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="now-ui-icons ui-1_zoom-bold">
                                </i>
                            </div>
                        </div>
                    </input>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#pablo">
                        <i class="now-ui-icons media-2_sound-wave">
                        </i>
                        <p>
                            <span class="d-lg-none d-md-block">
                                Stats
                            </span>
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="http://example.com" id="navbarDropdownMenuLink">
                        <i class="now-ui-icons location_world">
                        </i>
                        <p>
                            <span class="d-lg-none d-md-block">
                                Some Actions
                            </span>
                        </p>
                    </a>
                    <div aria-labelledby="navbarDropdownMenuLink" class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">
                            Action
                        </a>
                        <a class="dropdown-item" href="#">
                            Another action
                        </a>
                        <a class="dropdown-item" href="#">
                            Something else here
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" id="navbarDropdownUserLink">
                        <i class="now-ui-icons users_single-02">
                        </i>
                        <p>
                            <span class="d-lg-none d-md-block">
                                Account
                            </span>
                        </p>
                    </a>
                    <div aria-labelledby="navbarDropdownUserLink" class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#">
                            Another action
                        </a>
                        <a class="dropdown-item" href="#">
                            Something else here
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>