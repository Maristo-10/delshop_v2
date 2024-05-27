<nav class="topnav navbar navbar-light">
    {{-- <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button> --}}
    <form class="form-inline mr-auto searchform text-muted">
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search"
            placeholder="Type something..." aria-label="Search">
    </form>
    <ul class="nav">
        {{-- <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
                <span class="fe fe-grid fe-16"></span>
            </a>
        </li> --}}
        <li class="nav-item nav-notif">
            <a href="javascript:;" class="nav-link my-2" id="dropdownMenuButton" data-toggle="dropdown"
                aria-expanded="false">
                <span class="fe fe-bell fe-16"></span>
                <span class="dot dot-md bg-success"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right"
                aria-labelledby="dropdownMenuButton"
                style="max-height: 300px;min-width: 480px; overflow-y:auto;right: 1.0rem !important">
                <span class="text-dark text-lg ml-3" style="margin-bottom: 50%; font-weight:bold">Notifikasi!</span><br>
                @if (auth()->user()->unreadNotifications->count() == 0)
                    <a class="dropdown-item border-radius-md mt-3" href="javascript:;"
                        style="background-color: #F5F7F8">
                        <div class="d-flex py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="text-sm font-weight-normal mb-1">
                                    <small class="font-weight-bold text-danger" style="font-style: italic">
                                        Pesan Notifikasi Masih Kosong</small>
                                </h6>
                            </div>
                        </div>
                    </a>
                @else
                    @foreach (auth()->user()->unreadNotifications as $notification)
                        <li class="mb-1 mt-1">
                            <a class="notification-link dropdown-item border-radius-md"
                                href="{{ route('read.notification', ['id' => $notification->id]) }}"
                                data-notification-id="{{ $notification->id }}">
                                <div class="d-flex flex-column justify-content-center">
                                    <small class="text-xs">
                                        <span class="font-weight-bold">{{ $notification->data['data'] }}</span>
                                    </small>
                                    <small class="text-xs text-secondary mb-0">
                                        <i class="fa fa-clock fa-xs me-1"></i>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset('/user-images/profile.png') }}" alt="..."
                        class="avatar-img rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                {{-- <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activities</a> --}}
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
