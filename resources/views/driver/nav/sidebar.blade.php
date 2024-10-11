    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="{{route('driver/dashboard')}}" class="sidebar-brand">
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
                    <a href="{{route('driver/dashboard')}}" class="nav-link">
                        <i class="link-icon" data-feather="shield"></i>
                        <span class="link-title">Driver Dashboard</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Zlecenia</li>
                </li>
                <li class="nav-item">
                    <a href="{{route('driver/dashboard')}}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Lista aktywnych zleceń</span>
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
                                <a href="{{route('driver.order.in_progress')}}" class="nav-link">Aktywne</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('driver.order.history')}}" class="nav-link">Historia </a>
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
                <li class="nav-item">
                    <a href="pages/apps/calendar.html" class="nav-link">
                        <i class="link-icon" data-feather="truck"></i>
                        <span class="link-title">Przypisany samochód</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/apps/calendar.html" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Podsumowanie zleceń</span>
                    </a>
                </li>
                      </ul>
        </div>
    </nav>

