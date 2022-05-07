<?php

namespace Luanardev\Modules\Employees\Entities;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\Employees\Concerns\WithFinder;

class Qualification extends Model
{
    use WithFinder;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_employee_qualifications';

    /**
     * @var array
     */
    protected $fillable = ['id','employee_id','name', 'level', 'specialization', 'institution', 'country', 'year'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qualificationLevel()
    {
        return $this->belongsTo(QualificationLevel::class, 'level');
    }
	
	/**
     * @return string
     */
    public function getLevel()
    {
        return $this->qualificationLevel->name;
    }

}
