<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Device;
use App\Models\Workstation;

class WorkspaceController extends Controller
{
    /**
     * Get workstation data
     */
    public function getWorkstation($id)
    {
        // In a real app, you'd fetch this data from your database
        // For now, we'll return mock data
        
        // Find workstation
        $workstation = Workstation::with(['employee', 'devices'])->where('code', $id)->first();
        
        if (!$workstation) {
            // Return mock data for testing if not found
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
        
        return response()->json($workstation);
    }
    
    /**
     * Get server data
     */
    public function getServer($id)
    {
        // Mock data for now
        return response()->json([
            'id' => $id,
            'name' => "Server $id",
            'specs' => 'Dell PowerEdge R740, 64GB RAM, 2TB Storage',
            'status' => 'Active'
        ]);
    }
    
    /**
     * Get boardroom data
     */
    public function getBoardroom($id)
    {
        // Mock data for now
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
}