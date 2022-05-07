<?php
namespace Luanardev\Modules\Employees\Concerns;

trait WithProgressHelper
{
	/**
     * @return string
     */
    public function getType()
    {
        return $this->progressType->name;
    }

	/**
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation->name;
    }

    /**
     * @return bool
     */
    public function isContract()
    {
        return $this->isType('Contract');
    }

    /**
     * @return bool
     */
    public function isNotContract()
    {
        return !$this->isContract();
    }

    /**
     * @return bool
     */
    public function isAppointment()
    {
        return $this->isType('Appointment');
    }

    /**
     * @return bool
     */
    public function isNotAppointment()
    {
        return !$this->isAppointment();
    }

    /**
     * @return bool
     */
    public function isPermanent()
    {
        return $this->isType('Permanent');
    }

    /**
     * @return bool
     */
    public function isNotPermanent()
    {
        return !$this->isPermanent();
    }

    /**
     * @return bool
     */
    public function isPromotion()
    {
        return $this->isType('Promotion');
    }

    /**
     * @return bool
     */
    public function isNotPromotion()
    {
        return !$this->isPromotion();
    }

    /**
     * @return bool
     */
    public function isIncrement()
    {
        return $this->isType('Increment');
    }

    /**
     * @return bool
     */
    public function isNotIncrement()
    {
        return !$this->isIncrement();
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (strtolower($this->status) == strtolower('active'))? true:false;
    }

    /**
     * @return bool
     */
    public function isNotActive()
    {
        return !$this->isActive();
    }

    /**
     * @param string $grade
     * @param int $notch
     */
    public function grading($grade, $notch)
    {
        $this->setAttribute('grade', $grade);
        $this->setAttribute('notch', $notch);
    }

    /**
     * @return string
     */
    public function gradeScale()
    {
        return isset($this->grade) ? "{$this->grade} - {$this->notch}" : null;
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
    public function statusBadge()
    {
        return (strtolower($this->status) == strtolower('active'))?
            "<span class='badge badge-success'>{$this->status}</span>":
            "<span class='badge badge-danger'>{$this->status}</span>";
    }

}
