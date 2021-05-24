<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VehicleModel;
use App\VeachelSegment;
class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;

        $veachelsegment = VehicleModel::orderBy('created_at', 'desc');

        if ($request->has('search')){

            $sort_search = $request->search;

            $veachelsegment = $veachelsegment->where('name', 'like', '%'.$sort_search.'%');

        }

        $vehiclemodel = $veachelsegment->paginate(15);

        return view('vehiclemodel.index', compact('vehiclemodel', 'sort_search'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['segmants']  = VeachelSegment::get();
        return view("vehiclemodel.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();
        $formData['id'] = 0;

        $this->addUpdate($formData);

        flash(__('Vehicle model has been inserted successfully'))->success();

       return redirect()->route('vehiclemodel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $data['vehiclemodel'] = VehicleModel::find($id);
        $data['segmants']  = VeachelSegment::get();
        return view("vehiclemodel.edit",$data);
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
        $formData = $request->all();
        $formData['id'] = $id;

        $this->addUpdate($formData);
        
        flash(__('Vehicle model has been updated successfully'))->success();

       return redirect()->route('vehiclemodel.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = VehicleModel::find($id);
      
        if( $vehicle){
            VehicleModel::destroy($id);
            flash(__('Vehicle model has deleted successfully '))->success();

            return redirect()->route('vehiclemodel.index');

        }else{
            flash(__('Vehicle model has not deleted '))->success();

            return redirect()->route('vehiclemodel.index');
        }
    }



    function addUpdate($formData){
        $vehicle = VehicleModel::find($formData['id']);

        if($vehicle){
            $vehicle->update($formData);
        }else{
            VehicleModel::create($formData);
        }
    }



    public function get_model_by_segment(Request $request)
    {
        $subcategories = VehicleModel::where('segment_id', $request->segment_id)->get();
        return $subcategories;
    }
}
