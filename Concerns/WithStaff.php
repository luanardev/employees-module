<?php
namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Staff;

trait WithStaff
{
    /**
     * Get Staff Record
     * @param string $email
     * @return Staff|null
     */
    public function getStaff($email=null)
    {
        if(empty($email)){
            $email = $this->getEmail(self);
        }
        if(!empty($email)){
            return Staff::findByEmail($email);
        }
       
    }

    /**
     * Check whether staff record exists
     */
    public function staffExists()
    {
        $staff = $this->getStaff();
        return !empty($staff)? true:false;
    }

    /**
     * Get Staff Id
     *
     * @return mixed
     */
    public function getStaffId()
    {
        $staff = $this->getStaff();
        if($this->staffExists()){
            return $staff->getKey();
        }
    }

    private function getEmail($model)
    {
        if($model instanceof Model){
            return $model->getAttribute('email');
        }
    }
    
}
