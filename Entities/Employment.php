<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Luanardev\Modules\Institution\Entities\Branch;
use Luanardev\Modules\Institution\Entities\Campus;
use Luanardev\Modules\Institution\Entities\Department;
use Luanardev\Modules\Institution\Entities\Section;
use Luanardev\Modules\HRSettings\Entities\Position;
use Luanardev\Modules\HRSettings\Entities\JobGrade;
use Luanardev\Modules\HRSettings\Entities\JobType;
use Luanardev\Modules\HRSettings\Entities\JobCategory;
use Luanardev\Modules\HRSettings\Entities\JobStatus;
use Luanardev\Modules\Employees\Concerns\HasProgress;
use Luanardev\Modules\Employees\Concerns\WithQuietUpdate;
use Luanardev\Modules\Employees\Concerns\WithEmploymentHelper;
use Luanardev\Modules\Employees\Concerns\WithDismissal;
use Luanardev\Modules\Employees\Events\Dismissal;
use Luanardev\Modules\Employees\Events\Termination;
use Luanardev\Modules\Employees\Events\Retirement;
use Luanardev\Modules\Employees\Events\Confirmation;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use StaffConfig;

class Employment extends Model
{
    use HasProgress,
        WithDismissal,
        WithQuietUpdate,
        WithEmploymentHelper,
        HasFactory,
        Notifiable,
        Loggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_staff_employment';

	/**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'staff_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'staff_id', 'position_id', 'grade_id', 'branch_id', 'campus_id', 'department_id', 'section_id',
        'type_id', 'category_id', 'status_id','scale', 'notch', 'start_date', 'end_date', 'appointed', 'confirmed',  'confirm_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'confirm_date' => 'date:Y-m-d'
    ];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];


    /**
     * Set Primary Key
     * @param mixed $key
     * @return void
     */
    public function setKey($key)
    {
        $this->setAttribute($this->primaryKey, $key);
    }

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
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(JobType::class, 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(JobStatus::class, 'status_id');
    }

     /**
     * Set employment status
     * @param mixed $status
     * @return self
     */
    public function setGrade($grade)
    {
        if(is_string($status)){
            $grade = JobGrade::findKey($grade);
            $this->setAttribute('grade_id', $grade);
        }
        elseif(is_numeric($grade)){
            $this->setAttribute('grade_id', $grade);
        }
        elseif($grade instanceof JobGrade){
            $this->setAttribute('grade_id', $grade->getKey());
        }
        return $this;
    }

    /**
     * Set employment status
     * @param mixed $status
     * @return self
     */
    public function setStatus($status)
    {
        if(is_string($status)){
            $status = JobStatus::findKey($status);
            $this->setAttribute('status_id', $status);
        }
        elseif(is_numeric($status)){
            $this->setAttribute('status_id', $status);
        }
        elseif($status instanceof JobStatus){
            $this->setAttribute('status_id', $status->getKey());
        }
        return $this;
    }

    /**
     * Set employment type
     * @param mixed $type
     * @return self
     */
    public function setType($type)
    {
        if(is_string($type)){
            $type = JobType::findKey($type);
            $this->setAttribute('type_id', $type);
        }
        elseif(is_numeric($type)){
            $this->setAttribute('type_id', $type);
        }
        elseif($type instanceof JobType){
            $this->setAttribute('type_id', $type->getKey());
        }
        return $this;
    }

    /**
     * Set employment category
     * @param mixed $category
     * @return self
     */
    public function setCategory($category)
    {
        if(is_string($category)){
            $category = JobCategory::findKey($category);
            $this->setAttribute('category_id', $category);
        }
        elseif(is_numeric($category)){
            $this->setAttribute('category_id', $category);
        }
        elseif($category instanceof JobCategory){
            $this->setAttribute('category_id', $category->getKey());
        }
        return $this;
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
     * Check staff status
     *
     * @param mixed $status
     * @return boolean
     */
    public function isStatus($status)
    {
        if(is_string($status)){
            $status = JobStatus::findKey($status);
            return ($this->status_id == $status )? true:false;
        }
        elseif(is_numeric($status)){
            return ($this->status_id == $status )? true:false;
        }
        elseif($status instanceof JobStatus){
            return ($this->status_id == $status->getKey() )? true:false;
        }

    }

    /**
     * Check staff type
     *
     * @param mixed $type
     * @return boolean
     */
    public function isType($type)
    {
        if(is_string($type)){
            $type = JobType::findKey($type);
            return ($this->type_id == $type )? true:false;
        }
        elseif(is_numeric($type)){
            return ($this->type_id == $type )? true:false;
        }
        elseif($type instanceof JobType){
            return ($this->type_id == $type->getKey() )? true:false;
        }
    }

    /**
     * Check staff category
     *
     * @param mixed $category
     * @return boolean
     */
    public function isCategory($category)
    {
        if(is_string($category)){
            $category = JobCategory::findKey($category);
            return ($this->category_id == $category )? true:false;
        }
        elseif(is_numeric($category)){
            return ($this->category_id == $category )? true:false;
        }
        elseif($category instanceof JobCategory){
            return ($this->category_id == $category->getKey() )? true:false;
        }
    }

    /**
     * Get retirement date
     *
     * @return Carbon
     */
    protected function retirementDate()
    {
        $retirementAge = (int)StaffConfig::get('retirement_age');
        return Carbon::createFromDate($this->staff->date_of_birth)
                ->addYears($retirementAge);
    }

    /**
     * Get retirement date
     *
     * @return Carbon
     */
    protected function probationEndDate()
    {
        $probationPeriod = (int)StaffConfig::get('probation_period');
        return Carbon::createFromDate($this->start_date)
                ->addYears($probationPeriod);
    }

    /**
     * Set employment tenure
     *
     * @param mixed $startdate
     * @param mixed $enddate
     * @return self
     */
    public function setTenure($startdate, $enddate=null)
    {
        if(empty($enddate)){
            if($this->isPermanent() && $this->isConfirmed()){
                $enddate = $this->retirementDate();
            }else{
                $enddate = $this->probationEndDate(); 
            }
        }else{
            $enddate = Carbon::createFromDate($enddate);
        }

        $this->setAttribute('start_date', $startdate);
        $this->setAttribute('end_date', $enddate);
        return $this;
    }

    /**
     * Set Probation Period
     *
     * @return void
     */
    public function setProbation()
    {      
        $enddate = $this->probationEndDate();
        $this->setAttribute('end_date', $enddate);
        $this->setConfirmed(false);
        $this->saveQuietly();       
    }

    /**
     * Update employment tenure
     *
     * @return void
     */
    public function updateTenure()
    {
        $enddate = $this->retirementDate();
        $this->setAttribute('end_date', $enddate);
        $this->saveQuietly();
    }

    /**
     * Set Employment Post
     *
     * @param Position $position
     * @param JobGrade $grade
     * @param mixed $scale
     * @param mixed $notch
     * @param mixed $startdate
     * @param mixed $enddate
     * @return self
     */
    public function setPosition(Position $position, JobGrade $grade, $scale, $notch, $startdate=null, $enddate=null)
    {
        $this->setAttribute('position_id', $position->id);
        $this->setAttribute('grade_id', $grade->id);
        $this->setAttribute('scale', $scale);
        $this->setAttribute('notch', $notch);
        if(!empty($startdate)){
            $this->setAttribute('start_date', $startdate);
        }
        if(!empty($enddate)){
            $this->setAttribute('end_date', $enddate);
        }
        return $this;
    }

    /**
     * Set appointment status
     * @param bool $appointed
     * @return self
     */
    public function setAppointed($appointed=true)
    {
        if($appointed == true){
            $this->setAttribute('appointed', ucwords('yes') );
        }else{
            $this->setAttribute('appointed', ucwords('no') );
        }
        return $this;
    }

    /**
     * Set confirmation status
     * @param bool $confirmed
     * @return self
     */
    public function setConfirmed($confirmed=true)
    {
        if($confirmed == true){
            $this->setAttribute('confirmed', ucwords('yes') );
        }else{
            $this->setAttribute('confirmed', ucwords('no') );
            $this->setAttribute('confirm_date', NULL);
        }
        return $this;
    }

    /**
     * Confirm employement
     * @param mixed $confirmDate
     * @return void
     */
    public function confirmation($confirmDate=null)
    {
        if(empty($confirmDate)){
            $confirmDate = Carbon::today();
        }else{
            $confirmDate = Carbon::createFromDate($confirmDate);
        }
        $status = JobStatus::findKey('Serving');
        $this->setAttribute('status_id', $status);
        $this->setAttribute('confirm_date', $confirmDate);
        $this->setConfirmed(true);
        $this->updateTenure();
        $this->saveQuietly();

        Confirmation::dispatch($this->staff);

    }

    /**
     * Cancel appointment
     *
     * @return void
     */
    public function dismiss()
    {
        $appointment = $this->getAppointment();
        $appointment->deactivate();

        $previous = $this->getPreviousProgress();
        $previous->activate();

        $this->setPosition(
            $previous->position, 
            $previous->grade, 
            $previous->scale,
            $previous->notch,
            $previous->start_date, 
            $previous->end_date
        );

        $this->setAppointed(false);
        $this->saveQuietly();

        Dismissal::dispatch($this->staff);
    }

    /**
     * Retire staff from work
     * @return void
     */
    public function retire()
    {
        $status = JobStatus::findKey('Retired');
        $this->setAttribute('status_id', $status);
        $this->setAppointed(false);
        $this->saveQuietly();
        $this->quitCareer();

        Retirement::dispatch($this->staff);
    }

    /**
     * Terminate staff contract
     * @return void
     */
    public function terminate()
    {
		$status = JobStatus::findKey('Terminated');
        $this->setAttribute('status_id', $status);
        $this->setAppointed(false);
        $this->saveQuietly();
        $this->quitCareer();

        Termination::dispatch($this->staff);
    }

    /**
     * Check whether should stop career
     *
     * @return boolean
     */
    public function shouldQuit()
    {
        $statuses = JobStatus::getQuitingStatus();
        return in_array($this->status_id, $statuses)? true:false;

    }

    /**
     * Check whether should resume career
     *
     * @return boolean
     */
    public function shouldResume()
    {
        $statuses = JobStatus::getResumingStatus();
        return in_array($this->status_id, $statuses)? true:false;

    }

    /**
     * End staff career
     *
     * @return void
     */
    public function quitCareer()
    {
        $this->staff->deactivate();

        $this->staff->disableAccount();

        foreach($this->progress()->get() as $progress){
            $progress->deactivate();
        }
    }

    /**
     * Resume career progress
     *
     * @return void
     */
    public function resumeCareer()
    {
        $this->staff->activate();

        $this->staff->enableAccount();

        $previousPost = $this->progress()->latest()->first();
        if(isset($previousPost)){
            $previousPost->activate();
        }

    }

}
