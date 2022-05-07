<?php

namespace Luanardev\Modules\Employees\Enums;
use Luanardev\Library\Enums\Family;
use Luanardev\Library\Enums\Status;
use Luanardev\Library\Enums\Gender;
use Luanardev\Library\Enums\Title;
use Luanardev\Library\Enums\MaritalStatus;
use Luanardev\Library\Enums\District;
use Luanardev\Library\Enums\Country;

trait WithEnums
{
    protected function family()
	{
		return Family::values();
	}

    protected function gender()
	{
		return Gender::values();
	}

    protected function title()
	{
		return Title::values();
	}

    protected function status()
	{
		return Status::values();
	}

    protected function maritalStatus()
	{
		return MaritalStatus::values();
	}

    protected function district()
	{
		return District::values();
	}

    protected function country()
	{
		$array= [];
		foreach(Country::get() as $case){
			$array[] = $case;
		}
		return $array;
	}
}
