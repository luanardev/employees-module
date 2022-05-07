<?php

namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Entities\EmployeeView;
use Illuminate\Support\Facades\Gate;

class Search extends LivewireUI
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
        Gate::authorize('view_employee');

        if(empty($this->term)){
            return false;
        }
        $this->results = EmployeeView::search($this->term)->get();
    }


}
