<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Land;
use Illuminate\Support\Facades\Validator;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $land_count = Land::count();
        $data = Land::orderBy('id','DESC')->paginate(5);
        return view('lands.index',compact('data','land_count'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lands.create');
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
            'type' => 'required',
            'price' => 'required',
            'area' => 'required',
            'negotiable' => 'nullable'
        ]);
    
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'file' => 'max:300',
        ]);
    
        $land = Land::create($input);
        
        if ($request->hasFile('photo_id')) {
            $files = $request->file('photo_id');
            foreach ($files as $file) {
                $name = time().'-'.$file->getClientOriginalName();
                $name = str_replace(' ', '-', $name);
                $file->move('land_images', $name);
                $land->images()->create(['name' => $name]);
            }
        }
    
        return redirect()->route('lands.index')
                        ->with('success','Land created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $land = Land::find($id);
        return view('lands.show', compact('land'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $land = Land::find($id);
        return view('lands.edit', compact('land'));
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
            'type' => 'required',
            'price' => 'required',
            'area' => 'required',
            'negotiable' => 'nullable'
        ]);
    
        $input = $request->all();

        $land = Land::find($id);
        $land->update($input);

        if ($request->hasFile('photo_id')) {
            $files = $request->file('photo_id');
            foreach ($files as $file) {
                $name = time().'-'.$file->getClientOriginalName();
                $name = str_replace(' ', '-', $name);
                $file->move('land_images', $name);
                $land->images()->create(['name' => $name]);
            }
        }
    
        return redirect()->route('lands.index')
                        ->with('success','Land updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Land::find($id)->delete();
        return redirect()->route('lands.index')
                        ->with('success', 'Land deleted successfully');
    }
}
