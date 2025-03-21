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
    <style>
        /* Pop-up styles */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 90%;
            position: relative;
        }
        
        .popup-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }
        
        .popup-header {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .workstation-details h4 {
            margin-top: 15px;
            margin-bottom: 8px;
            font-size: 16px;
            font-weight: 600;
        }
        
        .workstation-details ul {
            padding-left: 20px;
        }
        
        /* Make workstations hoverable */
        .workstation {
            cursor: pointer;
            transition: fill 0.3s;
        }
        
        .workstation:hover rect {
            fill: #c8e6ff !important;
        }

        /* Floor map container styles */
        .floor-map-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: auto;
        }

        #floorMap {
            width: 100%;
            height: 100%;
            min-height: 600px;
        }

        .floor-number {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.7);
            padding: 5px 15px;
            border-radius: 5px;
            z-index: 100;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Left Sidebar -->
        <div class="sidebar">
            <div class="logo-container">
                <img src="{{ asset('images/DSH-ESC-LOGO.png')}}" alt="Alliance logo" class="logo">
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
                    <div class="menu-item-one text-center">
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
                
                <!-- This is where the floor map SVG is inserted -->
                <div id="floorMap">
                    <!-- Your SVG will be embedded here -->
                    <object id="svgObject" data="{{ asset('js/esc-floor-plan.svg') }}" type="image/svg+xml" width="100%" height="100%"></object>                </div>
                
                <!-- Popup for workstation details -->
                <div id="workstationPopup" class="popup-overlay">
                    <div class="popup-content">
                        <span class="popup-close">&times;</span>
                        <div class="popup-header">
                            <h3 id="popupTitle">Workstation Details</h3>
                            <p id="popupStatus" class="badge bg-success">Status: Complete</p>
                        </div>
                        <div class="workstation-details">
                            <h4>Employee Information</h4>
                            <p id="employeeName">Name: </p>
                            <p id="employeePosition">Position: </p>
                            <p id="employeeDepartment">Department: </p>
                            
                            <h4>Assigned Devices</h4>
                            <ul id="devicesList">
                                <!-- Devices will be populated here -->
                            </ul>
                        </div>
                    </div>
                </div>
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
    
    <!-- Workstation interaction script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sample data for workstations
            const workstations = {
                'WSM001': {
                    name: 'Workstation 1',
                    status: 'Complete',
                    employee: {
                        name: 'John Smith',
                        position: 'Software Developer',
                        department: 'Engineering'
                    },
                    devices: [
                        { name: 'Dell Monitor P2419H', serialNumber: 'DL-7823-9921', status: 'Active' },
                        { name: 'Logitech MX Keys Keyboard', serialNumber: 'LG-5562-1244', status: 'Active' },
                        { name: 'Logitech MX Master Mouse', serialNumber: 'LG-5218-9936', status: 'Active' },
                        { name: 'Jabra Elite 85h Headset', serialNumber: 'JB-3312-4567', status: 'Active' }
                    ]
                },
                'WSM002': {
                    name: 'Workstation 2',
                    status: 'Complete',
                    employee: {
                        name: 'Emily Johnson',
                        position: 'UX Designer',
                        department: 'Design'
                    },
                    devices: [
                        { name: 'Dell UltraSharp 27" Monitor', serialNumber: 'DL-9955-7832', status: 'Active' },
                        { name: 'Apple Magic Keyboard', serialNumber: 'AP-3351-9827', status: 'Active' },
                        { name: 'Apple Magic Mouse', serialNumber: 'AP-1198-5543', status: 'Active' },
                        { name: 'AirPods Pro', serialNumber: 'AP-8273-1937', status: 'Active' }
                    ]
                },
                'WSM003': {
                    name: 'Workstation 3',
                    status: 'Complete',
                    employee: {
                        name: 'Michael Rodriguez',
                        position: 'Project Manager',
                        department: 'Operations'
                    },
                    devices: [
                        { name: 'HP E24 Monitor', serialNumber: 'HP-8832-4451', status: 'Active' },
                        { name: 'Keychron K2 Keyboard', serialNumber: 'KC-6652-9982', status: 'Active' },
                        { name: 'Logitech MX Anywhere Mouse', serialNumber: 'LG-3311-8875', status: 'Active' },
                        { name: 'Sony WH-1000XM4 Headphones', serialNumber: 'SN-7772-1937', status: 'Active' }
                    ]
                },
                'WSM004': {
                    name: 'Workstation 4',
                    status: 'Available',
                    employee: {
                        name: 'Unassigned',
                        position: '',
                        department: ''
                    },
                    devices: [
                        { name: 'Dell P2419H Monitor', serialNumber: 'DL-7711-3326', status: 'Available' },
                        { name: 'Logitech K380 Keyboard', serialNumber: 'LG-2215-7764', status: 'Available' },
                        { name: 'Logitech M590 Mouse', serialNumber: 'LG-9918-5522', status: 'Available' }
                    ]
                },
                'WSM005': {
                    name: 'Workstation 5',
                    status: 'Complete',
                    employee: {
                        name: 'Sarah Williams',
                        position: 'Data Analyst',
                        department: 'Business Intelligence'
                    },
                    devices: [
                        { name: 'LG 27" 4K Monitor', serialNumber: 'LG-9917-3342', status: 'Active' },
                        { name: 'Microsoft Ergonomic Keyboard', serialNumber: 'MS-1144-8865', status: 'Active' },
                        { name: 'Microsoft Precision Mouse', serialNumber: 'MS-2231-9984', status: 'Active' },
                        { name: 'Bose QC35 Headphones', serialNumber: 'BS-5533-7762', status: 'Active' }
                    ]
                },
                'WSM006': {
                    name: 'Workstation 6',
                    status: 'Complete',
                    employee: {
                        name: 'David Chen',
                        position: 'System Administrator',
                        department: 'IT'
                    },
                    devices: [
                        { name: 'Dell U2720Q Monitor', serialNumber: 'DL-8877-5541', status: 'Active' },
                        { name: 'Das Keyboard 4 Professional', serialNumber: 'DK-1122-9935', status: 'Active' },
                        { name: 'Logitech G502 Mouse', serialNumber: 'LG-3344-7766', status: 'Active' },
                        { name: 'Sennheiser HD 660 S Headphones', serialNumber: 'SN-2217-3399', status: 'Active' }
                    ]
                },
                'WSM007': {
                    name: 'Workstation 7',
                    status: 'Complete',
                    employee: {
                        name: 'Jessica Martinez',
                        position: 'Marketing Specialist',
                        department: 'Marketing'
                    },
                    devices: [
                        { name: 'ASUS ProArt Display Monitor', serialNumber: 'AS-7723-1198', status: 'Active' },
                        { name: 'Logitech MX Keys Mini Keyboard', serialNumber: 'LG-8816-3377', status: 'Active' },
                        { name: 'Logitech MX Anywhere 3 Mouse', serialNumber: 'LG-9912-4455', status: 'Active' },
                        { name: 'Apple AirPods Max', serialNumber: 'AP-6655-8811', status: 'Active' }
                    ]
                },
                'WSM008': {
                    name: 'Workstation 8',
                    status: 'Unassigned',
                    employee: {
                        name: 'Unassigned',
                        position: '',
                        department: ''
                    },
                    devices: [
                        { name: 'HP E27 Monitor', serialNumber: 'HP-2211-8845', status: 'Unassigned' },
                        { name: 'HP Business Slim Keyboard', serialNumber: 'HP-7781-9932', status: 'Unassigned' },
                        { name: 'HP Business Mouse', serialNumber: 'HP-3312-6654', status: 'Unassigned' }
                    ]
                },
                'WSM009': {
                    name: 'Workstation 9',
                    status: 'Complete',
                    employee: {
                        name: 'Robert Taylor',
                        position: 'Financial Analyst',
                        department: 'Finance'
                    },
                    devices: [
                        { name: 'Dell P2720D Monitor', serialNumber: 'DL-3399-1122', status: 'Active' },
                        { name: 'Logitech G915 Keyboard', serialNumber: 'LG-1133-9977', status: 'Active' },
                        { name: 'Logitech G604 Mouse', serialNumber: 'LG-8845-2211', status: 'Active' },
                        { name: 'Sony WH-1000XM5 Headphones', serialNumber: 'SN-9923-4488', status: 'Active' }
                    ]
                }
            };
            
            // Get popup elements
            const popup = document.getElementById('workstationPopup');
            const popupClose = document.querySelector('.popup-close');
            const popupTitle = document.getElementById('popupTitle');
            const popupStatus = document.getElementById('popupStatus');
            const employeeName = document.getElementById('employeeName');
            const employeePosition = document.getElementById('employeePosition');
            const employeeDepartment = document.getElementById('employeeDepartment');
            const devicesList = document.getElementById('devicesList');
            
            // When SVG is loaded
            const svgObject = document.getElementById('svgObject');
            svgObject.addEventListener('load', function() {
                // Get the SVG document
                const svgDoc = svgObject.contentDocument;
                
                // Add classes to workstation elements
                for (let i = 1; i <= 9; i++) {
                    const wsId = `WSM00${i}`;
                    const wsElement = svgDoc.getElementById(wsId);
                    
                    if (wsElement) {
                        // Add the workstation class
                        wsElement.classList.add('workstation');
                        
                        // Set the data attribute for workstation ID
                        wsElement.setAttribute('data-ws-id', wsId);
                        
                        // Apply color based on status
                        const rect = wsElement.querySelector('rect');
                        if (rect && workstations[wsId]) {
                            const status = workstations[wsId].status;
                            
                            if (status === 'Complete') {
                                rect.setAttribute('fill', '#2ecc71');  // Green
                            } else if (status === 'Available') {
                                rect.setAttribute('fill', '#f39c12');  // Orange
                            } else if (status === 'Unassigned') {
                                rect.setAttribute('fill', '#e74c3c');  // Red
                            }
                        }
                        
                        // Add click event listener
                        wsElement.addEventListener('click', function() {
                            const wsId = this.getAttribute('data-ws-id');
                            showWorkstationDetails(wsId);
                        });
                    }
                }
            });
            
            // Close popup when clicking the close button
            popupClose.addEventListener('click', function() {
                popup.style.display = 'none';
            });
            
            // Close popup when clicking outside the content
            popup.addEventListener('click', function(event) {
                if (event.target === popup) {
                    popup.style.display = 'none';
                }
            });
            
            // Function to show workstation details
            function showWorkstationDetails(wsId) {
                const ws = workstations[wsId];
                
                if (!ws) {
                    console.error('Workstation data not found:', wsId);
                    return;
                }
                
                // Update popup title and status
                popupTitle.textContent = ws.name;
                popupStatus.textContent = `Status: ${ws.status}`;
                
                // Set status color
                if (ws.status === 'Complete') {
                    popupStatus.className = 'badge bg-success';
                } else if (ws.status === 'Available') {
                    popupStatus.className = 'badge bg-warning text-dark';
                } else if (ws.status === 'Unassigned') {
                    popupStatus.className = 'badge bg-danger';
                }
                
                // Update employee information
                employeeName.textContent = `Name: ${ws.employee.name}`;
                employeePosition.textContent = `Position: ${ws.employee.position || 'N/A'}`;
                employeeDepartment.textContent = `Department: ${ws.employee.department || 'N/A'}`;
                
                // Clear previous devices
                devicesList.innerHTML = '';
                
                // Add devices to the list
                ws.devices.forEach(device => {
                    const li = document.createElement('li');
                    li.innerHTML = `<strong>${device.name}</strong> (SN: ${device.serialNumber}) - ${device.status}`;
                    devicesList.appendChild(li);
                });
                
                // Show the popup
                popup.style.display = 'flex';
            }
        });
    </script>
</body>
</html>