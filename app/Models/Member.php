<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    use HasFactory;

    protected $table   = "member";
    
    //public $timestamps = false;
    
    /**
     * retrieve
     * @description 회원관리 리스트
     * @param  array $where
     * @param  array $page
     * @param  array $orderBy
     * @return array
     */
    public static function retrieve($where = null, $page = null, $orderBy = ['created_at', 'desc']) 
    {
        $class      = new Member();
        $result     = DB::table($class->table);
        if($where) {
            $wheres = $class->_factoryByWhere($where);
            $result = $result->where($wheres);
        } 
        return $result->orderBy('created_at')->take(10)->get();
    }

    private function _factoryByWhere($whereArr)
    {
        $where = array();
        foreach($whereArr as $key => $val) {
            if(!$val) {
                continue;
            }
        
            $arr = array();
            switch($key) {
                case "name" :
                    $arr = [$key, "=", $val];
                    break;
                case "created_start" : 
                    $arr = [DB::raw('DATE(created_at)'), ">=", $val];
                    break;
                case "created_end" : 
                    $arr = [DB::raw('DATE(created_at)'), "<=", $val];
                    break;
                default :
                    $arr = [$key, "like", "%$val%"];
                    break;
            }
            array_push($where, $arr);
        }
        return $where;
    }

}
