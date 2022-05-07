<?php
namespace Luanardev\Modules\Employees\Concerns;

trait WithFinder
{

    /**
     * Find record by name
     * @param mixed $name
     * @return self
     */
    public static function findByName($name)
    {
        $record =  static::where('name', $name)->first();
        if(empty($record)){
            return null;
        }
        return $record;
    }

	/**
     * Find record identifier
     * @param string $name
     * @return self
     */
    public static function findKey($name)
    {
        $record = static::findByName($name);
		if(!empty($record)){
			return $record->getKey();
		}
    }

    /**
     * Check whethe record exists already
     *
     * @param string $name
     * @return boolean
     */
    public static function recordExists($name)
    {
        $record = static::findByName($name);
        return !empty($record) ? true:false;

    }

    /**
     * Check name
     *
     * @param mixed $name
     * @return boolean
     */
    public function isNamed($name)
    {
        return (strtolower($this->name) == strtolower($name) )? true:false;
    }

    /**
     * Search Scope for Laravel Livewire DataTable
     * @var Illuminate\Database\Eloquent\Builder $query
     * @var string $term
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(
            fn ($query) => $query->where('name', 'like', "%{$term}%")
        );
    }

}
