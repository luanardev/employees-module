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
    protected $table = 'hrm_staff_kinsman';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'id','staff_id', 'title', 'firstname', 'lastname', 'middlename', 'relation', 'occupation',
        'organisation', 'contact_address', 'phone1', 'phone2',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
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
