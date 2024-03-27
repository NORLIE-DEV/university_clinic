<?php

namespace App\Http\Controllers;

use App\Models\Medicine;

use Illuminate\Http\Request;
use App\Models\Medicinestock;

class MedicineStockController extends Controller
{
    public function medicine_stock_index(Request $request)
    {
        // Retrieve all medicines from the database
        $medicine_stocks = Medicinestock::all();
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
        $medicineStock = new Medicinestock();
        $medicineStock->fill($validated);
        $medicineStock->save();
        return response()->json(['message' => 'Registration successful'], 200);
    }

    public function edit_medicineStock($id)
    {
        $medicinesStocks = Medicinestock::findOrFail($id);
        return view('admin.inventory.medicine_stock.editMedicineStocks', ["medicinesStocks" => $medicinesStocks]);
    }


    public function update_medicineStocks(Request $request, $id)
    {
        $validated = $request->validate([
            'medicine_id' => 'required',
            'batch_id' => 'required',
            'date_recieve' => 'required',
            'expiration_date' => 'required',
            'quantity' => 'required',
        ]);
        //dd($medicineStock);
        $medicineStock = Medicinestock::findOrFail($id);
        $medicineStock->update($validated);

        return redirect()->route('admin.medicine_stock')->with('success', true);
    }
}
