<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $amenity_count = Amenity::count();
        $data = Amenity::orderBy('id','DESC')->paginate(5);

        return view('amenities.index',compact('data','amenity_count'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('amenities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $input = $request->all();
    
        $amenity = Amenity::create($input);
    
        return redirect()->route('amenities.index')
                        ->with('success','Amenity created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $amenity = Amenity::find($id);

        return view('amenities.show', compact('amenity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amenity = Amenity::find($id);
    
        return view('amenities.edit',compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $input = $request->all();
        
        $amenity = Amenity::find($id);
        $amenity->update($input);
    
        return redirect()->route('amenities.index')
                        ->with('success','Amenity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Amenity::find($id)->delete();
        return redirect()->route('amenities.index')
                        ->with('success', 'Amenity deleted successfully');
    }
}
