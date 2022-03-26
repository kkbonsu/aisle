<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $property_count = Property::count();
        $data = Property::orderBy('id','DESC')->paginate(5);
        return view('properties.index',compact('data','property_count'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        $options = Option::all();
        $amenities = Amenity::all();

        return view('properties.create',compact('types', 'categories', 'amenities', 'options'));
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
        $validator = Validator::make($request->all(), [
            'file' => 'max:300',
        ]);
    
        $property = Property::create($input);

        if ($request->hasFile('photo_id')) {
            $files = $request->file('photo_id');
            foreach ($files as $file) {
                $name = time().'-'.$file->getClientOriginalName();
                $name = str_replace(' ', '-', $name);
                $file->move('property_pictures', $name);
                $property->pictures()->create(['name' => $name]);
            }
        }
    
        return redirect()->route('properties.index')
                        ->with('success','Property created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::find($id);
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::find($id);
        $categories = Category::all();
        $types = Type::all();
        $options = Option::all();
        $amenities = Amenity::all();
    
        return view('properties.edit',compact('property', 'categories', 'types', 'options', 'amenities'));
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
        
        $property = Property::find($id);
        $property->update($input);

        if ($request->hasFile('photo_id')) {
            $files = $request->file('photo_id');
            foreach ($files as $file) {
                $name = time().'-'.$file->getClientOriginalName();
                $name = str_replace(' ', '-', $name);
                $file->move('property_pictures', $name);
                $property->pictures()->create(['name' => $name]);
            }
        }
    
        return redirect()->route('properties.index')
                        ->with('success','Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Property::find($id)->delete();
        return redirect()->route('properties.index')
                        ->with('success', 'Property deleted successfully');
    }
}
