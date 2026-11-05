<div class="p-3 text-white"
     style="background: linear-gradient(180deg, #1cc88a, #4e73df); height:100%;">

    <h5 class="mb-4 fw-bold text-center">ADMIN PANEL</h5>

    <ul class="nav flex-column gap-2">

        <li class="nav-item">
            <a class="nav-link text-white rounded px-3 py-2 fw-semibold"
               style="border:1px solid rgba(255,255,255,0.3);"
               href="{{ route('dashboard') }}">
                🏠 Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white rounded px-3 py-2 fw-semibold"
               style="border:1px solid rgba(255,255,255,0.3);"
               href="{{ route('admin.akun.index') }}">
                👤 Manajemen Akun
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white rounded px-3 py-2 fw-semibold"
               style="border:1px solid rgba(255,255,255,0.3);"
               href="{{ route('admin.barang.index') }}">
                📦 Barang
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white rounded px-3 py-2 fw-semibold"
               style="border:1px solid rgba(255,255,255,0.3);"
               href="{{ route('admin.diskon.index') }}">
                🏷️ Diskon
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white rounded px-3 py-2 fw-semibold"
               style="border:1px solid rgba(255,255,255,0.3);"
               href="{{ route('admin.transaksi.index') }}">
                💳 Transaksi
            </a>
        </li>

    </ul>

</div>
