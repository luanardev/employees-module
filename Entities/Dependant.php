<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Dependant extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_employee_dependants';

    /**
     * @var array
     */
    protected $fillable = ['id','employee_id', 'title', 'firstname', 'lastname', 'date_of_birth', 'gender', 'relation'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
    ];

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

}
