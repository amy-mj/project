<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $mainKey;

    use HasFactory;

    public function __construct($mainKey)
    {
        $this->mainKey = $mainKey;
    }

    public function test()
    {
        return $this->mainKey;
    }
}
