<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center px-3">
    <div class="w-100" style="max-width:420px;">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center fw-bold py-3 rounded-top-4">
                LOGIN
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text"
                               class="form-control form-control-lg @error('username') is-invalid @enderror"
                               name="username"
                               value="{{ old('username') }}"
                               required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                               name="password"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button class="btn btn-primary btn-lg w-100">
                        Masuk
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small>
                        Belum punya akun?
                        <a href="{{ route('register') }}">Daftar</a>
                    </small>
                </div>
            </div>
        </div>

        <p class="text-center text-muted mt-3 small">
            © 2025 App
        </p>
    </div>
</div>

</body>
</html>
