<?php
namespace Luanardev\Modules\Employees\Concerns;
use Illuminate\Support\Carbon;
use Luanardev\Modules\Employees\Entities\Employment;
use Luanardev\Modules\Employees\Entities\EmploymentType;
use Luanardev\Modules\Employees\Entities\EmploymentStatus;

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
        $type = self::getEmploymentType('Permanent');
        $status = self::getEmploymentStatus('Serving');

        return Employment::where('employment_type', $type)
            ->where('employment_status', $status)
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
        $type = self::getEmploymentType('Permanent');
        $status = self::getEmploymentStatus('Probation');

        return Employment::where('employment_type', $type)
            ->where('employment_status', $status)
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

        $type = self::getEmploymentType('Permanent');
        $status = self::getEmploymentStatus('Serving');

        return Employment::where('employment_type', $type)
            ->where('employment_status', $status)
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
        $type = self::getEmploymentType('Permanent');
        $status = self::getEmploymentStatus('Serving');

        return Employment::where('employment_type', '<>', $type)
            ->where('employment_status', $status)
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
        $type = self::getEmploymentType('Permanent');
        $status = self::getEmploymentStatus('Serving');

        return Employment::where('employment_type','<>', $type)
            ->where('employment_status', $status)
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

        $type = self::getEmploymentType('Permanent');
        $status = self::getEmploymentStatus('Serving');
        
        return Employment::where('employment_type', $type)
            ->where('employment_type', $status)
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
        $type = self::getEmploymentType('Permanent');
        $status = self::getEmploymentStatus('Serving');

        return Employment::where('employment_type', $type)
            ->where('employment_type', $status)
            ->where('appointed', 'No')
            ->where('end_date', $date)
            ->get();
    }

    /**
     * Get employment type key
     * @param string $name
     * @return mixed
     */
    protected static function getEmploymentType($name)
    {
        return EmploymentType::findKey($name);
    }

    /**
     * Get employment status key
     * @param string $name
     * @return mixed
     */
    protected static function getEmploymentStatus($name)
    {
        return EmploymentStatus::findKey($name);
    }


}
