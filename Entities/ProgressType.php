<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Concerns\WithFinder;

class ProgressType extends Model
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
    protected $table = 'hrm_progress_type';

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
    public function isPromotion()
    {
        return $this->isNamed('Promotion');
    }

    /**
     * @return boolean
     */
    public function isIncrement()
    {
        return $this->isNamed('Increment');
    }

    /**
     * @return boolean
     */
    public function isContract()
    {
        return $this->isNamed('Contract');
    }

    /**
     * @return boolean
     */
    public function isAppointment()
    {
        return $this->isNamed('Appointment');
    }

}
