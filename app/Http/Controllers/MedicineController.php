<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    public function medicine_index(Request $request)
    {
        // Retrieve all medicines from the database

        $medicines = Medicine::all();

        return view('admin.inventory.medicine.medicine', compact('medicines'));
    }


    public function add_medicine()
    {
        return view('admin.inventory.medicine.addMedicine');
    }

    public function getSuppliers()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    public function store_medicine(Request $request)
    {
        $validated = $request->validate([
            'name' => "required",
            'generic_name' => "required",
            'dosage' => "required",
            'medicine_types' => "required",
            'supplier_id' => "required",
            'description' => "required",
        ]);
        $medicine = new Medicine();
        $medicine->fill($validated);
        $medicine->save();

        return response()->json(['message' => 'Registration successful'], 200);
    }

    public function edit_medicine($id)
    {
        $medicines = Medicine::findOrFail($id);
        return view('admin.inventory.medicine.editMedicine', ["medicines" => $medicines]);
    }

    public function update_medicines(Request $request, Medicine $medicine)
    {
        $validated = $request->validate([
            'name' => "required",
            'generic_name' => "required",
            'dosage' => "required",
            'medicine_types' => "required",
            'supplier_id' => "required", // Ensure the request includes supplier_id
            'description' => "required",
        ]);
        $medicine->update($validated);
        return redirect()->route('admin.medicine')->with('success', true);
    }

    public function destroy($modelName, $id)
    {
        $modelClass = "App\\Models\\" . ucfirst($modelName);

        // Check if the model class exists
        if (!class_exists($modelClass)) {
            return response()->json([
                'status' => 404,
                'message' => 'Model not found!'
            ], 404);
        }

        $model = $modelClass::find($id);

        // Check if the model instance exists
        if (!$model) {
            return response()->json([
                'status' => 404,
                'message' => 'Record not found!'
            ], 404);
        }

        $model->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted successfully!'
        ]);
    }
}
