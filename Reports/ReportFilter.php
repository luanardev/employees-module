<?php

namespace Luanardev\Modules\Employees\Reports;

abstract class ReportFilter
{
    abstract public function filters(): array;

    abstract public function groups(): array;

    public function render($view, $data=[])
    {
        $filters = $this->filters();
        $groups = $this->groups();
        return view($view)->with(['filters' => $filters, 'groups' => $groups])->with($data);
    }

}
