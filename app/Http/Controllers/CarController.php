<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return Car::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'carmodel_id' => ['required', 'exists:carmodels,id'],
        ]);

        return Car::create($data);
    }

    public function show(Car $car)
    {
        return $car;
    }

    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'carmodel_id' => ['required', 'exists:carmodels,id'],
        ]);

        $car->update($data);

        return $car;
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json();
    }
}
