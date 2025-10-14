<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use App\Interface\Admin\Tables\TableInterface;
use Illuminate\Contracts\View\Factory as ViewFactory;

class TableService
{

    protected $repo;
    protected $view;

    public function __construct(TableInterface $repo, ViewFactory $view)
    {
        $this->repo = $repo;
        $this->view = $view;
    }

    public function getTableOutput(string $key)
    {
        $rows = $this->repo->getTableData($key);

        // render partial blade for the key if exists
        if (view()->exists("partials.tables.$key")) {
            return $this->view->make("partials.tables.$key", ['rows' => $rows])->render();
        }

        // fallback return array
        return ['table' => $key, 'rows' => $rows];
    }
}
