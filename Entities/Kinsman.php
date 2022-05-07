<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Kinsman extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_employee_kinsman';


    /**
     * @var array
     */
    protected $fillable = [
        'id','employee_id', 'title', 'firstname', 'lastname', 'middlename', 'relation', 'occupation',
        'organisation', 'contact_address', 'phone1', 'phone2',
    ];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Concatenate firstname and lastname
     * @return string
     */
    public function name()
    {
        return $this->firstname." ".$this->lastname;
    }

    /**
     * Concatenate title, firstname and lastname
     * @return string
     */
    public function fullname()
    {
        return $this->title." ".$this->firstname." ".$this->lastname;
    }

}
