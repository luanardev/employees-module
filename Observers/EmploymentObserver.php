<?php

namespace Luanardev\Modules\Employees\Observers;

use Luanardev\Modules\HRSettings\Entities\ProgressType;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\Progress;
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

        if($employment->wasChanged('status_id') ){
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
        elseif($employment->wasChanged('type_id') ){
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
        $progress->staff()->associate($employment->staff);
        $progress->position()->associate($employment->position);
        $progress->progressType()->associate($progressType);
        $progress->grade()->associate($employment->grade);
        $progress->scale = $employment->scale;
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
        $progress->position_id = $employment->position_id;
        $progress->grade_id = $employment->grade_id;
        $progress->scale = $employment->scale;
        $progress->notch = $employment->notch;
        $progress->start_date = $employment->start_date;
        $progress->end_date = $employment->end_date;
        $progress->saveQuietly();
    }

    /**
     * Check whether position or grade or scale has changed
     *
     * @param Employment $employment
     * @return boolean
     */
    protected function shouldUpdateProgress(Employment $employment)
    {
        if($employment->wasChanged('position_id') ||
            $employment->wasChanged('grade_id') ||
            $employment->wasChanged('scale') ||
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
