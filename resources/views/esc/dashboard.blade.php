<!--File Structure: resources/esc/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESC Corporation - Inventory Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/esc-dashboard.css') }}">

    
</head>
<body>
    <div class="dashboard-container">
        <!-- Left Sidebar -->
        <div class="sidebar">
            <div class="logo-container">
                <!--<div class="logo">ALLIANCE</div> -->
                <!--<div style="color: #8b949e; font-size: 9px; letter-spacing: 0.5px; margin-top: 2px;">SECURITY SYSTEMS COMPANY</div> -->
                <img src="{{ asset('images/DSH-ESC-LOGO.png')}}"alt="Alliance logo" class="logo">

            </div>
        <div class="menu-items-container">
         <div class="menu-title">Floor Mapping</div>
                    <div class="menu-item">
                        <div style="width: 16px; height: 16px; background-color: #e74c3c; border-radius: 2px; margin-right: 10px;"></div>
                        <span>Unassigned</span>
                    </div>
                    <div class="menu-item">
                        <div style="width: 16px; height: 16px; background-color: #f39c12; border-radius: 2px; margin-right: 10px;"></div>
                        <span>Available</span>
                    </div>
                    <div class="menu-item ">
                        <div style="width: 16px; height: 16px; background-color: #2ecc71; border-radius: 2px; margin-right: 10px;"></div>
                        <span>Complete</span>
                    </div>
            </div>
            
           
                <div class="menu-title-inv">Inventories</div>
                <div class="menu-items-container">
                    <div class="menu-item">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/user.svg" width="16" height="16" style="filter: invert(1); margin-right: 10px;">
                        <span>Employees</span>
                    </div>
                    <div class="menu-item">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/simpleicons.svg" width="16" height="16" style="filter: invert(1); margin-right: 10px;">
                        <span>Manufacturers</span>
                    </div>
                    <div class="menu-item">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/cakephp.svg" width="16" height="16" style="filter: invert(1); margin-right: 10px;">
                        <span>Categories</span>
                    </div>
                    <div class="menu-item">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/apple.svg" width="16" height="16" style="filter: invert(1); margin-right: 10px;">
                        <span>Models</span>
                    </div>
                    <div class="menu-item">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/atom.svg" width="16" height="16" style="filter: invert(1); margin-right: 10px;">
                        <span>Assets</span>
                    </div>
                </div>
            

                <div class="menu-title-others">Others</div>
                <div class="menu-items-container-oth">
                    <div class="menu-item-oth">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/clipboard.svg" width="16" height="16" style="filter: invert(1); margin-right: 10px;">
                        <span>Activity Reports</span>
                    </div>
                    <div class="menu-item-oth">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/buffer.svg" width="16" height="16" style="filter: invert(1); margin-right: 10px;">
                        <span>Settings & Sessions</span>
                    </div>
                    <div class="menu-item-oth">
                        <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/buffer.svg" width="16" height="16" style="filter: invert(1); margin-right: 10px;">
                        <span>Account Creation </span>
                    </div>
                </div>

                    <div class="row g-1">
                        <div class="col-6">
                            <div class="menu-item-one  text-center">
                                <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/aboutdotme.svg" width="16" height="16" style="filter: invert(1); margin-right: 5px;">
                                <span>About</span>
                            </div>
                        </div>
                        <div class="col-6">
                             <a href="{{ route('esc.logout') }}" class="menu-item-one text-center"
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 <img src="https://cdnjs.cloudflare.com/ajax/libs/simple-icons/3.0.1/keybase.svg" width="16" height="16" style="filter: invert(1); margin-right: 5px;">
                                  <span>Logout</span>
                              </a>
                          <form id="logout-form" action="{{ route('esc.logout') }}" method="POST" style="display: none;">
                          @csrf
                          </form>
                        </div>
                    </div>
         </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <div class="floor-map-container">

                
                <div class="floor-number">20F</div>
                
                <!-- This is where the floor map SVG wil go insert the floor map here -->
 
                
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="right-sidebar">
            <div class="right-sidebar-title">Assets</div>
            
            <div class="status-item">
                <div class="status-icon" style="border: 1px solid #fff;"></div>
                <span>List All</span>
            </div>
            
            <div class="status-item">
                <div class="status-icon" style="background-color: #2ecc71;"></div>
                <span>Ready to Deploy</span>
            </div>
            
            <div class="status-item">
                <div class="status-icon" style="background-color: #3498db;"></div>
                <span>Onsite (Deployed)</span>
            </div>
            
            <div class="status-item">
                <div class="status-icon" style="background-color: #3498db;"></div>
                <span>WiFi (Deployed)</span>
            </div>
            
            <div class="status-item">
                <div class="status-icon" style="background-color: #e84393;"></div>
                <span>Temporarily Deployed</span>
            </div>
            
            <div class="status-item">
                <div class="status-icon" style="background-color: #f39c12;"></div>
                <span>Borrowed by ESC</span>
            </div>
            
            <div class="status-item">
                <div class="status-icon" style="background-color: #e74c3c;"></div>
                <span>Defective</span>
            </div>

            <button class="create-btn">Create New</button>

        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>