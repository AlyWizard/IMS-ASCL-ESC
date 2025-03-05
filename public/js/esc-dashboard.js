// File: public/js/esc-dashboard.js

document.addEventListener('DOMContentLoaded', function() {
    loadFloorPlan();
    setupModalEventListeners();
});

// Function to load the floor plan
function loadFloorPlan() {
    // Get the container
    const container = document.getElementById('floor-plan-container');
    
    // Create SVG element for the floor plan
    fetch('/js/esc-floor-plan.svg')
        .then(response => response.text())
        .then(svgContent => {
            // Wrap the SVG in a div with the floor-plan-svg class
            container.innerHTML = `<div class="floor-plan-svg">${svgContent}</div>`;
            
            // Add pan and zoom functionality
            setupPanZoom();
            
            // After loading the SVG, add click events to workstations
            setupWorkstationInteractions();
            
            // Update workstation colors based on status
            updateWorkstationStatus();
        })
        .catch(error => {
            console.error('Error loading floor plan:', error);
            container.innerHTML = '<div class="error-message">Error loading floor plan. Please try again later.</div>';
        });
}

// Function to setup pan and zoom for the floor plan
function setupPanZoom() {
    const floorPlanSvg = document.querySelector('.floor-plan-svg svg');
    
    if (!floorPlanSvg) return;
    
    let isDragging = false;
    let startX, startY;
    let currentX = 0, currentY = 0;
    let scale = 1;
    
    // Enable dragging (panning)
    floorPlanSvg.addEventListener('mousedown', function(e) {
        isDragging = true;
        startX = e.clientX - currentX;
        startY = e.clientY - currentY;
        floorPlanSvg.style.cursor = 'grabbing';
    });
    
    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        
        currentX = e.clientX - startX;
        currentY = e.clientY - startY;
        
        floorPlanSvg.style.transform = `translate(${currentX}px, ${currentY}px) scale(${scale})`;
    });
    
    document.addEventListener('mouseup', function() {
        isDragging = false;
        floorPlanSvg.style.cursor = 'grab';
    });
    
    // Enable zooming with mouse wheel
    floorPlanSvg.addEventListener('wheel', function(e) {
        e.preventDefault();
        
        const delta = e.deltaY > 0 ? -0.1 : 0.1;
        scale = Math.max(0.5, Math.min(3, scale + delta));
        
        // Update transform with the new scale
        floorPlanSvg.style.transform = `translate(${currentX}px, ${currentY}px) scale(${scale})`;
    });
    
    // Initial cursor style
    floorPlanSvg.style.cursor = 'grab';
}

// Function to set up interactions for workstations
function setupWorkstationInteractions() {
    // Select all workstation elements in the SVG
    const workstations = document.querySelectorAll('.workstation');
    
    // Add click event to each workstation
    workstations.forEach(workstation => {
        workstation.addEventListener('click', function(event) {
            // Prevent event bubbling to avoid interfering with pan/zoom
            event.stopPropagation();
            
            const workstationId = this.getAttribute('data-id');
            showWorkstationDetails(workstationId);
        });
        
        // Add hover effects
        workstation.addEventListener('mouseenter', function() {
            this.style.stroke = '#ffffff';
            this.style.strokeWidth = '2';
            this.style.cursor = 'pointer';
            
            // Show a tooltip with the workstation ID
            const id = this.getAttribute('data-id');
            showTooltip(id, this);
        });
        
        workstation.addEventListener('mouseleave', function() {
            this.style.stroke = '#ffffff';
            this.style.strokeWidth = '1';
            
            // Hide tooltip
            hideTooltip();
        });
    });
}

// Function to show tooltip
function showTooltip(text, element) {
    // Check if tooltip already exists
    let tooltip = document.getElementById('workstation-tooltip');
    
    // If not, create one
    if (!tooltip) {
        tooltip = document.createElement('div');
        tooltip.id = 'workstation-tooltip';
        tooltip.className = 'tooltip';
        document.body.appendChild(tooltip);
    }
    
    // Set tooltip text
    tooltip.textContent = text;
    
    // Position tooltip near the element
    const rect = element.getBoundingClientRect();
    tooltip.style.left = `${rect.left + rect.width / 2}px`;
    tooltip.style.top = `${rect.top - 30}px`;
    tooltip.style.display = 'block';
}

// Function to hide tooltip
function hideTooltip() {
    const tooltip = document.getElementById('workstation-tooltip');
    if (tooltip) {
        tooltip.style.display = 'none';
    }
}

// Function to update workstation colors based on status
function updateWorkstationStatus() {
    // Fetch all workstation statuses from the API
    fetch('/api/esc/workstations/status')
        .then(response => response.json())
        .then(data => {
            // Loop through each workstation status
            data.forEach(station => {
                // Find the corresponding SVG element
                const workstationElement = document.querySelector(`.workstation[data-id="${station.workstation_id}"]`);
                
                if (workstationElement) {
                    // Remove any existing status classes
                    workstationElement.classList.remove('occupied', 'vacant');
                    
                    // Add appropriate status class based on occupancy
                    if (station.status === 'Occupied') {
                        workstationElement.classList.add('occupied');
                        workstationElement.setAttribute('fill', '#92c83e'); // Green for occupied
                    } else {
                        workstationElement.classList.add('vacant');
                        workstationElement.setAttribute('fill', '#e74c3c'); // Red for vacant
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching workstation statuses:', error);
        });
}

// Function to show workstation details in a modal
function showWorkstationDetails(workstationId) {
    // Reset the modal state
    document.getElementById('edit-form-container').classList.add('d-none');
    document.getElementById('transfer-container').classList.add('d-none');
    document.getElementById('workstation-details').classList.remove('d-none');
    document.getElementById('saveChangesBtn').classList.add('d-none');
    
    // Fetch workstation data from the server
    fetch(`/api/esc/workstation/${workstationId}`)
        .then(response => response.json())
        .then(data => {
            // Store the current workstation data for later use
            window.currentWorkstationData = data;
            
            // Populate the modal with workstation details
            const modalContent = document.getElementById('workstation-details');
            
            // Create HTML content for the modal
            let html = `
                <div class="workstation-header">
                    <h3>${data.workstation_id}</h3>
                    <span class="status ${data.status.toLowerCase()}">${data.status}</span>
                </div>
                
                <div class="employee-info">
                    <div class="info-row">
                        <span class="info-label">Employee:</span>
                        <span class="info-value">${data.employee_name || 'Unassigned'}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Position:</span>
                        <span class="info-value">${data.position || 'N/A'}</span>
                    </div>
                </div>
            `;
            
            if (data.assets && data.assets.length > 0) {
                html += `<h4>Assigned Assets</h4><div class="assets-list">`;
                
                // Add each asset to the HTML
                data.assets.forEach(asset => {
                    html += `
                        <div class="asset-item">
                            <div class="asset-header">
                                <span class="asset-name">${asset.name}</span>
                                <span class="asset-id">${asset.asset_id}</span>
                            </div>
                            <div class="asset-details">
                                <div class="info-row">
                                    <span class="info-label">Category:</span>
                                    <span class="info-value">${asset.category || 'N/A'}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Model:</span>
                                    <span class="info-value">${asset.model || 'N/A'}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Manufacturer:</span>
                                    <span class="info-value">${asset.manufacturer || 'N/A'}</span>
                                </div>
                                ${asset.serial_number ? `
                                <div class="info-row">
                                    <span class="info-label">Serial Number:</span>
                                    <span class="info-value">${asset.serial_number}</span>
                                </div>` : ''}
                            </div>
                        </div>
                    `;
                });
                
                html += `</div>`;
            } else {
                html += `<p class="no-assets">No assets assigned to this workstation.</p>`;
            }
            
            // Set the HTML content
            modalContent.innerHTML = html;
            
            // Populate the edit form fields
            populateEditForm(data);
            
            // Populate the transfer dropdown (excluding current workstation)
            populateTransferDropdown(workstationId);
            
            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('workstationModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error fetching workstation details:', error);
            alert('Error loading workstation details. Please try again.');
        });
}

// Function to populate the edit form with workstation data
function populateEditForm(data) {
    // Set basic workstation information
    document.getElementById('workstation_id').value = data.workstation_id;
    document.getElementById('employee_name').value = data.employee_name || '';
    document.getElementById('position').value = data.position || '';
    
    // Populate assets
    const assetsContainer = document.getElementById('assets-container');
    assetsContainer.innerHTML = '';
    
    // Define the standard assets that should be present
    const standardAssets = [
        { type: 'Monitor 1', prefix: 'MANILA-MON', show_serial: true },
        { type: 'Monitor 2', prefix: 'MANILA-MON', show_serial: true },
        { type: 'System Unit', prefix: 'MANILA-PC', show_serial: true },
        { type: 'Mouse', prefix: 'MANILA-MSE', show_serial: false },
        { type: 'Keyboard', prefix: 'MANILA-KB', show_serial: false },
        { type: 'Headset', prefix: 'MANILA-HS', show_serial: false },
        { type: 'Webcam', prefix: 'MANILA-WB', show_serial: false },
        { type: 'Telephone', prefix: 'MANILA-TEL', show_serial: false }
    ];
    
    // For each standard asset, create a form section
    standardAssets.forEach((standardAsset, index) => {
        // Find if there's an existing asset of this type
        const existingAsset = data.assets ? data.assets.find(a => a.name === standardAsset.type) : null;
        
        const assetHtml = `
            <div class="asset-edit-item mb-4">
                <h6>${standardAsset.type}</h6>
                <input type="hidden" name="assets[${index}][type]" value="${standardAsset.type}">
                
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Asset Tag</label>
                        <input type="text" class="form-control" name="assets[${index}][asset_id]" 
                               value="${existingAsset ? existingAsset.asset_id : `${standardAsset.prefix}-???`}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="assets[${index}][category]" 
                               value="${existingAsset && existingAsset.category ? existingAsset.category : standardAsset.type}">
                    </div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Manufacturer</label>
                        <input type="text" class="form-control" name="assets[${index}][manufacturer]" 
                               value="${existingAsset ? existingAsset.manufacturer || '' : ''}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Model</label>
                        <input type="text" class="form-control" name="assets[${index}][model]" 
                               value="${existingAsset ? existingAsset.model || '' : ''}">
                    </div>
                </div>
                
                ${standardAsset.show_serial ? `
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Serial Number</label>
                        <input type="text" class="form-control" name="assets[${index}][serial_number]" 
                               value="${existingAsset && existingAsset.serial_number ? existingAsset.serial_number : ''}">
                    </div>
                </div>` : ''}
            </div>
        `;
        
        assetsContainer.innerHTML += assetHtml;
    });
}

// Function to populate the transfer dropdown
function populateTransferDropdown(currentWorkstationId) {
    // Get the select element
    const select = document.getElementById('transferDestination');
    select.innerHTML = '<option value="">-- Select Workstation --</option>';
    
    // Fetch all workstations
    fetch('/api/esc/workstations')
        .then(response => response.json())
        .then(data => {
            // Filter out the current workstation
            const otherWorkstations = data.filter(ws => ws.workstation_id !== currentWorkstationId);
            
            // Add options for each available workstation
            otherWorkstations.forEach(workstation => {
                const option = document.createElement('option');
                option.value = workstation.workstation_id;
                option.textContent = `${workstation.workstation_id} - ${workstation.status}`;
                
                // Disable occupied workstations
                if (workstation.status === 'Occupied') {
                    option.disabled = true;
                }
                
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching workstations for transfer:', error);
        });
}

// Setup event listeners for the modal interactions
function setupModalEventListeners() {
    // Edit mode toggle
    document.getElementById('editModeToggle').addEventListener('click', function() {
        const detailsContainer = document.getElementById('workstation-details');
        const editFormContainer = document.getElementById('edit-form-container');
        const saveButton = document.getElementById('saveChangesBtn');
        
        detailsContainer.classList.toggle('d-none');
        editFormContainer.classList.toggle('d-none');
        saveButton.classList.toggle('d-none');
        
        // Hide transfer container if visible
        document.getElementById('transfer-container').classList.add('d-none');
    });
    
    // Transfer button
    document.getElementById('transferBtn').addEventListener('click', function() {
        const detailsContainer = document.getElementById('workstation-details');
        const transferContainer = document.getElementById('transfer-container');
        
        detailsContainer.classList.toggle('d-none');
        transferContainer.classList.toggle('d-none');
        
        // Hide edit form if visible
        document.getElementById('edit-form-container').classList.add('d-none');
        document.getElementById('saveChangesBtn').classList.add('d-none');
    });
    
    // Cancel transfer button
    document.getElementById('cancelTransferBtn').addEventListener('click', function() {
        document.getElementById('transfer-container').classList.add('d-none');
        document.getElementById('workstation-details').classList.remove('d-none');
    });
    
    // Save changes button
    document.getElementById('saveChangesBtn').addEventListener('click', function() {
        // Get form data
        const formData = new FormData(document.getElementById('workstationEditForm'));
        const workstationId = formData.get('workstation_id');
        
        // Convert FormData to JSON
        const data = {};
        formData.forEach((value, key) => {
            // Handle arrays (like assets[0][name])
            if (key.includes('[') && key.includes(']')) {
                const matches = key.match(/([^\[]+)\[([^\]]+)\]\[([^\]]+)\]/);
                
                if (matches) {
                    const [, arrayName, index, propName] = matches;
                    
                    if (!data[arrayName]) data[arrayName] = [];
                    if (!data[arrayName][index]) data[arrayName][index] = {};
                    
                    data[arrayName][index][propName] = value;
                } else {
                    data[key] = value;
                }
            } else {
                data[key] = value;
            }
        });
        
        // Clean up the assets array
        if (data.assets) {
            data.assets = Object.values(data.assets);
        }
        
        // Send update to the server
        fetch(`/api/esc/workstation/${workstationId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Refresh the workstation details
                showWorkstationDetails(workstationId);
                
                // Update workstation colors
                updateWorkstationStatus();
                
                // Show success message
                alert('Workstation updated successfully!');
            } else {
                alert('Error updating workstation: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error updating workstation:', error);
            alert('Failed to update workstation. Please try again.');
        });
    });
    
    // Confirm transfer button
    document.getElementById('confirmTransferBtn').addEventListener('click', function() {
        const sourceWorkstationId = document.getElementById('workstation_id').value;
        const destinationWorkstationId = document.getElementById('transferDestination').value;
        
        if (!destinationWorkstationId) {
            alert('Please select a destination workstation.');
            return;
        }
        
        // Send transfer request to server
        fetch('/api/esc/workstation/transfer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                source_id: sourceWorkstationId,
                destination_id: destinationWorkstationId
            })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Close the modal
                bootstrap.Modal.getInstance(document.getElementById('workstationModal')).hide();
                
                // Update workstation colors
                updateWorkstationStatus();
                
                // Show success message
                alert(`Successfully transferred from ${sourceWorkstationId} to ${destinationWorkstationId}`);
            } else {
                alert('Error transferring workstation: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error transferring workstation:', error);
            alert('Failed to transfer workstation. Please try again.');
        });
    });
}
