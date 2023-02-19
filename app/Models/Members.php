<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Members extends Model
{
    use HasFactory;

    protected $fillable     = [ 'userid', 'name', 'email', 'phone', 'addres', 'detail_address', 'zipcode' ];
    protected $loadByField  = []; // unique key 1개

    const TABLE   = "members";

    public function __construct($id = "")
    {  
        return $this->id = $id;
    }
    
    /**
     * loadById 
     * @description pk로 한 건 조회
     */
    public function loadById()
    {
        return Members::where('id', $this->id)->first();
    }

    /**
     * loadByUserid 
     * @description 아이디 한 건 조회
     */
    public function loadByUserid()
    {
        return Members::where('userid', $this->userid)->first();
    }
    
    /**
     * count
     * @description 회원관리 레코드 개수
     * @param  array $where
     * @return int
     */
    public static function count($where = false) 
    {
        $result     = DB::table(SELF::TABLE);
        if($where) {
            $wheres = SELF::search($where);
            $result = $result->where($wheres);
        } 
        return $result->count();
    }

    /**
     * retrieve
     * @description 회원관리 리스트
     * @param  array $where
     * @param  array $page = ['page' => 1, 'limit' => 15]
     * @param  array $orderBy
     * @return array
     */
    public static function retrieve($where = false, $paging = false, $orderBy = ['id', 'desc']) 
    {
        $result     = DB::table(SELF::TABLE);
        if($where) {
            $wheres = SELF::search($where);
            $result = $result->where($wheres);
        } 
        if($paging) {
            return $result->orderBy($orderBy[0], $orderBy[1])->skip($paging['page'])->take($paging['limit'])->get();
        } 
        return $result->orderBy($orderBy[0], $orderBy[1])->get();
    }

    private static function search($whereArr)
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
