    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="{{route('admin/dashboard')}}" class="sidebar-brand">
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
                    <a href="{{route('admin/dashboard')}}" class="nav-link">
                        <i class="link-icon" data-feather="shield"></i>
                        <span class="link-title">Admin Dashboard</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Samochody</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                        <i class="link-icon" data-feather="truck"></i>
                        <span class="link-title">Flota</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="emails">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{route('car/list')}}" class="nav-link">Lista Samochodów</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('car/add')}}" class="nav-link">Dodaj Samochód</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('car/add-driver')}}" class="nav-link">Przypisz Kierowce</a>
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
                <li class="nav-item nav-category">Pracownicy</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="link-title">Pracownicy</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="advancedUI">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{route('dispatcher/list')}}" class="nav-link">Spedytorzy</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('driver/list')}}" class="nav-link">Kierowcy</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('role/edit')}}" class="nav-link">Edycja Roli</a>
                            </li>

                        </ul>
                    </div>
                </li>
                      </ul>
        </div>
    </nav>
