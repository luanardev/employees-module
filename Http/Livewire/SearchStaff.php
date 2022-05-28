<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\StaffView;

class SearchStaff extends LivewireUI
{
    public $term;
    public $results;
    public $route;

    public function mount($route)
    {
        $this->route = $route;
    }

    public function render()
    {
        return view("employees::livewire.search");
    }

    public function search()
    {
        if(empty($this->term)){
            return false;
        }
        $this->results = StaffView::search($this->term)->get();
    }


}
