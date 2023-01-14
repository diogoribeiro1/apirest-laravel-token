<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dog;
use Laravel\Sanctum\Events\TokenAuthenticated;

class DogController extends Controller
{

    public function index()
    {
        $dog = Dog::get()->toJson(JSON_PRETTY_PRINT);
        return response($dog, 200);
        //        return Dog::all();
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $dog = new Dog();
        $dog->name = $request->name;
        $dog->raca = $request->raca;
        $dog->created_by = $user->id;
        try {

            $dog->save();
            //Dog::create($request->all());

        } catch (\Throwable $th) {
            return response()->json([
                "message" => "something is incorrect!"
            ], 400);
        }

        return response()->json(["message" => "dog record created by " . $user->name, 'dog' => $dog], 201);
    }

    public function show($id)
    {
        if (Dog::where('id', $id)->exists()) {
            $dog = Dog::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($dog, 200);
        } else {
            return response()->json([
                "message" => "Dog not found"
            ], 404);
        }
        //        return Dog::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        //        $dog = Dog::findOrFail($id);
//        return $dog->update($request->all());
        if (Dog::where('id', $id)->exists()) {
            $dog = Dog::find($id);
            $dog->name = is_null($request->name) ? $dog->name : $request->name;
            $dog->raca = is_null($request->raca) ? $dog->raca : $request->raca;
            $dog->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Dog not found"
            ], 404);
        }
    }

    public function destroy($id)
    {
        if (Dog::where('id', $id)->exists()) {
            $dog = Dog::find($id);
            $dog->delete();

            return response()->json([
                "message" => "records deleted"
            ], 204);
        } else {
            return response()->json([
                "message" => "Dog not found"
            ], 404);
        }
        //        $dog = Dog::findOrFail($id);
//        return $dog->delete();
    }

    public function search($name)
    {
        return Dog::where('name', 'like', '%' . $name . '%')->get();
    }

}