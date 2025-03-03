<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESC Corporation - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1a2632;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        
        .btn-login {
            background-color: #92c83e;
            border: none;
            width: 100%;
            padding: 10px;
            color: white;
            font-weight: bold;
        }
        
        .btn-login:hover {
            background-color: #7fb52e;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #92c83e;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('images/esc-logo.png') }}" alt="ESC Logo" class="login-logo">
            <h3>ESC Corporation</h3>
            <p class="text-muted">Inventory Management System</p>
        </div>
        
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('esc.login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            
            <button type="submit" class="btn btn-login">Login</button>
        </form>
        
        <a href="{{ route('home') }}" class="back-link">Return to Selection Page</a>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>