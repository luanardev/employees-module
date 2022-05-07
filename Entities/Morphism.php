<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Morphism extends Model
{
    /** 
     * Disable timestamp
     * var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_morphism';

    /**
     * @var array
     */
    protected $fillable = ['employee_id', 'model_id', 'model_type', 'model_name'];


    /**
     * Link Employee to Model in Polymorphic relationship
     *
     * @param Employee $employee
     * @param Model $model
     */
    public function link(Employee $employee, Model $model)
    {

        $classname = (new ReflectionClass($model))->getShortName();
        $namespace = (new ReflectionClass($model))->getName();

        $this->setAttribute('employee_id', $employee->getKey());
        $this->setAttribute('model_id',    $model->getKey());
        $this->setAttribute('model_type',  $namespace);
        $this->setAttribute('model_name',  $classname);

        return $this->save();
    }

    /**
     * UnLink Employee to Model in Polymorphic relationship
     *
     * @param Employee $employee
     * @param Model $model
     */
    public function unlink(Employee $employee, Model $model)
    {
        $classname = (new ReflectionClass($model))->getShortName();
        $namespace = (new ReflectionClass($model))->getName();

        return EmployeeMorphism::where('employee_id', $employee->getKey())
                    ->where('model_id',    $model->getKey())
                    ->where('model_type',  $namespace)
                    ->delete();
    }




}
