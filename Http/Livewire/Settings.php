<?php
namespace Luanardev\Modules\Employees\Http\Livewire;
use Luanardev\LivewireUI\LivewireUI;
use StaffConfig;

class Settings extends LivewireUI
{
    public $settings = array();

    public function __construct()
    {
        $this->settings = StaffConfig::getSettings();
    }

    public function render()
    {
        return view("employees::livewire.settings");
    }

    public function save()
    {
        StaffConfig::saveAll($this->settings);
        $this->emitRefresh()->toastr('Settings saved');
    }


}
