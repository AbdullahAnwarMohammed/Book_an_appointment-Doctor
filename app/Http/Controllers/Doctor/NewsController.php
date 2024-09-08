<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $News = News::orderBy('position','asc')->get();
        return view("doctor.news.index",compact('News'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("doctor.news.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['text' => 'required']);

        News::create([
            'text' => $request->text,
            'status' => $request->status
        ]);

        return redirect()->route('doctor.news.index')->with('Success','تم الاضافة بنجاح');
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
        $News = News::where('id',$id)->first();
        return view("doctor.news.edit",compact('News'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        News::where('id',$id)->update([
            'text' => $request->text,
            'status' => $request->status
        ]);

        return redirect()->back()->with('Success','تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        News::where('id',$id)->delete();
        return redirect()->route('doctor.news.index')->with('Success','تم الحذف بنجاح');
    }

    public function updateOrder(Request $request){
        $order = $request->input('order');
    
        foreach ($order as $index => $id) {
            News::where('id', $id)->update(['position' => $index + 1]);
        }
    
        return response()->json(['status' => 'success']);
    }

}
