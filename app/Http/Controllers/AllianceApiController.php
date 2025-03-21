<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllianceApiController extends Controller
{
    /**
     * Get workstation details
     */
    public function getWorkstationDetails($id)
    {
        // Return mock data for now
        return response()->json([
            'id' => $id,
            'employee' => [
                'id' => 1,
                'name' => 'John Doe',
                'position' => 'Software Developer'
            ],
            'devices' => [
                ['type' => 'Monitor', 'model' => 'Dell P2419H', 'serial' => 'ABC123'],
                ['type' => 'Monitor', 'model' => 'Dell P2419H', 'serial' => 'DEF456'],
                ['type' => 'Keyboard', 'model' => 'Logitech K120', 'serial' => 'KBD789'],
                ['type' => 'Mouse', 'model' => 'Logitech M100', 'serial' => 'MOU012'],
                ['type' => 'System Unit', 'model' => 'Dell OptiPlex 7050', 'serial' => 'SYS345'],
                ['type' => 'Headset', 'model' => 'Jabra Evolve 20', 'serial' => 'HDS678']
            ]
        ]);
    }

    /**
     * Get server details
     */
    public function getServerDetails($id)
    {
        return response()->json([
            'id' => $id,
            'name' => "Server $id",
            'specs' => 'Dell PowerEdge R740, 64GB RAM, 2TB Storage',
            'status' => 'Active'
        ]);
    }

    /**
     * Get boardroom details
     */
    public function getBoardroomDetails($id)
    {
        return response()->json([
            'id' => $id,
            'name' => 'Main Conference Room',
            'capacity' => 12,
            'equipment' => [
                ['type' => 'Projector', 'model' => 'Epson EB-2250U'],
                ['type' => 'Conference System', 'model' => 'Polycom RealPresence']
            ]
        ]);
    }

    /**
     * Get all workstations for status display
     */
    public function getAllWorkstations()
    {
        // Mock data for all workstations
        $workstations = [];
        
        // Generate sample workstations
        for ($i = 1; $i <= 87; $i++) {
            $id = 'WSM' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $workstations[] = [
                'id' => $id,
                'status' => rand(0, 2) // 0: unassigned, 1: available, 2: complete
            ];
        }
        
        return response()->json($workstations);
    }

    /**
     * Add a device to a workstation
     */
    public function addDeviceToWorkstation(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'workstation_id' => 'required|string',
            'device_type' => 'required|string',
            'device_model' => 'required|string',
            'device_serial' => 'required|string'
        ]);
        
        // In a real app, you would add to the database here
        
        return response()->json([
            'success' => true,
            'message' => 'Device added successfully',
            'data' => $validated
        ]);
    }
}