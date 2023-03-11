<?php

namespace App\Actions;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use InvalidArgumentException;

class EventoSearch extends BaseAction
{
    public function execute(Request $request)
    {
        $param = $request->param;

        // empty($param) ? throw new InvalidArgumentException("O parâmetro 'param' não pode estar vazio.") : null;

        $tableColumns = Schema::getColumnListing('eventos');

        $result = DB::table('eventos')
            ->where(function ($query) use ($param, $tableColumns) {
                foreach ($tableColumns as $column) {
                    $query->orWhere(DB::raw("LOWER($column)"), 'LIKE', "%" . strtolower($param) . "%");
                }
            })
            ->get();

        return $result;
    }
}
