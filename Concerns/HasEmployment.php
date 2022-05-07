<?php
namespace Luanardev\Modules\Employees\Concerns;
use Luanardev\Modules\Employees\Entities\Employment;
use Illuminate\Support\Carbon;

trait HasEmployment
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function designation()
    {
        return $this->employment->designation();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->employment->department();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->employment->section();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campus()
    {
        return $this->employment->campus();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->employment->category();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->employment->type();
    }

    /**
     * Check employee status
     *
     * @param string $status
     * @return boolean
     */
    public function isStatus($status)
    {
        return $this->employment->isStatus($status);
    }

    /**
     * Check employee type
     *
     * @param string $type
     * @return boolean
     */
    public function isType($type)
    {
        return $this->employment->isType($type);
    }

    /**
     * Check employee category
     *
     * @param string $category
     * @return boolean
     */
    public function isCategory($category)
    {
        return $this->employment->isCategory($category);
    }

    /**
     * Check whether employee is permanent
     * @return bool
     */
    public function isPermanent()
    {
        return $this->employment->isPermanent();
    }

    /**
     * Check whether employee is not permanent
     * @return bool
     */
    public function isNotPermanent()
    {
        return $this->employment->isNotPermanent();
    }

    /**
      * Check wether employee is appointed
     * @return bool
     */
    public function isAppointed()
    {
        return $this->employment->isAppointed();
    }

    /**
     * Check whether employee is not appointed
     * @return bool
     */
    public function isNotAppointed()
    {
        return $this->employment->isNotAppointed();
    }

    /**
      * Check wether employee is appointed
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->employment->isConfirmed();
    }

    /**
      * Check wether employee is confirmed
     * @return bool
     */
    public function isNotConfirmed()
    {
        return $this->employment->isNotConfirmed();
    }

    /**
     * Check whether employee is academic
     * @return bool
     */
    public function isAcademic()
    {
        return $this->employment->isAcademic();
    }

    /**
     * Check whether employee is administrative
     * @return bool
     */
    public function isAdministrative()
    {
        return $this->employment->isAdministrative();
    }

    /**
     * Check whether employee is support
     * @return bool
     */
    public function isSupport()
    {
        return $this->employment->isSupport();
    }

	/**
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation->name;
    }

    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->department->name;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return $this->section->name;
    }

    /**
     * @return string
     */
    public function getCampus()
    {
        return $this->campus->name;
    }

    /**
     * @return string
     */
    public function getBranch()
    {
        return $this->branch->name;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type->name;
    }

	/**
     * @return string
     */
    public function getStatus()
    {
        return $this->status->name;
    }

    /**
     * Get either department or section
     *
     * @return void
     */
    public function division()
    {
        if($this->isAcademic()){
            return isset($this->employment->department_id) ?  $this->getDepartment(): null;
        }
        else{
            return isset($this->employment->section_id) ?  $this->getSection(): null;
        }
    }

    /**
     * Get years of service
     */
    public function elapsedPeriod()
    {
        return Carbon::createFromDate($this->employment->start_date)
            ->diff(Carbon::now())->format('%y Years, %m Months');
    }

    /**
     * Get remaining years of service
     */
    public function remainingPeriod()
    {
        return Carbon::createFromDate($this->employment->end_date)
            ->diff(Carbon::now())->format('%y Years, %m Months');
    }

    /**
     * Get contract period
     */
    public function contractPeriod()
    {
        return Carbon::createFromDate($this->employment->start_date)
            ->diff($this->employment->end_date)->format('%y Years, %m Months');
    }

    /**
     *Grade Notch
     *
     * @return string
     */
    public function gradeScale()
    {
        return "Grade {$this->employment->grade} - {$this->employment->notch}";
    }

    /**
     * Employee joining date
     *
     * @return string
     */
    public function startDate()
    {
        return (isset($this->employment->start_date))? $this->employment->start_date->format('d-M-Y'):null;

    }

    /**
     * Employee confirmed date
     *
     * @return string
     */
    public function confirmDate()
    {
        return (isset($this->employment->confirm_date))? $this->employment->confirm_date->format('d-M-Y'):null;

    }

    /**
     * Employee exit date
     *
     * @return string
     */
    public function endDate()
    {
        return (isset($this->employment->end_date)) ? $this->employment->end_date->format('d-M-Y'):null;
    }



}
