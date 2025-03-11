<!--views/home.blade.php --> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robinsons Equitable Tower - Company Selection</title>
    <!-- Load external CSS file -->
    <link href="{{ asset('css/company-selection.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <!-- Building header -->
        <header class="building-header">
            <div class="building-logo">
                <img src="{{ asset('images/robinsons-logo.webp')}}" alt="Robinsons Logo">
            </div>
            <h1 class="building-name">Robinsons Equitable Tower</h1>
        </header>

        <!-- Company selection cards -->
        <div class="directory-container">
            <!-- Radio buttons for selection -->
            <input type="radio" name="company" id="alliance-radio">
            <input type="radio" name="company" id="esc-radio" checked>

            <!-- Alliance Card -->
            <label for="alliance-radio" class="directory-card alliance-card">
                <div class="card-content">
                    <div class="company-logo">
                        <img id="alliance-icon" src="{{ asset('images/alliance-logo.png') }}" alt="Alliance Icon">
                    </div>
                    <div class="company-info">
                        <h2 id="alliance-name">Alliance Service Centre Limited</h2>
                        <p class="floor-info">15th Floor</p>
                    </div>
                </div>
                <a href="{{ route('alliance.login') }}" id="alliance-enter" class="enter-btn">Enter</a>
            </label>

            <!-- ESC Card -->
            <label for="esc-radio" class="directory-card esc-card">
                <div class="card-content">
                    <div class="company-logo">
                        <img id="esc-icon" src="{{ asset('images/esc-logo.png') }}" alt="ESC Icon">
                    </div>
                    <div class="company-info">
                        <h2 id="esc-name">ESC Corporation</h2>
                        <p class="floor-info">20th & 15th Floors</p>
                    </div>
                </div>
                <a href="{{ route('esc.login') }}" id="esc-enter" class="enter-btn">Enter</a>
            </label>
        </div>
    </div>

    <!-- Load external JS file -->
    <script src="{{ asset('js/company-selection.js') }}"></script>
</body>
</html>