<div class="sidebar" data-color="orange">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a class="simple-text logo-mini" href="http://www.creative-tim.com">
            CT
        </a>
        <a class="simple-text logo-normal" href="http://www.creative-tim.com">
            Creative Tim
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
                            <a href="#">
                                <span class="sidebar-mini-icon">
                                    MP
                                </span>
                                <span class="sidebar-normal">
                                    My Profile
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="sidebar-mini-icon">
                                    EP
                                </span>
                                <span class="sidebar-normal">
                                    Edit Profile
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
            <li class="active">
                <a href="../examples/dashboard.html">
                    <i class="now-ui-icons design_app">
                    </i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li>
                <a href="../examples/widgets.html">
                    <i class="now-ui-icons objects_diamond">
                    </i>
                    <p>
                        Widgets
                    </p>
                </a>
            </li>
        </ul>
    </div>
</div>