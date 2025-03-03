<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS - Company Selection</title>
    <!-- Load external CSS file -->
    <link href="{{ asset('css/company-selection.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Radio buttons for the slider -->
        <input type="radio" name="slider" id="item-1" checked>
        <input type="radio" name="slider" id="item-2">

        <div class="company-card">
            <div class="company-info">
        <!-- Company logo and name will change based on selected card -->
        <div class="company-logo">
            <div class="logo-img">
                <!-- Logo images that will switch based on selection -->
                <img id="esc-icon" src="{{ asset('images/esc-logo.png') }}" alt="ESC Icon">
                <img id="alliance-icon" src="{{ asset('images/alliance-logo.png') }}" alt="Alliance Icon" style="display: none;">
            </div>
            
        </div>
                
                <h1 class="company-name">
                    <span id="esc-name">ESC Corporation</span>
                    <span id="alliance-name" style="display: none;">Alliance Service Centre Limited</span>
                </h1>
                
                <a href="{{ route('esc.login') }}" id="esc-enter" class="enter-btn">Enter</a>
                <a href="{{ route('alliance.login') }}" id="alliance-enter" class="enter-btn" style="display: none;">Enter</a>
            </div>
            
            <div class="visual-area">
                <div class="cards">
                    <!-- ESC Card -->
                    <label class="card" for="item-1" id="card-1">
                        <img src="{{ asset('images/esc-card.png') }}" alt="ESC">
                    </label>
                    
                    <!-- Alliance Card -->
                    <label class="card" for="item-2" id="card-2">
                        <img src="{{ asset('images/alliance-card.png') }}" alt="Alliance">
                    </label>
                    
                
            </div>
        </div>
    </div>

    <!-- Load external JS file -->
    <script src="{{ asset('js/company-selection.js') }}"></script>
</body>
</html>