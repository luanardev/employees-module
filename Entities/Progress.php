<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\HRSettings\Entities\Position;
use Luanardev\Modules\HRSettings\Entities\JobGrade;
use Luanardev\Modules\HRSettings\Entities\ProgressType;
use Luanardev\Modules\Employees\Entities\Staff;
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
    protected $table = 'hrm_staff_progress';

    /**
     * @var array
     */
    protected $fillable = ['id','staff_id', 'position_id',  'grade_id', 'progress_type', 'scale', 'notch', 'status', 'start_date', 'end_date'];

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
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(JobGrade::class, 'grade_id');
    }

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employment()
    {
        return $this->belongsTo(Employment::class, 'staff_id');
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
     * Check staff grade
     *
     * @param mixed $status
     * @return boolean
     */
    public function isGrade($grade)
    {
        if(is_string($grade)){
            $grade = JobGrade::findKey($grade);
            return ($this->grade_id == $grade )? true:false;
        }
        elseif(is_numeric($grade)){
            return ($this->grade_id == $grade )? true:false;
        }
        elseif($grade instanceof JobGrade){
            return ($this->grade_id == $grade->getKey() )? true:false;
        }

    }

    /**
     * Create Progression
     *
     * @param Staff $staff
     * @param mixed $progressType
     * @param mixed $position
     * @param mixed $grade
     * @param mixed $scale
     * @param mixed $notch
     * @param mixed $startdate
     * @param mixed $enddate
     * @return void
     */
    public static function make(Staff $staff, $progressType, $position, $grade, $scale, $notch, $startdate, $enddate)
    {
        if(empty($position)){
            $position = $staff->employment->position;
        }
     
        $progressType = ProgressType::findByName($progressType); 
        
        if($progressType->isIncrement() ){
            $employment = $staff->employment;
            $progress = new self;
            $progress->progressType()->associate($progressType);
            $progress->staff()->associate($staff);
            $progress->position()->associate($position);
            $progress->grade()->associate($employment->grade);
            $progress->scale = $employment->scale;
            $progress->notch = $notch;
            $progress->start_date = $startdate;
            $progress->end_date =  $employment->end_date;
            $progress->save();
        }
        else{
            
            $progress = new self;
            $progress->progressType()->associate($progressType);
            $progress->staff()->associate($staff);
            $progress->position()->associate($position);
            $progress->grade()->associate($grade);
            $progress->scale = $scale;
            $progress->notch = $notch;
            $progress->start_date = $startdate;
            $progress->end_date = $enddate;
            $progress->save();
        }

    }

}
