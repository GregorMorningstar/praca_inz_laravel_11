@extends('admin.admin_dashboard')
@section('admin')
        <div class="page-content">

            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                    <h4 class="mb-3 mb-md-0">Panel Administacyjny Giełdy Transportowej</h4>
                </div>
                <div class="d-flex align-items-center flex-wrap text-nowrap">
                    <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                        <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                        <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12 stretch-card">
                    <div class="row flex-grow-1">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="card-title mb-0">Ilość Userów</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{$userCount}}</h3>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h6 class="card-title mb-0">Ilość Nowych Zleceń</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-xl-5">
                                            <h3 class="mb-2">{{ $pendingOrdersCount }}</h3>

                                        </div>
                                                                           </div>
                                </div>
                            </div>

                            </div>
                        </div>

                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Ilość Samochodów w Flocie</h6>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{$carCount}}</h3>

                                    </div>

                                </div>                            </div>
                        </div>
                    </div>

                    </div>

            </div> <!-- row -->



            <div class="row">
                <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">Inbox</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3">
                                    <div class="me-3">
                                        <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body mb-2">Leonardo Payne</h6>
                                            <p class="text-muted tx-12">12.30 PM</p>
                                        </div>
                                        <p class="text-muted tx-13">Hey! there I'm available...</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                                    <div class="me-3">
                                        <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body mb-2">Carl Henson</h6>
                                            <p class="text-muted tx-12">02.14 AM</p>
                                        </div>
                                        <p class="text-muted tx-13">I've finished it! See you so..</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                                    <div class="me-3">
                                        <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body mb-2">Jensen Combs</h6>
                                            <p class="text-muted tx-12">08.22 PM</p>
                                        </div>
                                        <p class="text-muted tx-13">This template is awesome!</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                                    <div class="me-3">
                                        <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body mb-2">Amiah Burton</h6>
                                            <p class="text-muted tx-12">05.49 AM</p>
                                        </div>
                                        <p class="text-muted tx-13">Nice to meet you</p>
                                    </div>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                                    <div class="me-3">
                                        <img src="https://via.placeholder.com/35x35" class="rounded-circle wd-35" alt="user">
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-body mb-2">Yaretzi Mayo</h6>
                                            <p class="text-muted tx-12">01.19 AM</p>
                                        </div>
                                        <p class="text-muted tx-13">Hey! there I'm available...</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <h6 class="card-title mb-0">Pracownicy</h6>

                            </div>
                            <div class="table-responsive">
                                <div class="d-flex justify-content-center">
                                    {{ $users->links('vendor.pagination.bootstrap-4', ['class' => 'pagination pagination-sm']) }}
                                </div>
                                <table class="table-sm table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th class="pt-0">Name</th>
                                        <th class="pt-0">E-mail</th>
                                        <th class="pt-0">Phone</th>
                                        <th class="pt-0">Rola</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone ?? 'N/A' }}</td>
                                            <td>
                                                @if($user->role === 'driver')
                                                    Kierowca
                                                @elseif($user->role === 'dispatcher')
                                                    Spedytor
                                                @else
                                                    {{ ucfirst($user->role) }}
                                                @endif
                                            </td>                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- row -->

        </div>
@endsection
