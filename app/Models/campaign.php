<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campaign extends Model
{
    use HasFactory;

    protected $table = "campaign";
    public $timestamps = false;

    public function retrieveGrp3()
    {
        return $this->where('group_id',3)->take(2)->get();        
    }
}
