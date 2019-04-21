<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FiltrosController extends Controller
{
    public function filter(Request $request)
    {
        $data = $request->all();
        $query = DB::table($data['tabla']);
        $columns = Schema::getColumnListing($data['tabla']);
        
        $select = array_intersect($columns, $data['campos']);
        if (count($select) > 0) {
            call_user_func_array([$query, 'select'], $select);
        }
        foreach ($whereArray as $where) {
            if (in_array($where['field'], $columns)) {
                if(gettype($where['value'] === 'string')) {
                    $value = ["%${where['value']}%"];
                } else {
                    $value = $where['value'];
                }
                $query->where($where['field'], $where['condition'], $value);
            }
        }
        $result = $query->get();
    }
}
