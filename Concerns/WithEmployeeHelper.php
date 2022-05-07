<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Support\Carbon;

trait WithEmployeeHelper
{
    /**
     * Concatenate firstname and lastname
     * @return string
     */
    public function name()
    {
        return $this->firstname." ".$this->lastname;
    }

    /**
     * Get Employee official email
     *
     * @return void
     */
    public function emailAddress()
    {
        if(empty($this->official_email)){
            return $this->personal_email;
        }
        else{
            return $this->official_email;
        }
    }

    /**
     * Concatenate title, firstname and lastname
     * @return string
     */
    public function fullname()
    {
        return $this->title." ".$this->firstname." ".$this->lastname;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function age(){
        return Carbon::createFromDate($this->date_of_birth)
            ->diff(Carbon::now())->format('%y Years');
    }

    /**
     * Date of Birth
     *
     * @return string
     */
    public function dateOfBirth()
    {
        return (isset($this->date_of_birth))? $this->date_of_birth->format('d-M-Y'):null;
    }

    /**
     * Status
     *
     * @return string
     */
    public function statusBadge()
    {
        return (strtolower($this->status) == strtolower('active'))?
            "<span class='badge badge-success'>{$this->status}</span>":
            "<span class='badge badge-danger'>{$this->status}</span>";
    }

    /**
     * Check whether employee is active
     * @return bool
     */
    public function isActive()
    {
        return ( strtolower($this->status) == strtolower('active') )? true:false;
    }

    /**
     * Check whether employee is not active
     * @return bool
     */
    public function isNotActive()
    {
        return !$this->isActive();
    }

    /**
     * Highest qualification
     *
     * @return string
     */
    public function highestQf()
    {
        $highestQf = $this->qualifications()
			->where('level', $this->qualification)
			->first();
        if(!empty($highestQf)){
            return $highestQf->name;
        }

    }


}
