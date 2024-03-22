<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineStock;
use Illuminate\Http\Request;

class MedicineStockController extends Controller
{
    public function medicine_stock_index(Request $request)
    {
        // Retrieve all medicines from the database
        $medicine_stocks = MedicineStock::all();
        return view('admin.inventory.medicine_stock.medicine_stock', compact('medicine_stocks'));
    }

    public function add_medicine_stock()
    {
        return view('admin.inventory.medicine_stock.addMedicineStock');
    }

    public function getMedicine()
    {
        $medicines = Medicine::all();
        return response()->json($medicines);
    }

    public function store_medicineStocks(Request $request)
    {
        $validated = $request->validate([
            'medicine_id' => 'required',
            'batch_id' => 'required',
            'date_recieve' => 'required',
            'expiration_date' => 'required',
            'quantity' => 'required',
        ]);
        $medicineStock = new MedicineStock();
        $medicineStock->fill($validated);
        $medicineStock->save();
        return response()->json(['message' => 'Registration successful'], 200);
    }

    public function update_medicineStocks(Request $request, MedicineStock $medicineStock)
    {
        $validated = $request->validate([
            'name' => "required",
            'generic_name' => "required",
            'dosage' => "required",
            'medicine_types' => "required",
            'supplier_id' => "required", // Ensure the request includes supplier_id
            'description' => "required",
        ]);
        $medicineStock->update($validated);
        return redirect()->route('admin.medicine')->with('success', true);
    }
}
