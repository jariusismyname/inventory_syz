<?php

namespace App\Http\Controllers;

use App\Models\Inventory; // Make sure you have an Inventory model
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        // Fetch all data from the inventories table
        $inventories = Inventory::all(); 

        // Pass the data to the view
        return view('admin-dashboard', compact('inventories'));
    }
}
