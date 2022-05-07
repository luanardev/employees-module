<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Experience extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_employee_experience';

    /**
     * @var array
     */
    protected $fillable = [
        'id','employee_id', 'job_position', 'employer_name', 'employer_address', 'employer_phone', 'start_date', 'end_date'
    ];

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
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Joining date
     *
     * @return string
     */
    public function startDate()
    {
        return (isset($this->start_date))? $this->start_date->format('d-M-Y'):null;
    }

    /**
     * Exit date
     *
     * @return string
     */
    public function endDate()
    {
        return (isset($this->end_date)) ? $this->end_date->format('d-M-Y'):null;
    }

    /**
     * Get  period
     */
    public function period()
    {
        return isset($this->start_date) && isset($this->end_date) ? 
            Carbon::createFromDate($this->start_date)->diff($this->end_date)->format('%y Years, %m Months') : null;
    }
}
