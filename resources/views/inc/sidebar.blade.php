@if ($page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'students_inscription')

    <div class="topbar-nav header navbar" role="banner">
        <nav id="topbar">
            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="/">
                        <img src="{{asset('assets/img/logo/logo_110x110.png')}}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="/" class="nav-link"> {{ config('app.name') }} </a>
                </li>
            </ul>
            <ul class="list-unstyled menu-categories" id="topAccordion">
                        <li class="menu single-menu  {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                            <a href="/admin-dashboard" aria-expanded="true" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                                    <span>Tableau de bord</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu single-menu  {{ ($category_name === 'formations') ? 'active' : '' }}">
                            <a href="/admin-formations" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                    <span>Formations</span>
                                </div>
                            </a>
                        </li>

                        <li class="menu single-menu  {{ ($category_name === 'transactions') ? 'active' : '' }}">
                            <a href="/admin-transactions" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                    <span>Transactions</span>
                                </div>
                            </a>
                        </li>
            </ul>
        </nav>
    </div>
        
@endif