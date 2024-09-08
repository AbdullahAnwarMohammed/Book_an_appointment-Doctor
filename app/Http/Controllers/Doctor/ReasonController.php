<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Reason;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Reasons = Reason::orderBy('position','asc')->get();

        return view("doctor.reasons.index",compact('Reasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("doctor.reasons.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:reasons,name'
        ]);

        Reason::create([
            'name' => $request->name,
        ]);
        
        return redirect()->route('doctor.reasons.index')->with('Success','تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reason = Reason::where('id',$id)->first();
        return view('doctor.reasons.edit',compact('reason'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Reason::where('id',$id)->update([
            'name' => $request->name
        ]);
        return redirect()->route('doctor.reasons.index')->with('Success','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Reason::where('id',$id)->delete();
        return redirect()->route('doctor.reasons.index')->with('Success','تم الحذف بنجاح');
    }


    public function updateOrder(Request $request){
        $order = $request->input('order');
    
        foreach ($order as $index => $id) {
            Reason::where('id', $id)->update(['position' => $index + 1]);
        }
    
        return response()->json(['status' => 'success']);
    }
}
