@if ($page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503')

    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <div class="nav-logo align-self-center">
                <a class="navbar-brand">
                    <img alt="logo" src="{{asset('assets/img/logo/logo_110x110.png')}}" class="navbar-brand-logo"> 
                    <span class="navbar-brand-name d-none d-lg-inline" id="brandName" style="font-weight:normal">
                        {{ config('app.name') }}
                    </span>
                </a>
            </div>

            <ul class="navbar-item flex-row mr-auto">
                <li class="nav-item align-self-center">
                    
                </li>
            </ul> 

            <div id="loginNotification" data-status="{{ (session('status')? session('status'): '') }}"></div>
           
            @if($page_name != 'students_inscription')
            <ul class="navbar-item flex-row nav-dropdowns" >

                <li class="nav-item dropdown notification-dropdown" id="search-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="searchDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </a>
                    <div class="dropdown-menu no-hide position-absolute animated fadeInUp" aria-labelledby="searchDropdown" id="searchDropdownMenu" style="min-width:340px;max-width:340px">
                        <input type="text" id="searchInput" class="form-control search-form-control bg-white ml-lg-auto" placeholder="Rechercher dans {{ config('app.name') }} ..." />
                        <div id="searchContent"></div>
                    </div>
                </li> 

                <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div id="userTopProfilePhoto">
                                <div class="avatar">
                                    <span class="avatar-title rounded-circle" id="currentUserPhotoAv">IB</span>
                                </div>
                            </div>
                            <div class="media-body align-self-center ml-1">
                                <h6><span style="font-weight:normal">Salut,</span> <span class="text-primary" id="currentUserFirstname">Inna</span></h6>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <div class="dropdown-menu no-hide position-absolute animated fadeInUp" aria-labelledby="user-profile-dropdown" style="max-width:13rem">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="/acces/profil"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Mon profil</a>
                            </div>
                            <div class="dropdown-item">
                                <a href="/deconnexion"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Déconnexion</a>
                            </div>
                            <form id="logout-form" action="" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
            @endif
        </header>
    </div>
    <!--  END NAVBAR  -->                  
@endif