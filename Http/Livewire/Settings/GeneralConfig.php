<?php

namespace Luanardev\Modules\Employees\Http\Livewire\Settings;
use Luanardev\LivewireUI\LivewireUI;
use Luanardev\Modules\Employees\Facades\EmployeeSettings;

class GeneralConfig extends LivewireUI
{
    public $settings = array();

    public function __construct()
    {
        $this->settings = EmployeeSettings::getSettings();
    }

    public function render()
    {
        return view("employees::livewire.settings.general.index");
    }

    public function save()
    {
        EmployeeSettings::saveAll($this->settings);
        $this->emitRefresh()->toastr('Settings saved');
    }


}
