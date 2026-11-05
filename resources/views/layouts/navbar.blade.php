<nav class="navbar navbar-expand-md shadow-sm"
     style="background: linear-gradient(90deg, #4e73df, #1cc88a);">
    <div class="container">

        <a class="navbar-brand fw-bold text-white" href="#">
            ADMIN PANEL
        </a>

        <button class="navbar-toggler bg-light" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto">

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold"
                               href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                    @endif

                    <!-- Logout -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold"
                           href="#"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
