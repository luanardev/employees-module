<?php
namespace Luanardev\Modules\Employees\Concerns;
use Luanardev\Modules\Employees\Events\AccountCreated;
use Illuminate\Support\Str;
use App\Models\User;

trait WithUserAccount
{

    public function createAccount()
    {
        if($this->accountExists()){
            return false;
        }

        $password = Str::upper(Str::random(8));

        $user = new User();
        $user->id = $this->employee_id;
        $user->name = $this->name() ;
        $user->email = $this->emailAddress();
        $user->campus = $this->campus->code;
        $user->setPassword($password);
        $user->save();

        AccountCreated::dispatch($this, $password);
    }

    public function disableAccount()
    {
        $user = User::find($this->employee_id);
        if(!empty($user)){
            $user->deactivate();
        }
        
    }

    public function enableAccount()
    {
        $user = User::find($this->employee_id);
        if(!empty($user)){
            $user->activate();
        }
    }

    protected function accountExists()
    {
        $email = $this->emailAddress();
        $exists = User::where('email', $email)->exists();
        return ($exists)?true:false;
    }
}
