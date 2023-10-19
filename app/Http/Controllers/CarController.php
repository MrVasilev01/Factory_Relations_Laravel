<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){
        $cars = Car::orderBy('id', 'desc')->get();

        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    public function create(){

        return view('cars.manage');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'color' => 'required',
        ]);

        $car = new Car();

        $car->name = $request->name;
        $car->model = strtolower($request->model);
        $car->color = strtolower($request->color);
        $car->save();
        return redirect()->route('admincars.index')->with('success', 'Car created successfully.');

    }

    public function edit($id){

        $car = Car::find($id);

        return view('cars.manage',[
            'car' => $car,
        ]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'model' => 'required'.$id,
            'color' => 'required'.$id,
            // 'password_confirmation' => 'required|same:password',
        ]);

        $car = car::find($id);

        $car->name = $request->name;
        $car->model = $request->model;
        $car->color = $request->color;

        $car->save();

        return redirect()->route('admincars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
