// public/js/floorplan-interaction.js
document.addEventListener('DOMContentLoaded', function() {
    const svgObject = document.getElementById('floorPlanSVG');
    
    if (!svgObject) {
        console.error('SVG object not found! Check if the element with ID "floorPlanSVG" exists.');
        return;
    }
    
    console.log('SVG object found, waiting for it to load...');
    
    // Wait for SVG to load
    svgObject.addEventListener('load', function() {
        console.log('SVG loaded, accessing content document...');
        
        const svgDoc = svgObject.contentDocument;
        if (!svgDoc) {
            console.error('Could not access SVG content document. This might be a security restriction.');
            return;
        }
        
        console.log('SVG document accessed successfully.');
        
        // Using data-cell-id attribute instead of class names
        const workstationElements = svgDoc.querySelectorAll('[data-cell-id^="WSM"]');
        const serverElements = svgDoc.querySelectorAll('[data-cell-id^="SVR"]');
        const boardroomElements = svgDoc.querySelectorAll('[data-cell-id^="BR"]');
        
        // Debug output
        console.log('Workstations found:', workstationElements.length);
        console.log('Servers found:', serverElements.length);
        console.log('Boardrooms found:', boardroomElements.length);
        
        // If no elements found, try additional debugging
        if (workstationElements.length === 0) {
            console.log('No workstations found with [data-cell-id^="WSM"]. Checking all data-cell-id elements:');
            const allCellElements = svgDoc.querySelectorAll('[data-cell-id]');
            console.log('Total elements with data-cell-id:', allCellElements.length);
            
            if (allCellElements.length > 0) {
                console.log('First 5 data-cell-id values:');
                for (let i = 0; i < Math.min(5, allCellElements.length); i++) {
                    console.log(`Element ${i+1}:`, allCellElements[i].getAttribute('data-cell-id'));
                }
            }
            
            // Try other common SVG element types
            console.log('Checking all rect elements:');
            const rectElements = svgDoc.querySelectorAll('rect');
            console.log('Total rect elements:', rectElements.length);
        }
        
        // Add event listeners to workstations
        workstationElements.forEach(element => {
            const workstationId = element.getAttribute('data-cell-id');
            console.log('Adding click listener to workstation:', workstationId);
            
            // Apply cursor style to rect elements inside the group
            const rects = element.querySelectorAll('rect');
            rects.forEach(rect => {
                rect.style.cursor = 'pointer';
            });
            
            // Add click event to the group element
            element.addEventListener('click', function(event) {
                console.log('Workstation clicked:', workstationId);
                fetchWorkstationData(workstationId);
                event.stopPropagation();
            });
        });
        
        // Add event listeners to servers
        serverElements.forEach(element => {
            const serverId = element.getAttribute('data-cell-id');
            
            // Apply cursor style to rect elements inside the group
            const rects = element.querySelectorAll('rect');
            rects.forEach(rect => {
                rect.style.cursor = 'pointer';
            });
            
            element.addEventListener('click', function(event) {
                console.log('Server clicked:', serverId);
                fetchServerData(serverId);
                event.stopPropagation();
            });
        });
        
        // Add event listeners to boardrooms
        boardroomElements.forEach(element => {
            const boardroomId = element.getAttribute('data-cell-id');
            
            // Apply cursor style to rect elements inside the group
            const rects = element.querySelectorAll('rect');
            rects.forEach(rect => {
                rect.style.cursor = 'pointer';
            });
            
            element.addEventListener('click', function(event) {
                console.log('Boardroom clicked:', boardroomId);
                fetchBoardroomData(boardroomId);
                event.stopPropagation();
            });
        });
    });
    
    // Function to fetch workstation data
    function fetchWorkstationData(workstationId) {
        console.log('Fetching workstation data for:', workstationId);
        
        // AJAX call to get workstation data - using Alliance route
        fetch(`/alliance/workstation/${workstationId}`)
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Workstation data received:', data);
                showWorkstationPopup(workstationId, data);
            })
            .catch(error => {
                console.error('Error fetching workstation data:', error);
                // Show popup with mock data for testing
                console.log('Using mock data instead');
                showWorkstationPopup(workstationId, getMockWorkstationData(workstationId));
            });
    }
    
    // Function to fetch server data
    function fetchServerData(serverId) {
        fetch(`/alliance/server/${serverId}`)
            .then(response => response.json())
            .then(data => {
                showServerPopup(serverId, data);
            })
            .catch(error => {
                console.error('Error fetching server data:', error);
                showServerPopup(serverId, getMockServerData(serverId));
            });
    }
    
    // Function to fetch boardroom data
    function fetchBoardroomData(boardroomId) {
        fetch(`/alliance/boardroom/${boardroomId}`)
            .then(response => response.json())
            .then(data => {
                showBoardroomPopup(boardroomId, data);
            })
            .catch(error => {
                console.error('Error fetching boardroom data:', error);
                showBoardroomPopup(boardroomId, getMockBoardroomData(boardroomId));
            });
    }
    
    // Function to show workstation popup
    function showWorkstationPopup(workstationId, data) {
        console.log('Showing popup for workstation:', workstationId);
        
        // Remove any existing popups
        closePopup();
        
        // Create popup elements
        const overlay = document.createElement('div');
        overlay.className = 'popup-overlay';
        
        const popup = document.createElement('div');
        popup.className = 'workspace-popup';
        
        // Populate popup content
        popup.innerHTML = `
            <div class="popup-header">
                <div class="popup-title">Workstation ${workstationId}</div>
                <div class="close-popup">&times;</div>
            </div>
            <div class="employee-info">
                <strong>Assigned to:</strong> ${data.employee ? data.employee.name : 'Unassigned'}
            </div>
            <div class="device-section">
                <h4>Devices</h4>
                <div class="device-list">
                    ${generateDeviceList(data.devices)}
                </div>
                <button class="add-device-btn" data-ws="${workstationId}">Add Device</button>
            </div>
        `;
        
        // Add event listeners for popup interactions
        document.body.appendChild(overlay);
        document.body.appendChild(popup);
        
        // Close popup when clicking the X or overlay
        popup.querySelector('.close-popup').addEventListener('click', closePopup);
        overlay.addEventListener('click', closePopup);
        
        // Add device button functionality
        popup.querySelector('.add-device-btn').addEventListener('click', function() {
            // Implementation for adding a device
            alert('Add device functionality will be implemented here');
        });
    }
    
    // Function to show server popup
    function showServerPopup(serverId, data) {
        closePopup();
        
        const overlay = document.createElement('div');
        overlay.className = 'popup-overlay';
        
        const popup = document.createElement('div');
        popup.className = 'workspace-popup';
        
        popup.innerHTML = `
            <div class="popup-header">
                <div class="popup-title">Server ${serverId}</div>
                <div class="close-popup">&times;</div>
            </div>
            <div>
                <p><strong>Name:</strong> ${data.name}</p>
                <p><strong>Specifications:</strong> ${data.specs}</p>
                <p><strong>Status:</strong> ${data.status}</p>
            </div>
        `;
        
        document.body.appendChild(overlay);
        document.body.appendChild(popup);
        
        popup.querySelector('.close-popup').addEventListener('click', closePopup);
        overlay.addEventListener('click', closePopup);
    }
    
    // Function to show boardroom popup
    function showBoardroomPopup(boardroomId, data) {
        closePopup();
        
        const overlay = document.createElement('div');
        overlay.className = 'popup-overlay';
        
        const popup = document.createElement('div');
        popup.className = 'workspace-popup';
        
        popup.innerHTML = `
            <div class="popup-header">
                <div class="popup-title">${data.name}</div>
                <div class="close-popup">&times;</div>
            </div>
            <div>
                <p><strong>ID:</strong> ${boardroomId}</p>
                <p><strong>Capacity:</strong> ${data.capacity} people</p>
                <h4>Equipment:</h4>
                <ul>
                    ${data.equipment.map(item => `<li>${item.type}: ${item.model}</li>`).join('')}
                </ul>
            </div>
        `;
        
        document.body.appendChild(overlay);
        document.body.appendChild(popup);
        
        popup.querySelector('.close-popup').addEventListener('click', closePopup);
        overlay.addEventListener('click', closePopup);
    }
    
    // Helper function to generate device list HTML
    function generateDeviceList(devices) {
        if (!devices || devices.length === 0) {
            return '<p>No devices assigned</p>';
        }
        
        let html = '';
        devices.forEach(device => {
            html += `
                <div class="device-item">
                    <span>${device.type}</span>
                    <span>${device.model || device.serial}</span>
                </div>
            `;
        });
        
        return html;
    }
    
    // Function to close popup
    function closePopup() {
        console.log('Closing popup');
        const popup = document.querySelector('.workspace-popup');
        const overlay = document.querySelector('.popup-overlay');
        
        if (popup) popup.remove();
        if (overlay) overlay.remove();
    }
    
    // Mock data for testing
    function getMockWorkstationData(workstationId) {
        return {
            id: workstationId,
            employee: {
                id: 1,
                name: 'John Doe',
                position: 'Software Developer'
            },
            devices: [
                { type: 'Monitor', model: 'Dell P2419H', serial: 'ABC123' },
                { type: 'Monitor', model: 'Dell P2419H', serial: 'DEF456' },
                { type: 'Keyboard', model: 'Logitech K120', serial: 'KBD789' },
                { type: 'Mouse', model: 'Logitech M100', serial: 'MOU012' },
                { type: 'System Unit', model: 'Dell OptiPlex 7050', serial: 'SYS345' },
                { type: 'Headset', model: 'Jabra Evolve 20', serial: 'HDS678' }
            ]
        };
    }
    
    function getMockServerData(serverId) {
        return {
            id: serverId,
            name: `Server ${serverId}`,
            specs: 'Dell PowerEdge R740, 64GB RAM, 2TB Storage',
            status: 'Active'
        };
    }
    
    function getMockBoardroomData(boardroomId) {
        return {
            id: boardroomId,
            name: 'Main Conference Room',
            capacity: 12,
            equipment: [
                { type: 'Projector', model: 'Epson EB-2250U' },
                { type: 'Conference System', model: 'Polycom RealPresence' }
            ]
        };
    }
});