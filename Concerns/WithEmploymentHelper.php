<?php

namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Support\Carbon;

trait WithEmploymentHelper
{
    /**
     * Set serving status
     * @return self
     */
    public function setServing()
    {
        return $this->setStatus('Serving');
    }

    /**
     * Set permanent type
     * @return self
     */
    public function setPermanent()
    {
        return $this->setType('Permanent');
    }

    /**
     * Check whether staff is serving
     * @return bool
     */
    public function isServing()
    {
        return $this->isStatus('Serving');
    }

    /**
     * Check whether staff is serving
     * @return bool
     */
    public function isProbation()
    {
        return $this->isStatus('Probation');
    }

    /**
     * Check whether staff is not permanent
     * @return bool
     */
    public function isNotServing()
    {
        return !$this->isServing();
    }

    /**
     * Check whether staff is permanent
     * @return bool
     */
    public function isPermanent()
    {
        return $this->isType('Permanent');
    }

    /**
     * Check whether staff is not permanent
     * @return bool
     */
    public function isNotPermanent()
    {
        return !$this->isPermanent();
    }

    /**
      * Check wether staff is appointed
     * @return bool
     */
    public function isAppointed()
    {
        return (strtolower($this->appointed) == strtolower('yes') )? true:false;
    }

    /**
      * Check wether staff is appointed
     * @return bool
     */
    public function isNotAppointed()
    {
        return (strtolower($this->appointed) == strtolower('no') )? true:false;
    }

    /**
      * Check wether staff is appointed
     * @return bool
     */
    public function isConfirmed()
    {
        return (strtolower($this->confirmed) == strtolower('yes') )? true:false;
    }

    /**
      * Check wether staff is confirmed
     * @return bool
     */
    public function isNotConfirmed()
    {
        return !$this->isConfirmed();
    }

    /**
     * Check whether staff is academic
     * @return bool
     */
    public function isAcademic()
    {
        return $this->isCategory('Academic');
    }

    /**
     * @return bool
     */
    public function isNotAcademic()
    {
        return !$this->isAcademic();
    }

    /**
     * Check whether staff is administrative
     * @return bool
     */
    public function isAdministrative()
    {
        return $this->isCategory('Administrative');
    }

    /**
     * Check whether staff is support
     * @return bool
     */
    public function isSupport()
    {
        return $this->isCategory('Support');
    }

	/**
     * @return string
     */
    public function getPosition()
    {
        return isset($this->position->name)? $this->position->name: null;
    }

    /**
     * @return string
     */
    public function getDepartment()
    {
        return isset($this->department->name)? $this->department->name: null;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return isset($this->section->name)? $this->section->name: null;
    }

    /**
     * @return string
     */
    public function getCampus()
    {
        return isset($this->campus->name)? $this->campus->name: null;
    }

    /**
     * @return string
     */
    public function getBranch()
    {
        return isset($this->branch->name)? $this->branch->name: null;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return isset($this->category->name)? $this->category->name: null;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return isset($this->type->name)? $this->type->name: null;
    }

    /**
     * @return string
     */
    public function getGrade()
    {
        return isset($this->grade->name)? $this->grade->name: null;
    }

    /**
     * @return string
     */
    public function getScale()
    {
        return isset($this->scale) ?  "{$this->scale} - {$this->notch}" : null;
    }

    /**
     * @return string
     */
    public function getGradeScale()
    {
        return isset($this->grade->name) ?  " {$this->grade->name} ( {$this->scale} - {$this->notch} )" : null;
    }

	/**
     * @return string
     */
    public function getStatus()
    {
        return isset($this->status->name)? $this->status->name: null;
    }

    /**
     * Get either department or section
     *
     * @return void
     */
    public function getDivision()
    {
        if($this->isAcademic()){
            return isset($this->department_id) ?  $this->getDepartment(): null;
        }
        else{
            return isset($this->section_id) ?  $this->getSection(): null;
        }
    }

    /**
     * Get years of service
     */
    public function elapsedPeriod()
    {
        return isset($this->start_date) ? Carbon::createFromDate($this->start_date)
            ->diff(Carbon::now())->format('%y Years, %m Months') : null;
    }

    /**
     * Get remaining years of service
     */
    public function remainingPeriod()
    {
        return isset($this->end_date) ? Carbon::createFromDate($this->end_date)
            ->diff(Carbon::now())->format('%y Years, %m Months') : null;
    }

    /**
     * Get contract period
     */
    public function contractPeriod()
    {
        return isset($this->start_date) && isset($this->end_date) ?
            Carbon::createFromDate($this->start_date)->diff($this->end_date)->format('%y Years, %m Months') : null;
    }

    /**
     * Employee joining date
     *
     * @return string
     */
    public function startDate()
    {
        return (isset($this->start_date))? $this->start_date->format('d-M-Y'):null;

    }

    /**
     * Employee confirmed date
     *
     * @return string
     */
    public function confirmDate()
    {
        return (isset($this->confirm_date))? $this->confirm_date->format('d-M-Y'):null;
    }

    /**
     * Employee exit date
     *
     * @return string
     */
    public function endDate()
    {
        return (isset($this->end_date)) ? $this->end_date->format('d-M-Y'):null;
    }

    /**
     * Status
     *
     * @return string
     */
    public function appointmentBadge()
    {
        return $this->isAppointed()?
            "<span class='badge badge-success'>{$this->appointed}</span>":
            "<span class='badge badge-danger'>{$this->appointed}</span>";
    }

    /**
     * Status
     *
     * @return string
     */
    public function confirmationBadge()
    {
        return $this->isConfirmed()?
            "<span class='badge badge-success'>{$this->confirmed}</span>":
            "<span class='badge badge-danger'>{$this->confirmed}</span>";
    }

	/**
     * Status
     *
     * @return string
     */
    public function statusBadge()
    {
        return $this->isServing()?
            "<span class='badge badge-success'>{$this->getStatus()}</span>":
            "<span class='badge badge-danger'>{$this->getStatus()}</span>";
    }
}
