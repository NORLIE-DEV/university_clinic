<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Medicinestock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class NurseAdminController extends Controller
{
    public function admin_index()
    {
        return view('admin.admin_index');
    }

    // inventory index
    public function index_inventory()
    {
        $medicineCounts = Medicine::count();
        $supplierCounts = Supplier::count();
        $medicinestocksCounts = Medicinestock::count();
        return view('admin.inventory.inventory_index', compact('medicineCounts','supplierCounts','medicinestocksCounts'));
    }



}
