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
    public function getPosition()
    {
        return $this->position->name;
    }

    /**
     * @return string
     */
    public function getGrade()
    {
        return isset($this->grade->name) ? $this->grade->name : null;
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
     * Staff joining date
     *
     * @return string
     */
    public function startDate()
    {
        return (isset($this->start_date))? $this->start_date->format('d-M-Y'):null;

    }

    /**
     * Staff exit date
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
