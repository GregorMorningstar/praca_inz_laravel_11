    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="{{route('dispatcher/dashboard')}}" class="sidebar-brand">
               GT
            </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item">
                    <a href="{{route('dispatcher/dashboard')}}" class="nav-link">
                        <i class="link-icon" data-feather="shield"></i>
                        <span class="link-title">Spedytor Dashboard</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Zlecenia</li>
                </li>
                <li class="nav-item">
                    <a href="{{route('dispatcher/dashboard')}}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Nowe Zlecenie</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                        <i class="link-icon" data-feather="list"></i>
                        <span class="link-title">Moje Zlecenia</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="emails">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{route('spedytor/order/active')}}" class="nav-link">Aktywne</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('spedytor/order/canceled')}}" class="nav-link">Wycofane</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('spedytor/order/history')}}" class="nav-link">Historia </a>
                            </li>
                        </ul>
                    </div>
                </li>
                              <li class="nav-item">
                    <a href="pages/apps/calendar.html" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Calendar</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Kierowcy</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Zlecenia Kierowców</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="advancedUI">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="pages/advanced-ui/cropper.html" class="nav-link">Przypisane zlecenia</a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Status zlecenia</a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/advanced-ui/sortablejs.html" class="nav-link">Zmiana kierowcy</a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/advanced-ui/sweet-alert.html" class="nav-link">Wszystcy Pracownicy</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
                      </ul>
        </div>
    </nav>

