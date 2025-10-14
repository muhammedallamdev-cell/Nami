<?php 

namespace App\Interface\Admin\Tables;

use App\Models\Admin\Admin;

interface TableInterface
{
    public function getTableData(string $key);
}
