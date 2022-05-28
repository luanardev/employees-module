<?php

namespace Luanardev\Modules\Employees\Observers;

use Luanardev\Modules\Employees\Entities\Staff;
use Luanardev\Modules\Employees\Events\ProfileCreated;
use Luanardev\Modules\Employees\Events\ProfileUpdated;
use App\Models\User;
use Storage;
use StaffConfig;

class StaffObserver
{

    /**
     * Handle the Staff "creating" event.
     *
     * @param  Staff  $staff
     * @return void
     */
    public function creating(Staff $staff)
    {
        if(empty($staff->getKey())){
            $staff->makeId();
        }
        
        $createEmail =  (bool)StaffConfig::get('create_staff_email');
        if(empty($staff->official_email) && $createEmail==true){
            $staff->makeEmail();
        }

    }
   
    /**
     * Handle the Staff "created" event.
     *
     * @param  Staff  $staff
     * @return void
     */
    public function created(Staff $staff)
    {
        $staff->activate();
        ProfileCreated::dispatch($staff);
    }

    /**
     * Handle the Staff "updated" event.
     *
     * @param  Staff  $staff
     * @return void
     */
    public function updated(Staff $staff)
    {
        if($staff->wasChanged('avatar')){
            $this->removeAvatar($staff);
            return false;
        }

        if($staff->wasChanged('signature')){
            $this->removeSignature($staff);
            return false;
        }

        ProfileUpdated::dispatch($staff);

    }

    /**
     * Handle the Staff "deleted" event.
     *
     * @param  Staff  $staff
     * @return void
     */
    public function deleted(Staff $staff)
    {
        $user = User::find($staff->id);
        if($user){
            $user->delete();
        }
    }

    /**
     * Remove old avatar file
     *
     * @param Staff $staff
     * @return void
     */
    protected function removeAvatar(Staff $staff)
    {
        $avatar = $staff->getOriginal('avatar');
        if(Storage::exists("public/".$avatar)){
            return Storage::delete("public/".$avatar);
        }
    }

    /**
     * Remove old signature file
     *
     * @param Staff $staff
     * @return void
     */
    protected function removeSignature(Staff $staff)
    {
        $signature = $staff->getOriginal('signature');
        if(Storage::exists("public/".$signature)){
            return Storage::delete("public/".$signature);
        }
    }

}
