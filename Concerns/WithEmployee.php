<?php
namespace Luanardev\Modules\Employees\Concerns;
use Luanardev\Modules\Employees\Entities\Employee;

trait WithEmployee
{
    /**
     * Get Employee Record
     * 
     * @return Employee|null
     */
    public function getEmployee()
    {
        return Employee::findByEmail($this->email);
    }

    /**
     * Get Employee Id
     *
     * @return mixed
     */
    public function getEmployeeId()
    {
        $employee = $this->getEmployee();
        if(!empty($employee)){
            return $employee->getKey();
        }
    }
    
}
