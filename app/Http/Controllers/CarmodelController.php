<?php

namespace App\Http\Controllers;

use App\Models\Carmodel;
use Illuminate\Http\Request;

class CarmodelController extends Controller
{
    public function index()
    {
        return Carmodel::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'brand_id' => ['required', 'exists:brands,id'],
        ]);

        return Carmodel::create($data);
    }

    public function show(Carmodel $carmodel)
    {
        return $carmodel;
    }

    public function update(Request $request, Carmodel $carmodel)
    {
        $data = $request->validate([
            'name' => ['required'],
            'brand_id' => ['required', 'exists:brands,id'],
        ]);

        $carmodel->update($data);

        return $carmodel;
    }

    public function destroy(Carmodel $carmodel)
    {
        $carmodel->delete();

        return response()->json();
    }
}
