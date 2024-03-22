<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // supplier
    public function supplier()
    {
        $suppliers = Supplier::all();
        return view('admin.inventory.supplier.supplier', compact('suppliers'));
    }

    // supplier
    public function add_supplier()
    {
        return view('admin.inventory.supplier.addSupplier');
    }
    //Store Supplier
    public function store_supplier(Request $request)
    {
        $validated = $request->validate([
            'name' => "required",
            'contact_number' => "required",
            'email' => "required",
            'address' => "required",
        ]);
        Supplier::create($validated);
        return response()->json(['message' => 'Registration successful'], 200);
    }

    // edit  supplier
    public function edit_supplier($id)
    {
        $suppliers = Supplier::findOrFail($id);
        return view('admin.inventory.supplier.editSupplier', ["suppliers" => $suppliers]);
    }

    public function update_supplier(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => "required",
            'contact_number' => "required",
            'email' => "required",
            'address' => "required",
        ]);
        $supplier->update($validated);
        return redirect()->route('admin.supplier')->with('success', true);
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
