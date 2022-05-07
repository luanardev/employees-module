<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Support\Carbon;
use EmployeeSettings;

trait WithOfficialEmail
{
    public function makeEmail($domain=null)
    {
        if(empty($domain)){
            $domain = $this->emailDomain();
            if(empty($domain)){
                $domain = request()->getHost();
            }
        }
        $email = $this->suggestEmail($domain);
        if(isset($email)){
            $this->setAttribute('official_email', $email);
        }
    }

    protected function emailDomain()
    {
        return EmployeeSettings::get('email_domain');
    }

    public function suggestEmail($domain)
    {
        $choice = null;
        $suggestions = $this->emailSuggestions($domain);
        foreach($suggestions as $suggestion){
            if($this->emailNotTaken($suggestion)){
                $choice = $suggestion;
                break;
            }
        }
        return $choice;
    }

    protected function emailNotTaken($email)
    {
        $exists = static::where('official_email', $email)->exists();
        return ($exists==false)? true:false;
    }

    protected function emailSuggestions($domain)
    {
        $firstname = strtolower($this->firstname[0]);
        $middlename = isset($this->middlename)? strtolower($this->middlename[0]): null;
        $lastname = strtolower($this->lastname);
        $date = Carbon::createFromDate($this->date_of_birth)->format('Y');
        $year = substr($date, -2);

        $suggestions = [];

        $suggestions[] = $firstname.$middlename.$lastname."@".$domain; // jsmith@domain.com or jdsmith@domain.com
        $suggestions[] = $firstname.$middlename.$lastname.$year."@".$domain; // jsmith90@domain.com or jdsmith90@domain.com
        $suggestions[] = $firstname.$middlename.".".$lastname."@".$domain; // j.smith@domain.com or jd.smith@domain.com
        $suggestions[] = $firstname.$middlename.".".$lastname.$year."@".$domain; // j.smith90@domain.com or jd.smith90@domain.com
        $suggestions[] = $firstname.$middlename."_".$lastname."@".$domain; // j_smith@domain.com or jd_smith@domain.com
        $suggestions[] = $firstname.$middlename."_".$lastname.$year."@".$domain; //j_smith90@domain.com or jd_smith90@domain.com

        return $suggestions;
    }

}
