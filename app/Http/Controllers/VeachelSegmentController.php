<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VeachelSegment;
use Illuminate\Support\Facades\Crypt;

class VeachelSegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $sort_search =null;

        $veachelsegment = VeachelSegment::orderBy('created_at', 'desc');

        if ($request->has('search')){

            $sort_search = $request->search;

            $veachelsegment = $veachelsegment->where('name', 'like', '%'.$sort_search.'%');

        }

        $veachelsegment = $veachelsegment->paginate(15);

        return view('veachelsegment.index', compact('veachelsegment', 'sort_search'));

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("veachelsegment.create");
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

        flash(__('Segment has been inserted successfully'))->success();

       return redirect()->route('vehicle.index');

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
        $data['veachelsegment'] = VeachelSegment::find($id);
        return view("veachelsegment.edit",$data);
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
        
        flash(__('Segment has been inserted successfully'))->success();

       return redirect()->route('vehicle.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $vehicle = VeachelSegment::find($id);
      
        if( $vehicle){
            VeachelSegment::destroy($id);
            flash(__('Segment has deleted successfully '))->success();

            return redirect()->route('vehicle.index');

        }else{
            flash(__('Segment has not deleted '))->success();

            return redirect()->route('vehicle.index');
        }


      
    }



    function addUpdate($formData){
        $vehicle = VeachelSegment::find($formData['id']);

        if($vehicle){
            $vehicle->update($formData);
        }else{
            VeachelSegment::create($formData);
        }
    }
}
