<?php

namespace Luanardev\Modules\Employees\Observers;

use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Events\ProfileCreated;
use Luanardev\Modules\Employees\Events\ProfileUpdated;
use App\Models\User;
use Storage;
use EmployeeSettings;

class EmployeeObserver
{

    /**
     * Handle the Employee "creating" event.
     *
     * @param  Employee  $employee
     * @return void
     */
    public function creating(Employee $employee)
    {
        if(empty($employee->getKey())){
            $employee->makeId();
        }
        
        $createEmail =  (bool)EmployeeSettings::get('create_staff_email');
        if(empty($employee->official_email) && $createEmail==true){
            $employee->makeEmail();
        }

    }
   
    /**
     * Handle the Employee "created" event.
     *
     * @param  Employee  $employee
     * @return void
     */
    public function created(Employee $employee)
    {
        $employee->activate();
        ProfileCreated::dispatch($employee);
    }

    /**
     * Handle the Employee "updated" event.
     *
     * @param  Employee  $employee
     * @return void
     */
    public function updated(Employee $employee)
    {
        if($employee->wasChanged('avatar')){
            $this->removeAvatar($employee);
            return false;
        }

        if($employee->wasChanged('signature')){
            $this->removeSignature($employee);
            return false;
        }

        ProfileUpdated::dispatch($employee);

    }

    /**
     * Handle the Employee "deleted" event.
     *
     * @param  Employee  $employee
     * @return void
     */
    public function deleted(Employee $employee)
    {
        $user = User::find($employee->id);
        if($user){
            $user->delete();
        }
    }

    /**
     * Remove old avatar file
     *
     * @param Employee $employee
     * @return void
     */
    protected function removeAvatar(Employee $employee)
    {
        $avatar = $employee->getOriginal('avatar');
        if(Storage::exists("public/".$avatar)){
            return Storage::delete("public/".$avatar);
        }
    }

    /**
     * Remove old signature file
     *
     * @param Employee $employee
     * @return void
     */
    protected function removeSignature(Employee $employee)
    {
        $signature = $employee->getOriginal('signature');
        if(Storage::exists("public/".$signature)){
            return Storage::delete("public/".$signature);
        }
    }

}
