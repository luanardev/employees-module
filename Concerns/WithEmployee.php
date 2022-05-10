<?php
namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Employee;

trait WithEmployee
{
    /**
     * Get Employee Record
     * @param string $email
     * @return Employee|null
     */
    public function getEmployee($email=null)
    {
        if(empty($email)){
            $email = $this->getEmail(self);
        }
        if(!empty($email)){
            return Employee::findByEmail($email);
        }
       
    }

    /**
     * Check whether employee record exists
     */
    public function employeeExists()
    {
        $employee = $this->getEmployee();
        return !empty($record)? true:false;
    }

    /**
     * Get Employee Id
     *
     * @return mixed
     */
    public function getEmployeeId()
    {
        $employee = $this->getEmployee();
        if($this->employeeExists()){
            return $employee->getKey();
        }
    }

    private function getEmail($model)
    {
        if($model instanceof Model){
            return $model->getAttribute('email');
        }
    }
    
}
