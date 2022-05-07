<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Concerns\WithFinder;

class EmploymentType extends Model
{ 
    use WithFinder;

    /** 
     * Disable timestamp
     * var bool
     */
    public $timestamps = false;
    
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'hrm_employment_type';

   /**
    * @var array
    */
   protected $fillable = ['name'];

   /**
     * @return boolean
     */
    public function isPermanent()
    {
        return $this->isNamed('Permanent');
    }

    /**
     * @return boolean
     */
    public function isContract()
    {
        return $this->isNamed('Contract');
    }


}
