<?php
// File: app/Http/Controllers/EscApiController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // If using database
use Illuminate\Support\Facades\Log;

class EscApiController extends Controller
{
    /**
     * Get all workstations with their status
     */
    public function getAllWorkstations()
    {
        // In a production environment, fetch this from database
        // For this demonstration, we'll generate mock data for all workstations
        $workstations = [];
        
        // Generate workstation data for all workstations (WSM001 to WSM064)
        for ($i = 1; $i <= 64; $i++) {
            $id = 'WSM' . str_pad($i, 3, '0', STR_PAD_LEFT);
            
            // Randomly assign status for demonstration
            $status = (rand(0, 1) == 1) ? 'Occupied' : 'Vacant';
            
            $workstations[] = [
                'workstation_id' => $id,
                'status' => $status
            ];
        }
        
        return response()->json($workstations);
    }
    
    /**
     * Get workstation statuses for color coding
     */
    public function getWorkstationStatuses()
    {
        // In a production environment, fetch this from database
        // For this demonstration, we'll generate mock data
        $statuses = [];
        
        // Generate status data for all workstations (WSM001 to WSM064)
        for ($i = 1; $i <= 64; $i++) {
            $id = 'WSM' . str_pad($i, 3, '0', STR_PAD_LEFT);
            
            // Randomly assign status for demonstration
            $status = (rand(0, 1) == 1) ? 'Occupied' : 'Vacant';
            
            $statuses[] = [
                'workstation_id' => $id,
                'status' => $status
            ];
        }
        
        return response()->json($statuses);
    }

    /**
     * Get workstation details
     */
    public function getWorkstationDetails($id)
    {
        // In a real implementation, you would fetch this data from your database
        // This is a mock response for demonstration purposes
        
        // Sample data structure with expanded asset details
        $workstations = [
            'WSM001' => [
                'workstation_id' => 'WSM001',
                'status' => 'Occupied',
                'employee_name' => 'John Doe',
                'position' => 'Software Developer',
                'assets' => [
                    [
                        'name' => 'Monitor 1',
                        'asset_id' => 'MANILA-MON-001',
                        'category' => 'Monitor',
                        'model' => 'Dell U2419H',
                        'manufacturer' => 'Dell',
                        'serial_number' => 'CN12345678'
                    ],
                    [
                        'name' => 'Monitor 2',
                        'asset_id' => 'MANILA-MON-002',
                        'category' => 'Monitor',
                        'model' => 'Dell U2419H',
                        'manufacturer' => 'Dell',
                        'serial_number' => 'CN87654321'
                    ],
                    [
                        'name' => 'System Unit',
                        'asset_id' => 'MANILA-PC-001',
                        'category' => 'Computer',
                        'model' => 'OptiPlex 7070',
                        'manufacturer' => 'Dell',
                        'serial_number' => 'SYS12345678'
                    ],
                    [
                        'name' => 'Mouse',
                        'asset_id' => 'MANILA-MSE-001',
                        'category' => 'Peripheral',
                        'model' => 'Logitech MX Master 3',
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Keyboard',
                        'asset_id' => 'MANILA-KB-001',
                        'category' => 'Peripheral',
                        'model' => 'Logitech MX Keys',
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Headset',
                        'asset_id' => 'MANILA-HS-001',
                        'category' => 'Audio',
                        'model' => 'Jabra Evolve 75',
                        'manufacturer' => 'Jabra',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Webcam',
                        'asset_id' => 'MANILA-WB-001',
                        'category' => 'Peripheral',
                        'model' => 'Logitech C920',
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Telephone',
                        'asset_id' => 'MANILA-TEL-001',
                        'category' => 'Communication',
                        'model' => 'Cisco IP Phone 8800',
                        'manufacturer' => 'Cisco',
                        'serial_number' => null
                    ]
                ]
            ],
            'WSM002' => [
                'workstation_id' => 'WSM002',
                'status' => 'Occupied',
                'employee_name' => 'Jane Smith',
                'position' => 'UI/UX Designer',
                'assets' => [
                    [
                        'name' => 'Monitor 1',
                        'asset_id' => 'MANILA-MON-003',
                        'category' => 'Monitor',
                        'model' => 'Dell U2719D',
                        'manufacturer' => 'Dell',
                        'serial_number' => 'CN23456789'
                    ],
                    [
                        'name' => 'Monitor 2',
                        'asset_id' => 'MANILA-MON-004',
                        'category' => 'Monitor',
                        'model' => 'Dell U2719D',
                        'manufacturer' => 'Dell',
                        'serial_number' => 'CN98765432'
                    ],
                    [
                        'name' => 'System Unit',
                        'asset_id' => 'MANILA-PC-002',
                        'category' => 'Computer',
                        'model' => 'OptiPlex 7070',
                        'manufacturer' => 'Dell',
                        'serial_number' => 'SYS23456789'
                    ],
                    [
                        'name' => 'Mouse',
                        'asset_id' => 'MANILA-MSE-002',
                        'category' => 'Peripheral',
                        'model' => 'Logitech MX Master 3',
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Keyboard',
                        'asset_id' => 'MANILA-KB-002',
                        'category' => 'Peripheral',
                        'model' => 'Logitech MX Keys',
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Headset',
                        'asset_id' => 'MANILA-HS-002',
                        'category' => 'Audio',
                        'model' => 'Jabra Evolve 75',
                        'manufacturer' => 'Jabra',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Webcam',
                        'asset_id' => 'MANILA-WB-002',
                        'category' => 'Peripheral',
                        'model' => 'Logitech C920',
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Telephone',
                        'asset_id' => 'MANILA-TEL-002',
                        'category' => 'Communication',
                        'model' => 'Cisco IP Phone 8800',
                        'manufacturer' => 'Cisco',
                        'serial_number' => null
                    ]
                ]
            ]
        ];
        
        // Check if the requested workstation exists in our data
        if (isset($workstations[$id])) {
            return response()->json($workstations[$id]);
        } else {
            // Create a generic response if the specific workstation is not in our sample data
            // 50% chance the workstation is vacant
            $isVacant = (rand(0, 1) == 0);
            
            $workstation = [
                'workstation_id' => $id,
                'status' => $isVacant ? 'Vacant' : 'Occupied',
            ];
            
            if (!$isVacant) {
                // If workstation is occupied, generate employee data
                $firstNames = ['Alex', 'Sam', 'Chris', 'Taylor', 'Jordan', 'Casey', 'Avery'];
                $lastNames = ['Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis'];
                $positions = ['Software Engineer', 'Data Analyst', 'Product Manager', 'QA Tester', 'System Administrator', 'Network Engineer', 'DevOps Engineer'];
                
                $workstation['employee_name'] = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
                $workstation['position'] = $positions[array_rand($positions)];
                
                // Generate asset data for the workstation
                $workstation['assets'] = [
                    [
                        'name' => 'Monitor 1',
                        'asset_id' => 'MANILA-MON-' . rand(100, 999),
                        'category' => 'Monitor',
                        'model' => 'Dell U' . rand(20, 27) . '19' . ['D', 'H'][rand(0, 1)],
                        'manufacturer' => 'Dell',
                        'serial_number' => 'CN' . rand(10000000, 99999999)
                    ],
                    [
                        'name' => 'Monitor 2',
                        'asset_id' => 'MANILA-MON-' . rand(100, 999),
                        'category' => 'Monitor',
                        'model' => 'Dell U' . rand(20, 27) . '19' . ['D', 'H'][rand(0, 1)],
                        'manufacturer' => 'Dell',
                        'serial_number' => 'CN' . rand(10000000, 99999999)
                    ],
                    [
                        'name' => 'System Unit',
                        'asset_id' => 'MANILA-PC-' . rand(100, 999),
                        'category' => 'Computer',
                        'model' => 'OptiPlex ' . rand(3050, 7090),
                        'manufacturer' => 'Dell',
                        'serial_number' => 'SYS' . rand(10000000, 99999999)
                    ],
                    [
                        'name' => 'Mouse',
                        'asset_id' => 'MANILA-MSE-' . rand(100, 999),
                        'category' => 'Peripheral',
                        'model' => 'Logitech ' . ['M' . rand(100, 999), 'MX Master ' . rand(1, 3)][rand(0, 1)],
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Keyboard',
                        'asset_id' => 'MANILA-KB-' . rand(100, 999),
                        'category' => 'Peripheral',
                        'model' => 'Logitech ' . ['K' . rand(100, 999), 'MX Keys'][rand(0, 1)],
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Headset',
                        'asset_id' => 'MANILA-HS-' . rand(100, 999),
                        'category' => 'Audio',
                        'model' => ['Jabra Evolve ' . rand(20, 85), 'Plantronics Voyager ' . rand(4000, 5000)][rand(0, 1)],
                        'manufacturer' => ['Jabra', 'Plantronics'][rand(0, 1)],
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Webcam',
                        'asset_id' => 'MANILA-WB-' . rand(100, 999),
                        'category' => 'Peripheral',
                        'model' => 'Logitech C' . [920, 922, 930][rand(0, 2)],
                        'manufacturer' => 'Logitech',
                        'serial_number' => null
                    ],
                    [
                        'name' => 'Telephone',
                        'asset_id' => 'MANILA-TEL-' . rand(100, 999),
                        'category' => 'Communication',
                        'model' => 'Cisco IP Phone ' . [7800, 8800, 9000][rand(0, 2)],
                        'manufacturer' => 'Cisco',
                        'serial_number' => null
                    ]
                ];
            } else {
                // If vacant, no employee or assets assigned
                $workstation['employee_name'] = null;
                $workstation['position'] = null;
                $workstation['assets'] = [];
            }
            
            return response()->json($workstation);
        }
    }
    
    /**
     * Update workstation details
     */
    public function updateWorkstation(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'employee_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'assets' => 'nullable|array',
            'assets.*.type' => 'required|string',
            'assets.*.asset_id' => 'required|string',
            'assets.*.category' => 'nullable|string',
            'assets.*.manufacturer' => 'nullable|string',
            'assets.*.model' => 'nullable|string',
            'assets.*.serial_number' => 'nullable|string',
        ]);
        
        // In a real application, you would update the database here
        // For this demo, we'll just return success
        
        // Determine the new status based on employee assignment
        $status = !empty($request->employee_name) ? 'Occupied' : 'Vacant';
        
        // Log the update for debugging
        Log::info('Workstation update', [
            'workstation_id' => $id,
            'status' => $status,
            'data' => $request->all()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Workstation updated successfully',
            'workstation_id' => $id,
            'status' => $status
        ]);
    }
    
    /**
     * Transfer employee and assets between workstations
     */
    public function transferWorkstation(Request $request)
    {
        // Validate the request data
        $request->validate([
            'source_id' => 'required|string',
            'destination_id' => 'required|string|different:source_id',
        ]);
        
        // In a real application, you would:
        // 1. Check if source workstation exists and is occupied
        // 2. Check if destination workstation exists and is vacant
        // 3. Move employee and assets data from source to destination
        // 4. Update status of both workstations
        
        // For this demo, we'll just return success
        Log::info('Workstation transfer', [
            'source' => $request->source_id,
            'destination' => $request->destination_id
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Transfer completed successfully',
            'source_id' => $request->source_id,
            'destination_id' => $request->destination_id
        ]);
    }

}

