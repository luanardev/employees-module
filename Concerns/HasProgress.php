<?php
namespace Luanardev\Modules\Employees\Concerns;
use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\HRSettings\Entities\ProgressType;

trait HasProgress
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function progress()
    {
        return $this->hasMany(Progress::class, 'staff_id');
    }

    /**
     * Get progressions ordered by status
     *
     * @return mixed
     */
    public function orderedProgress()
    {
        return $this->progress()->orderBy('status')->latest()->get();
    }

    /**
     * Get previous career record
     *
     * @return Progress
     */
    public function getPreviousProgress()
    {
        $type = self::getProgressType('Appointment');
        return $this->progress()
            ->where('progress_type', '<>', $type)
            ->latest()
            ->first();
    }

    /**
     * Get active appointment record
     *
     * @return Progress
     */
    public function getAppointment()
    {
        $type = self::getProgressType('Appointment');
        return $this->progress()
            ->where('progress_type',  $type)
            ->latest()
            ->first();
    }

    /**
     * Get progress type key
     * @param string $name
     * @return mixed
     */
    protected static function getProgressType($name)
    {
        return ProgressType::findKey($name);
    }



}
