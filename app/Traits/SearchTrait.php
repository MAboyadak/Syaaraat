<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SearchTrait
{
    public $searchModel;
    public $searchCol;
    public $searchKey;
    private $namespacePrefix = 'App\Models\\';

    public function getSearchResult($elqRel = "")
    {
        if($elqRel){
            $result = ($this->namespacePrefix.$this->searchModel)::where($this->searchCol,'LIKE','%'.$this->searchKey."%")->with($elqRel);
            return $result;
        }
        $result = ($this->namespacePrefix.$this->searchModel)::where($this->searchCol,'LIKE','%'.$this->searchKey."%");
        return $result;
    }
}
?>