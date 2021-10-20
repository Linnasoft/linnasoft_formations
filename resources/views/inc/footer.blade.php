@if ($page_name != 'form' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'students_inscription')
    <!--  BEGIN SIDEBAR  -->
    {{-- <div class="sidebar-wrapper sidebar-theme">
                
        <nav id="sidebar">

            <ul class="navbar-nav theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="{{getURL()}}/">
                        <img src="{{asset('assets/img/logo/logo_110x110.png')}}" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="{{getURL()}}/" class="nav-link"> {{ config('app.name') }} </a>
                </li>
            </ul>
        </nav>

    </div> --}}
    <!--  END SIDEBAR  -->

    <!--  BEGIN FOOTER  -->
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="text-dark text-normal">Copyright © {{ date('Y') }} <a target="_blank" href="{{ config('app.website') }}"><span class="text-color-linna1">{{ config('app.name') }} sarl</span></a>, Tous droits réservés.</p>
        </div>
    </div>
    <!--  END FOOTER  -->

@endif