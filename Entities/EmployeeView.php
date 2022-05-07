<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Institution\Entities\Campus;
use Luanardev\Modules\Institution\Concerns\CampusPicker;

class EmployeeView extends Model
{
    use CampusPicker;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_employee_view';

    /**
     * Search Scope for Laravel Livewire DataTable
     * @var Illuminate\Database\Eloquent\Builder $query
     * @var string $term
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(
            fn ($query) => $query->where('id', 'like', "%{$term}%")
                ->orWhere('firstname', 'like', "%{$term}%")
                ->orWhere('lastname', 'like', "%{$term}%")
                ->orWhere('fullname', 'like', "%{$term}%")
        );
    }

    /**
     * Get Employees By Authenticated User Campus
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function getByCampus()
    {      
        $campus = static::getUserCampus();
        if(empty($campus)){
            return static::query();        
        }else{
            return static::findByCampus($campus->name);
        }        
    }

    /**
     * Search Scope for Laravel Livewire DataTable
     * @var string $term
     */
    public static function search($term)
    {
        return static::where('id', 'like', "%{$term}%")
                ->orWhere('firstname', 'like', "%{$term}%")
                ->orWhere('lastname', 'like', "%{$term}%")
                ->orWhere('fullname', 'like', "%{$term}%");
    }

    /**
     * Get Employees By Campus Name
     * @return Illuminate\Database\Eloquent\Builder
     */
    public static function findByCampus($name)
    {
        return static::where('campus', $name);
    }

}
