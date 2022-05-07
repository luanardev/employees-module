<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Concerns\WithFinder;

class Award extends Model
{
    use WithFinder;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_employee_awards';

    /**
     * @var array
     */
    protected $fillable = ['id','employee_id', 'name', 'institution', 'country', 'year'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
