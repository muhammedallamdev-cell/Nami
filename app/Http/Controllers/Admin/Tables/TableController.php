<?php

namespace App\Http\Controllers\Admin\Tables;

use Illuminate\Http\Request;
use App\Services\TableService;
use App\Http\Controllers\Controller;

class TableController extends Controller
{

    public function __construct(protected TableService $service) {}

    public function fetch(Request $request)
    {
        $request->validate(['table_key' => 'required|string']);
        $key = $request->input('table_key');

        $output = $this->service->getTableOutput($key);

        if (is_string($output) && str_starts_with(trim($output), '<')) {
            return response()->json(['html' => $output]);
        }

        return response()->json(['data' => $output]);
    }
}
