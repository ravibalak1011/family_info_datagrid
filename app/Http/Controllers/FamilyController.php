<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\State;
use App\Models\City;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::with(['state', 'city'])->withCount('members')->get();
        return view('families.index', compact('families'));
    }



    public function create()
    {
        $states = State::all();
        return view('families.create', compact('states'));
    }

    public function store(Request $request)
    {
        //echo "<pre>";print_r($request->all());die;

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date|before:-21 years',
            'mobile_no' => 'required|numeric|digits_between:1,14',
            'address' => 'required|string|max:255',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'pincode' => 'required|numeric',
            'marital_status' => 'required|string|in:Married,Unmarried',
            'wedding_date' => 'nullable|date|required_if:marital_status,Married',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $hobbies = $request->input('hobbies') ? json_encode($request->input('hobbies')) : null;

        Family::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'birthdate' => $request->input('birthdate'),
            'mobile_no' => $request->input('mobile_no'),
            'address' => $request->input('address'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'marital_status' => $request->input('marital_status'),
            'wedding_date' => $request->input('wedding_date'),
            'hobbies' => $hobbies,
            'photo' => $photoPath,
        ]);

        return redirect()->route('families.index')->with('success', 'Family added successfully.');
    }

    public function show(Family $family)
    {
        $family->load('members');
        return view('families.show', compact('family'));
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    public function destroy(Family $family){
        $family->delete();
        return redirect()->route('families.index')->with('success', 'Family deleted successfully.');
    }

    public function edit(Family $family)
    {
        $states = State::all();
        $cities = City::where('state_id', $family->state)->get();
        $hobbies = json_decode($family->hobbies, true);
        return view('families.edit', compact('family', 'states', 'cities', 'hobbies'));
    }


    public function update(Request $request, Family $family)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date|before:-21 years',
            'mobile_no' => 'required|numeric|digits_between:1,14',
            'address' => 'required|string|max:255',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'pincode' => 'required|numeric',
            'marital_status' => 'required|string|in:Married,Unmarried',
            'wedding_date' => 'nullable|date|required_if:marital_status,Married',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = $family->photo;
        if ($request->hasFile('photo')) {
            if ($photoPath) {
                \Storage::delete('public/' . $photoPath);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $hobbies = $request->input('hobbies') ? json_encode($request->input('hobbies')) : null;

        $family->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'birthdate' => $request->input('birthdate'),
            'mobile_no' => $request->input('mobile_no'),
            'address' => $request->input('address'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'marital_status' => $request->input('marital_status'),
            'wedding_date' => $request->input('wedding_date'),
            'hobbies' => $hobbies,
            'photo' => $photoPath,
        ]);

        return redirect()->route('families.index')->with('success', 'Family updated successfully.');
    }
}