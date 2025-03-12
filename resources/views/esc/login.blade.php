<!--File Structure: resources/esc/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ezy Sevice Centre Corporation - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/company-selection.css') }}" rel="stylesheet">
    <link href="{{ asset('css/esc-login.css') }}" rel="stylesheet">
    
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="esc-text">
            <img src="{{ asset('images/esc-logo.png')}}"alt="Alliance logo">
            </div>
            <div class="subtitle">
                <!-- SERVICE Centre CORPORATION   -->
            </div>
        </div>
        
        <div class="login-form-header">
            <div class="login-title">Login</div>
            <div class="admin-access">Admin Access only</div>
        </div>
        
        @if($errors->any())
            <div class="alert alert-danger" style="font-size: 14px; padding: 8px 12px; margin-bottom: 15px;">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        
        <form action="{{ route('esc.login') }}" method="post">
            @csrf
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
            
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            
            <button type="submit" class="btn btn-login">Log-in</button>
            
            <a href="#" class="forgot-password">Forgot Password</a>
            
        </form>
        
        <a href="{{ route('home') }}" class="back-link">Return to Selection Page</a>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>