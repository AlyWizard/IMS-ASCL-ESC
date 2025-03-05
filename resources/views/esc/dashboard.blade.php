  <!-- file: resources/views/esc/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ESC Corporation - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/esc-dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <header class="dashboard-header">
            <div class="logo-section">
                <img src="{{ asset('images/esc-logo.png') }}" alt="ESC Logo" class="esc-logo">
                <h1 class="logo-text">Esc <span class="corporation">CORPORATION</span></h1>
            </div>
            
            <div class="actions-section">
                <a href="#" class="action-button">
                    <i class="fas fa-file-alt"></i>
                    <span>Reports</span>
                </a>
                <a href="#" class="action-button">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>
                <a href="{{ route('esc.logout') }}" class="action-button" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('esc.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="dashboard-content">
            <!-- Floor Plan Section -->
            <div class="floor-plan-section">
                <div id="floor-plan-container">
                    <!-- Floor plan will be loaded here -->
                </div>
                <div class="floor-info">
                    <span class="floor-label">Floor Plan</span>
                    <span class="floor-number">15th Floor</span>
                </div>
            </div>
            
        <!-- Sidebar -->
        <div class="dashboard-sidebar">
            <div class="sidebar-menu">
                <a href="#" class="menu-item">People</a>
                <a href="#" class="menu-item">Inventory</a>
                <div class="submenu">
                    <a href="#" class="submenu-item">Assets</a>
                    <a href="#" class="submenu-item">Licenses</a>
                    <a href="#" class="submenu-item">Models</a>
                    <a href="#" class="submenu-item">Categories</a>
                    <a href="#" class="submenu-item">Manufacturer</a>
                </div>
            </div>
    
        <div class="sidebar-footer">
            <button class="create-new-btn">Create New</button>
        </div>
</div>
    
<!-- Workstation Modal - Enhanced for editing -->
<div class="modal fade" id="workstationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Workstation Details</h5>
                <div class="modal-actions">
                    <button type="button" class="btn btn-sm btn-primary me-2" id="editModeToggle">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button type="button" class="btn btn-sm btn-warning me-2" id="transferBtn">
                        <i class="fas fa-exchange-alt"></i> Transfer
                    </button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div id="workstation-details">
                    <!-- Workstation details will be loaded here -->
                </div>
                
                <div id="edit-form-container" class="d-none">
                    <form id="workstationEditForm">
                        <input type="hidden" id="workstation_id" name="workstation_id">
                        
                        <div class="mb-3">
                            <label for="employee_name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="employee_name" name="employee_name">
                        </div>
                        
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position">
                        </div>
                        
                        <h5 class="mt-4">Asset Information</h5>
                        <div id="assets-container">
                            <!-- Asset edit forms will be generated here -->
                        </div>
                    </form>
                </div>
                
                <div id="transfer-container" class="d-none">
                    <h5>Transfer Employee & Assets to Another Workstation</h5>
                    <div class="mb-3">
                        <label for="transferDestination" class="form-label">Select Destination Workstation</label>
                        <select class="form-select" id="transferDestination">
                            <option value="">-- Select Workstation --</option>
                            <!-- Options will be populated dynamically -->
                        </select>
                    </div>
                    <button type="button" class="btn btn-warning" id="confirmTransferBtn">
                        <i class="fas fa-exchange-alt"></i> Confirm Transfer
                    </button>
                    <button type="button" class="btn btn-secondary" id="cancelTransferBtn">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success d-none" id="saveChangesBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/esc-dashboard.js') }}"></script>
</body>
</html>