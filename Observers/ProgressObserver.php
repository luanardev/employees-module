<?php

namespace Luanardev\Modules\Employees\Observers;

use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\HRSettings\Entities\ProgressType;
use Luanardev\Modules\Employees\Entities\Staff;
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
        $staff = $progress->staff;
        $previousPost = $this->getPreviousPost($staff);
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
        $employment = $progress->staff->employment;

        $employment->setPosition(
            $progress->position,
            $progress->grade,
            $progress->scale,
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
        $staff = $progress->staff;

        $employment = $staff->employment;

        $previousPost = $this->getPreviousPost($staff);
        if(empty($previousPost)){
            return false;
        }

        $previousPost->activate();

        $employment->setTenure($previousPost->start_date, $previousPost->end_date)
            ->setType($previousPost->getType())
            ->setAppointed(false)
            ->setServing();

        $employment->setPosition(
            $previousPost->position,
            $previousPost->grade,
            $previousPost->scale,
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
     * @param Staff $staff
     * @return Progress
     */
    protected function getPreviousPost(Staff $staff)
    {
        $type = self::getProgressType('Appointment');
        return $staff->progress()
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
