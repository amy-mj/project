<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $limitForPaging  = 15; // [페이징 변수] 레코드 노출 개수
    protected $blocksForPaging = 5;  // [페이징 변수] 페이지 숫자 블럭
    

    /**
     * loadByFunc
     * @description loadBy* 함수 자동 매핑 : model에 해당 함수 있어야 함
     * @param  obj $class
     * @param  array $loadByField = ["field" => "value"]
     * @return obj
     */
    public function loadByField($class, $loadByField)
    {
        foreach ($loadByField as $key => $val) {
            $key = array_keys($loadByField);
            $val = array_values($loadByField);

            $class->{$key} = $val;
        }
        return $class->{'loadBy' . ucfirst($key)}();
    }
    
    /**
     * getStartNum
     * @description 현재 페이지의 레코드 시작 행 구하기 : model retrieve에서 사용
     * @return int
     */
    public function getStartNum($page)
    {
        return (int) ($page-1) * $this->limitForPaging;
    }
    
    /**
     * paging
     * @description 각 페이지 블록의 시작과 끝은 고정되어 있음
     * @param  int $page
     * @param  int $count
     * @return array
     */
    public function paging($page = 1, $count = 0)
    {
        if($count < 1) {
            return [ 'page' => -1, 'msg' => '레코드 개수가 0이어서 페이징 할 수가 없습니다.',
                     'first' => 1, 'last' => 1, 'prev' => 1, 'next' => 1, 'page' => 1, 'pageBlocks' => [1] ];
        }

        $paging   = [];
        $maxBlock = ceil($count/$this->limitForPaging);

        [$start, $end]   = $this->setPageBlock($page, $maxBlock);
        $paging['first'] = 1;
        $paging['last']  = (int) $maxBlock;
        $paging['prev']  = (int) max($start - $this->blocksForPaging, 1); // 이전 블록의 시작
        $paging['next']  = (int) $end;   // 다음 블록의 시작
        $paging['page']  = (int) $page;

        $pageBlocks = [];
        
        foreach ($this->makePageBlock($start, $end) as $pageBlock) {
            array_push($pageBlocks, $pageBlock);
        }
        if($start >= $end) {
            array_push($pageBlocks, (int) $end);
        }
        $paging['pageBlocks'] = $pageBlocks;

        return $paging;
    }
 
    /**
     * setPageBlock
     * @description 현재 페이지 블록 시작과 끝 구하기  
     * @param  int $page
     * @param  int $maxBlock
     * @return array
     */
    private function setPageBlock($page, $maxBlock)
    {
        $endPage     = ceil($page/$this->blocksForPaging) * $this->blocksForPaging;
        $endBlocks   = min($endPage + 1, $maxBlock);
        $startBlocks = $endPage - $this->blocksForPaging + 1;

        return [$startBlocks, $endBlocks];
    }
    
    /**
     * makePageBlock
     * @description 현재 블록의 숫자들
     * @param  int $start
     * @param  int $end
     */
    private function makePageBlock($start, $end)
    {
        for ($p=$start; $p<$end; $p++) {
            yield (int) $p;
        }
    }

    protected function printToJson($data)
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE );
    }

}
