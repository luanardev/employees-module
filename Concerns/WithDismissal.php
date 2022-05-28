<?php
namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Support\Carbon;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\HRSettings\Entities\JobType;
use Luanardev\Modules\HRSettings\Entities\JobStatus;

trait WithDismissal
{

    /**
     * Get appointments ending in a particular year
     *
     * @param mixed $year
     * @return mixed
     */
    public static function getDismissing($year=null)
    {
        if(empty($year)){
            $year = Carbon::now()->year;
        }
        $type = self::getJobType('Permanent');
        $status = self::getJobStatus('Serving');

        return Employment::where('type_id', $type)
            ->where('status_id', $status)
            ->where('appointed', 'Yes')
            ->whereYear('end_date', $year)
            ->get();
    }

     /**
     * Get appointments ending in a particular year
     *
     * @param mixed $year
     * @return mixed
     */
    public static function getProbation($year=null)
    {
        if(empty($year)){
            $year = Carbon::now()->year;
        }
        $type = self::getJobType('Permanent');
        $status = self::getJobStatus('Probation');

        return Employment::where('type_id', $type)
            ->where('status_id', $status)
            ->where('confirmed', 'No')
            ->whereYear('end_date', $year)
            ->get();
    }

    /**
     * Get appointments ending today
     *
     * @param mixed $year
     * @return mixed
     */
    public static function getDismissingToday()
    {
        $date = Carbon::today();

        $type = self::getJobType('Permanent');
        $status = self::getJobStatus('Serving');

        return Employment::where('type_id', $type)
            ->where('status_id', $status)
            ->where('appointed', 'Yes')
            ->where('end_date', $date)
            ->get();
    }

    /**
     * Get contracts ending in a particular year
     *
     * @param mixed $year
     * @return mixed
     */
    public static function getTerminating($year=null)
    {
        if(empty($year)){
            $year = Carbon::now()->year;
        }
        $type = self::getJobType('Permanent');
        $status = self::getJobStatus('Serving');

        return Employment::where('type_id', '<>', $type)
            ->where('status_id', $status)
            ->whereYear('end_date', $year)
            ->get();
    }

    /**
     * Get contracts ending today
     *
     * @return mixed
     */
    public static function getTerminatingToday()
    {
        $date = Carbon::today();
        $type = self::getJobType('Permanent');
        $status = self::getJobStatus('Serving');

        return Employment::where('type_id','<>', $type)
            ->where('status_id', $status)
            ->where('end_date', $date)
            ->get();
    }

    /**
     * Get employees retiring in a particular year
     *
     * @param mixed $year
     * @return mixed
     */
    public static function getRetiring($year=null)
    {
        if(empty($year)){
            $year = Carbon::now()->year;
        }

        $type = self::getJobType('Permanent');
        $status = self::getJobStatus('Serving');
        
        return Employment::where('type_id', $type)
            ->where('type_id', $status)
            ->where('appointed', 'No')       
            ->whereYear('end_date', $year)
            ->get();
    }

    /**
     * Get employees retiring today
     *
     * @return mixed
     */
    public static function getRetiringToday()
    {
        $date = Carbon::today();
        $type = self::getJobType('Permanent');
        $status = self::getJobStatus('Serving');

        return Employment::where('type_id', $type)
            ->where('type_id', $status)
            ->where('appointed', 'No')
            ->where('end_date', $date)
            ->get();
    }

    /**
     * Get employment type key
     * @param string $name
     * @return mixed
     */
    protected static function getJobType($name)
    {
        return JobType::findKey($name);
    }

    /**
     * Get employment status key
     * @param string $name
     * @return mixed
     */
    protected static function getJobStatus($name)
    {
        return JobStatus::findKey($name);
    }


}
