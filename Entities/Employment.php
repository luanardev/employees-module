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
use Luanardev\Modules\Employees\Concerns\HasProgress;
use Luanardev\Modules\Employees\Concerns\WithQuietUpdate;
use Luanardev\Modules\Employees\Concerns\WithEmploymentHelper;
use Luanardev\Modules\Employees\Concerns\WithDismissal;
use Luanardev\Modules\Employees\Events\Dismissal;
use Luanardev\Modules\Employees\Events\Termination;
use Luanardev\Modules\Employees\Events\Retirement;
use Luanardev\Modules\Employees\Events\Confirmation;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use EmployeeSettings;

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
    protected $table = 'hrm_employment';

	/**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'employee_id';

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
        'employee_id', 'designation_id', 'branch_id', 'campus_id', 'department_id', 'section_id',
        'employment_type', 'employee_category', 'employment_status','grade', 'notch', 'start_date', 'end_date', 'appointed', 'confirmed',  'confirm_date'
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
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

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
        return $this->belongsTo(EmployeeCategory::class, 'employee_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(EmploymentStatus::class, 'employment_status');
    }

    /**
     * Set employment status
     * @param mixed $status
     * @return self
     */
    public function setStatus($status)
    {
        if(is_string($status)){
            $status = EmploymentStatus::findKey($status);
            $this->setAttribute('employment_status', $status);
        }
        elseif(is_numeric($status)){
            $this->setAttribute('employment_status', $status);
        }
        elseif($status instanceof EmploymentStatus){
            $this->setAttribute('employment_status', $status->getKey());
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
            $type = EmploymentType::findKey($type);
            $this->setAttribute('employment_type', $type);
        }
        elseif(is_numeric($type)){
            $this->setAttribute('employment_type', $type);
        }
        elseif($type instanceof EmploymentType){
            $this->setAttribute('employment_type', $type->getKey());
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
            $category = EmployeeCategory::findKey($category);
            $this->setAttribute('employee_category', $category);
        }
        elseif(is_numeric($category)){
            $this->setAttribute('employee_category', $category);
        }
        elseif($category instanceof EmployeeCategory){
            $this->setAttribute('employee_category', $category->getKey());
        }
        return $this;
    }

    /**
     * Check employee status
     *
     * @param mixed $status
     * @return boolean
     */
    public function isStatus($status)
    {
        if(is_string($status)){
            $status = EmploymentStatus::findKey($status);
            return ($this->employment_status == $status )? true:false;
        }
        elseif(is_numeric($status)){
            return ($this->employment_status == $status )? true:false;
        }
        elseif($status instanceof EmploymentStatus){
            return ($this->employment_status == $status->getKey() )? true:false;
        }

    }

    /**
     * Check employee type
     *
     * @param mixed $type
     * @return boolean
     */
    public function isType($type)
    {
        if(is_string($type)){
            $type = EmploymentType::findKey($type);
            return ($this->employment_type == $type )? true:false;
        }
        elseif(is_numeric($type)){
            return ($this->employment_type == $type )? true:false;
        }
        elseif($type instanceof EmploymentType){
            return ($this->employment_type == $type->getKey() )? true:false;
        }
    }

    /**
     * Check employee category
     *
     * @param mixed $category
     * @return boolean
     */
    public function isCategory($category)
    {
        if(is_string($category)){
            $category = EmployeeCategory::findKey($category);
            return ($this->employee_category == $category )? true:false;
        }
        elseif(is_numeric($category)){
            return ($this->employee_category == $category )? true:false;
        }
        elseif($category instanceof EmployeeCategory){
            return ($this->employee_category == $category->getKey() )? true:false;
        }
    }

    /**
     * Get retirement date
     *
     * @return Carbon
     */
    protected function retirementDate()
    {
        $retirementAge = (int)EmployeeSettings::get('retirement_age');
        return Carbon::createFromDate($this->employee->date_of_birth)
                ->addYears($retirementAge);
    }

    /**
     * Get retirement date
     *
     * @return Carbon
     */
    protected function probationEndDate()
    {
        $probationPeriod = (int)EmployeeSettings::get('probation_period');
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
     * @param Designation $designation
     * @param string $grade
     * @param mixed $notch
     * @param mixed $startdate
     * @param mixed $enddate
     * @return self
     */
    public function setPosition(Designation $designation, $grade, $notch, $startdate=null, $enddate=null)
    {
        $this->setAttribute('designation_id', $designation->id);
        $this->setAttribute('grade', $grade);
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
        $status = EmploymentStatus::findKey('Serving');
        $this->setAttribute('employment_status', $status);
        $this->setAttribute('confirm_date', $confirmDate);
        $this->setConfirmed(true);
        $this->updateTenure();
        $this->saveQuietly();

        Confirmation::dispatch($this->employee);

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
            $previous->designation, $previous->grade, $previous->notch,
            $previous->start_date, $previous->end_date
        );

        $this->setAppointed(false);
        $this->saveQuietly();

        Dismissal::dispatch($this->employee);
    }

    /**
     * Retire employee from work
     * @return void
     */
    public function retire()
    {
        $status = EmploymentStatus::findKey('Retired');
        $this->setAttribute('employment_status', $status);
        $this->setAppointed(false);
        $this->saveQuietly();
        $this->quitCareer();

        Retirement::dispatch($this->employee);
    }

    /**
     * Terminate employee contract
     * @return void
     */
    public function terminate()
    {
		$status = EmploymentStatus::findKey('Terminated');
        $this->setAttribute('employment_status', $status);
        $this->setAppointed(false);
        $this->saveQuietly();
        $this->quitCareer();

        Termination::dispatch($this->employee);
    }

    /**
     * Check whether should stop career
     *
     * @return boolean
     */
    public function shouldQuit()
    {
        $statuses = EmploymentStatus::getQuitingStatus();
        return in_array($this->employment_status, $statuses)? true:false;

    }

    /**
     * Check whether should resume career
     *
     * @return boolean
     */
    public function shouldResume()
    {
        $statuses = EmploymentStatus::getResumingStatus();
        return in_array($this->employment_status, $statuses)? true:false;

    }

    /**
     * End employee career
     *
     * @return void
     */
    public function quitCareer()
    {
        $this->employee->deactivate();

        $this->employee->disableAccount();

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
        $this->employee->activate();

        $this->employee->enableAccount();

        $previousPost = $this->progress()->latest()->first();
        if(isset($previousPost)){
            $previousPost->activate();
        }

    }

}
