<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    public function create(Family $family)
    {
        return view('family_members.create', compact('family'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'family_id' => 'required|exists:families,id',
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'marital_status' => 'required|string|in:Married,Unmarried',
            'wedding_date' => $request->input('marital_status') == 'Married' ? 'nullable|date' : '',
            'education' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $family = Family::find($request->family_id);

        $member = $family->members()->create([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status,
            'wedding_date' => $request->wedding_date,
            'education' => $request->education,
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('family_member_photos','public');
            $member->photo = $photoPath;
            $member->save();
        }

        return redirect()->route('families.show', ['family' => $request->family_id])->with('success', 'Family member added successfully.');
    }
    

    public function destroy(FamilyMember $family_member)
    {
        $family_member->delete();
        return redirect()->back()->with('success', 'Family member deleted successfully.');
    }

    public function edit(FamilyMember $family_member)
    {
        return view('family_members.edit', compact('family_member'));
    }

    public function update(Request $request, FamilyMember $family_member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'marital_status' => 'required|string|in:Married,Unmarried',
            'wedding_date' => $request->input('marital_status') == 'Married' ? 'nullable|date' : '',
            'education' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = $family_member->photo;
        if ($request->hasFile('photo')) {
            if ($photoPath) {
                \Storage::delete('public/' . $photoPath);
            }
            $photoPath = $request->file('photo')->store('family_member_photos', 'public');
        }

        $family_member->update([
            'name' => $request->name,
            'birthdate' => $request->birthdate,
            'marital_status' => $request->marital_status,
            'wedding_date' => $request->marital_status === 'Married' ? $request->wedding_date : null,
            'education' => $request->education,
            'photo' => $photoPath,
        ]);

        return redirect()->route('families.show', $family_member->family_id)->with('success', 'Family member updated successfully.');
    }
    
    
}