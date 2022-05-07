<?php

namespace Luanardev\Modules\Employees\Concerns;
use Haruncpi\LaravelIdGenerator\IdGenerator;


trait WithGeneratedID
{

    public function makeId()
    {
        $config = [
            'table' => $this->table,
            'length' => 6,
            'prefix' => date('y')
        ];
        $ID = IdGenerator::generate($config);
        $this->setAttribute('id', $ID);
        return $ID;

    }
}
