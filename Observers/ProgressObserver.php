<?php

namespace Luanardev\Modules\Employees\Observers;

use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\Employees\Entities\ProgressType;
use Luanardev\Modules\Employees\Entities\Employee;
use Luanardev\Modules\Employees\Events\Promotion;


class ProgressObserver
{

    /**
     * Handle the Progress "creating" event.
     *
     * @param  Progress  $progress
     * @return void
     */
    public function creating(Progress $progress)
    {
        $employee = $progress->employee;
        $previousPost = $this->getPreviousPost($employee);
        if(!empty($previousPost)){
            $previousPost->deactivate();
        }

    }

    /**
     * Handle the Progress "created" event.
     *
     * @param  Progress  $progress
     * @return void
     */
    public function created(Progress $progress)
    {
        $employment = $progress->employee->employment;

        $employment->setPosition(
            $progress->designation,
            $progress->grade,
            $progress->notch,
            $progress->start_date,
            $progress->end_date
        );

        $employment->setServing();

        if($progress->isAppointment()){
            $employment->setConfirmed(true);
            $employment->setAppointed(true);
            $employment->saveQuietly();
        }
        elseif($progress->isContract()){
            $employment->setConfirmed(false);
            $employment->saveQuietly();
        }
        else{
            if($employment->isPermanent()){
                $employment->setConfirmed(true);
                $employment->saveQuietly();
            }
        }

        Promotion::dispatch($progress);
    }

    /**
     * Handle the Progress "deleted" event.
     *
     * @param  Progress  $progress
     * @return void
     */
    public function deleted(Progress $progress)
    {
        $employee = $progress->employee;

        $employment = $employee->employment;

        $previousPost = $this->getPreviousPost($employee);
        if(empty($previousPost)){
            return false;
        }

        $previousPost->activate();

        $employment->setTenure($previousPost->start_date, $previousPost->end_date)
            ->setType($previousPost->getType())
            ->setAppointed(false)
            ->setServing();

        $employment->setPosition(
            $previousPost->designation,
            $previousPost->grade,
            $previousPost->notch,
            $previousPost->start_date,
            $previousPost->end_date
        );

        if($progress->isAppointment() || $progress->isPromotion() || $progress->isIncrement()){
            $employment->setConfirmed(true);
            $employment->setPermanent();
            $employment->saveQuietly();
        }
        elseif($progress->isContract()){
            $employment->setConfirmed(false);
            $employment->saveQuietly();
        }
        elseif($progress->isPermanent()){
            $employment->setConfirmed(false);
            $employment->saveQuietly();
        }
        else{
            if($employment->isPermanent()){
                $employment->setConfirmed(true);
                $employment->saveQuietly();
            }
        }

    }

    /**
     * Get previous employment record
     *
     * @param Employee $employee
     * @return Progress
     */
    protected function getPreviousPost(Employee $employee)
    {
        $type = self::getProgressType('Appointment');
        return $employee->progress()
            ->where('progress_type', '<>', $type)
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
