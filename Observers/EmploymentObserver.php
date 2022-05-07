<?php

namespace Luanardev\Modules\Employees\Observers;

use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\Progress;
use Luanardev\Modules\Employees\Entities\ProgressType;
use Luanardev\Modules\Employees\Events\EmploymentCreated;

class EmploymentObserver
{

    /**
     * Handle the Employment "updating" event.
     *
     * @param  Employment  $employment
     * @return void
     */
    public function creating(Employment $employment)
    {
        if(empty($employment->branch_id)){
            $branch = $employment->campus->branch;
            $employment->branch()->associate($branch);
        }
    }

    /**
     * Handle the Employment "created" event.
     *
     * @param  Employment  $employment
     * @return void
     */
    public function created(Employment $employment)
    {
        $employment->setAppointed(false)->saveQuietly();
        $this->createProgress($employment);
        EmploymentCreated::dispatch($employment);

    }

    /**
     * Handle the Employment "updated" event.
     *
     * @param  Employment  $employment
     * @return void
     */
    public function updated(Employment $employment)
    {
        if($this->shouldUpdateProgress($employment)){
            $this->updateProgress($employment);
        }

        if($employment->wasChanged('employment_status') ){
            if($employment->isProbation()){
                $employment->setProbation();
            }
            elseif($employment->shouldQuit()){
                $employment->quitCareer();
            }
            elseif($employment->shouldResume()){
                $employment->resumeCareer();
            }
        }
        elseif($employment->wasChanged('employment_type') ){
            if($employment->isPermanent()){
                $previousPost = $employment->getPreviousProgress();
                if($previousPost->isNotPermanent()){
                    $previousPost->deactivate();
                    $employment->updateTenure();
                    $this->createProgress($employment);
                }
            }
        }
    }

    /**
     * Create progress record
     *
     * @param Employment $employment
     * @return void
     */
    protected function createProgress(Employment $employment)
    {
        $progressType = $this->progressType($employment);
        $progress = new Progress;
        $progress->employee()->associate($employment->employee);
        $progress->designation()->associate($employment->designation);
        $progress->progressType()->associate($progressType);
        $progress->grade = $employment->grade;
        $progress->notch = $employment->notch;
        $progress->start_date = $employment->start_date;
        $progress->end_date = $employment->end_date;
        $progress->saveQuietly();
    }

    /**
     * Create employment record
     *
     * @param Employment $employment
     * @return void
     */
    protected function updateProgress(Employment $employment)
    {
        $progress = $employment->progress()->latest()->first();
        $progress->designation_id = $employment->designation_id;
        $progress->grade = $employment->grade;
        $progress->notch = $employment->notch;
        $progress->start_date = $employment->start_date;
        $progress->end_date = $employment->end_date;
        $progress->saveQuietly();
    }

    /**
     * Check whether designation or grade or scale has changed
     *
     * @param Employment $employment
     * @return boolean
     */
    protected function shouldUpdateProgress(Employment $employment)
    {
        if($employment->wasChanged('designation_id') ||
            $employment->wasChanged('grade') ||
            $employment->wasChanged('notch') ||
            $employment->wasChanged('start_date') ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get Progress Type
     *
     * @param Employment $employment
     * @return void
     */
    protected function progressType(Employment $employment)
    {
        if($employment->isPermanent()){
            return ProgressType::findByName('Permanent');
        }
        else{
            return ProgressType::findByName('Contract');
        }
    }

}
