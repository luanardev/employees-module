<?php

namespace Luanardev\Modules\Employees\Reports;

use Luanardev\Modules\Employees\Entities\Position;
use Luanardev\Modules\Employees\Entities\QualificationType;
use Luanardev\Modules\Employees\Entities\JobScale;
use Luanardev\Modules\Institution\Entities\Campus;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;;
use Illuminate\Database\Query\Builder;


abstract class ReportBuilder
{

    protected string $title = 'Generated Report';
    protected array $filterColumns = [];
    protected array $groupColumns = [];
    protected array $sortColumns = [];

    public abstract function columns(): array;

    public abstract function query(): Builder;


    public function criteria($filterBy, $groupBy=null, $sortBy=null)
    {
        $this->setFilterBy($filterBy);
        $this->setGroupBy($groupBy);
        $this->setSortBy($sortBy);
    }

    public function setFilterBy($columns)
    {
        if(is_array($columns)){
            $this->filterColumns = $columns;
        }else{
            $this->filterColumns[] = $columns;
        }
    }

    public function setGroupBy($columns)
    {
        if(is_array($columns)){
            $this->groupColumns = $columns;
        }else{
            $this->groupColumns[] = $columns;
        }
    }

    public function setSortBy($columns)
    {
        if(is_array($columns)){
            $this->sortColumns = $columns;
        }else{
            $this->sortColumns[] = $columns;
        }
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function hasTitle()
    {
        return empty($this->title)?false:true;
    }

    public function hasFilters()
    {
        return ( count($this->filterColumns) > 0)  ? true:false;
    }

    public function isGrouped()
    {
        return ( count($this->groupColumns) > 0 ) ? true:false;
    }

    public function isSorted()
    {
        return ( count($this->sortColumns) > 0) ? true:false;
    }

    public function filters()
    {
        return $this->cleanFilters();
    }

    public function groups()
    {
        return $this->cleanGroups();
    }

    public function sorters()
    {
        return $this->cleanSorters();
    }

    public function title()
    {
        return $this->title;
    }

    public function meta()
    {
        return [
            'title'   => $this->title,
            'filters' => $this->filters(),
            'groups'  => $this->groups(),
            'sorters' => $this->sorters(),
        ];
    }

    public function data()
    {
        return $this->query()->get();
    }

    public function sql()
    {
        return $this->query()->toSql();
    }

    public function render($view, $data=[])
    {
        return view($view)->with(['report' => $this])->with($data);
    }

    protected function cleanFilters()
    {
        return collect($this->filterColumns)->reject(fn($value) => $value == 0 );
    }

    protected function cleanGroups()
    {
        $collection = collect($this->groupColumns)->reject(fn($value) => $value == null );
        return $collection->map(function($item){
            return $this->column($item);
        });
    }

    protected function cleanSorters()
    {
        $collection = collect($this->sortColumns)->reject(fn($value) => $value == null );
        return $collection->map(function($item){
            return $this->column($item);
        });
    }

    protected function filter($name)
    {
        return $this->cleanFilters()->get($name);
    }

    protected function groupColumns()
    {
        return $this->cleanGroups()->implode(',');
    }

    protected function sortColumns()
    {
        return $this->cleanSorters()->implode(',');
    }

    protected function sorting()
    {
        return $this->cleanSorters()->count();
    }

    protected function grouping()
    {
        return $this->cleanGroups()->count();
    }

    protected function column($name)
    {
        $columns = $this->columns();
        if(in_array($name, $columns)){
            return $name;
        }
    }

    protected function groupBy()
    {
        $collection = collect($this->groupColumns)->reject(fn($value) => $value == null );
        return $collection->map(function($item){
            return $this->condition($item);
        })->implode(',');
    }

    protected function sortBy()
    {
        return $this->sortColumns();
    }



}
