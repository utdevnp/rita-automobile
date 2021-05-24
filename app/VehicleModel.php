<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $fillable = ['segment_id',"name","active"];


    public function segment(){
        return $this->belongsTo(VeachelSegment::class);
    }

}
