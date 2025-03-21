// Save this as public/js/svg-debug.js

document.addEventListener('DOMContentLoaded', function() {
    console.log('===== SVG DEBUG TOOL =====');
    console.log('Checking for SVG element...');
    
    const svgObject = document.getElementById('floorPlanSVG');
    if (!svgObject) {
        console.error('❌ SVG object not found in DOM!');
        
        // List all objects to see if ID might be different
        const objects = document.querySelectorAll('object');
        console.log(`Found ${objects.length} object elements in DOM:`);
        objects.forEach((obj, i) => {
            console.log(`Object ${i+1}:`, obj.id, obj.data);
        });
        return;
    }
    
    console.log('✅ SVG object found:', svgObject);
    console.log('Data attribute:', svgObject.getAttribute('data'));
    
    // Try directly appending an event to SVG object
    svgObject.style.border = '2px solid red';
    svgObject.addEventListener('click', function() {
        console.log('SVG object clicked!');
    });
    
    // Add a message when loading starts
    console.log('Waiting for SVG to load...');
    
    // Set a timeout to check if load event never fires
    const timeout = setTimeout(() => {
        console.error('❌ SVG load event did not fire after 5 seconds!');
        console.log('Trying to access contentDocument anyway...');
        tryAccessSvg();
    }, 5000);
    
    // Listen for the load event
    svgObject.addEventListener('load', function() {
        console.log('✅ SVG load event fired!');
        clearTimeout(timeout);
        tryAccessSvg();
    });
    
    function tryAccessSvg() {
        try {
            const svgDoc = svgObject.contentDocument;
            if (!svgDoc) {
                console.error('❌ SVG contentDocument is null!');
                console.log('This might be due to CORS policy if the SVG is loaded from a different domain.');
                return;
            }
            
            console.log('✅ Successfully accessed SVG contentDocument');
            
            // Analyze SVG structure
            console.log('SVG document element:', svgDoc.documentElement.tagName);
            
            // Check for g elements with data-cell-id
            const cellElements = svgDoc.querySelectorAll('[data-cell-id]');
            console.log(`Found ${cellElements.length} elements with data-cell-id attributes`);
            
            // Group by prefix to identify workstations, servers, etc.
            const elementsByPrefix = {};
            cellElements.forEach(el => {
                const id = el.getAttribute('data-cell-id');
                const prefix = id.substring(0, 3);
                if (!elementsByPrefix[prefix]) {
                    elementsByPrefix[prefix] = [];
                }
                elementsByPrefix[prefix].push(id);
            });
            
            console.log('Elements grouped by prefix:');
            for (const prefix in elementsByPrefix) {
                console.log(`- ${prefix}: ${elementsByPrefix[prefix].length} elements`);
            }
            
            // Test clicking on a workstation
            const firstWorkstation = svgDoc.querySelector('[data-cell-id^="WSM"]');
            if (firstWorkstation) {
                console.log('✅ Found a workstation element:', firstWorkstation.getAttribute('data-cell-id'));
                console.log('Element tag name:', firstWorkstation.tagName);
                console.log('Testing click interaction...');
                
                // Make it visually stand out
                const rectInWorkstation = firstWorkstation.querySelector('rect');
                if (rectInWorkstation) {
                    const originalFill = rectInWorkstation.getAttribute('fill');
                    rectInWorkstation.setAttribute('fill', '#FF0000');
                    rectInWorkstation.style.cursor = 'pointer';
                    
                    // Add a direct click handler for testing
                    rectInWorkstation.addEventListener('click', function(e) {
                        console.log('✅ Rectangle clicked directly!');
                        // Restore original color after 500ms
                        setTimeout(() => {
                            rectInWorkstation.setAttribute('fill', originalFill);
                        }, 500);
                        e.stopPropagation();
                    });
                }
                
                // Add a click handler to the group element
                firstWorkstation.addEventListener('click', function(e) {
                    console.log('✅ Workstation group element clicked!');
                    e.stopPropagation();
                });
            } else {
                console.error('❌ No workstation elements found with data-cell-id starting with "WSM"');
            }
            
            // Check pointer-events attributes
            const elements = svgDoc.querySelectorAll('*');
            const pointerEventsValues = {};
            elements.forEach(el => {
                const value = el.getAttribute('pointer-events') || 
                             window.getComputedStyle(el).pointerEvents || 
                             'not-set';
                             
                if (!pointerEventsValues[value]) {
                    pointerEventsValues[value] = 0;
                }
                pointerEventsValues[value]++;
            });
            
            console.log('Pointer-events values in SVG:');
            for (const value in pointerEventsValues) {
                console.log(`- ${value}: ${pointerEventsValues[value]} elements`);
            }
            
            // Add a click handler to the entire SVG
            svgDoc.documentElement.addEventListener('click', function(e) {
                console.log('SVG document clicked at coordinates:', e.clientX, e.clientY);
                
                // Find what was clicked
                const element = document.elementFromPoint(e.clientX, e.clientY);
                console.log('Element at click position:', element);
                
                // Check if we've clicked on an SVG element
                if (element && element.ownerSVGElement) {
                    console.log('Clicked on an SVG element:', element.tagName);
                    
                    // Find the nearest parent with data-cell-id
                    let current = element;
                    while (current && !current.getAttribute('data-cell-id')) {
                        current = current.parentElement;
                    }
                    
                    if (current) {
                        console.log('Found parent with data-cell-id:', current.getAttribute('data-cell-id'));
                    }
                }
            });
            
            console.log('===== DEBUG SETUP COMPLETE =====');
            console.log('Try clicking on the floorplan elements');
            
        } catch (e) {
            console.error('Error during SVG analysis:', e);
        }
    }
});