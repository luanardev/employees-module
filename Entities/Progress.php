<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Entities\Designation;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Entities\ProgressType;
use Luanardev\Modules\Employees\Concerns\WithQuietUpdate;
use Luanardev\Modules\Employees\Concerns\WithProgressHelper;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Progress extends Model
{
    use WithQuietUpdate, WithProgressHelper, Loggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_employee_progress';

    /**
     * @var array
     */
    protected $fillable = ['id','employee_id', 'designation_id', 'progress_type', 'grade', 'notch', 'start_date', 'end_date','status'];

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
        'end_date' => 'date:Y-m-d',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employment()
    {
        return $this->belongsTo(Employment::class, 'employee_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function progressType()
    {
        return $this->belongsTo(ProgressType::class, 'progress_type');
    }

     /**
     * Activate progression
     */
    public function activate()
    {
        $this->setAttribute('status', 'Active');
        $this->saveQuietly();
    }

    /**
     * Deactivate progression
     */
    public function deactivate()
    {
        $this->setAttribute('status', 'Inactive');
        $this->saveQuietly();
    }

     /**
     * Check Progress type
     *
     * @param string $type
     * @return boolean
     */
    public function isType($type)
    {
        if(is_string($type)){
            $progress_type = $this->getType();
            return (strtolower($progress_type) == strtolower($type) )? true:false;
        }
        elseif(is_numeric($type)){
            return ($this->progress_type == $type )? true:false;
        }
        elseif($type instanceof ProgressType){
            return ($this->progress_type == $type->id )? true:false;
        }
    }

    /**
     * Create Progression
     *
     * @param Employee $employee
     * @param mixed $progressType
     * @param mixed $designation
     * @param mixed $grade
     * @param mixed $notch
     * @param mixed $startdate
     * @param mixed $enddate
     * @return void
     */
    public static function make(Employee $employee, $progressType, $designation, $grade, $notch, $startdate, $enddate)
    {
        if(empty($designation)){
            $designation = $employee->employment->designation;
        }
     
        $progressType = ProgressType::findByName($progressType); 
        
        if($progressType->isIncrement() ){
            $employment = $employee->employment;
            $progress = new self;
            $progress->progressType()->associate($progressType);
            $progress->employee()->associate($employee);
            $progress->designation()->associate($designation);
            $progress->grade = $employment->grade;
            $progress->notch = $notch;
            $progress->start_date = $startdate;
            $progress->end_date =  $employment->end_date;
            $progress->save();
        }
        else{
            
            $progress = new self;
            $progress->progressType()->associate($progressType);
            $progress->employee()->associate($employee);
            $progress->designation()->associate($designation);
            $progress->grade = $grade;
            $progress->notch = $notch;
            $progress->start_date = $startdate;
            $progress->end_date = $enddate;
            $progress->save();
        }

    }

}
