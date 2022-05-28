<?php

namespace Luanardev\Modules\Employees\Entities;
use Illuminate\Database\Eloquent\Model;
use Luanardev\Modules\HRSettings\Entities\QualificationLevel;
use Luanardev\Modules\Employees\Concerns\WithFinder;

class Qualification extends Model
{
    use WithFinder;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_staff_qualifications';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['id','staff_id','name', 'level', 'specialization', 'institution', 'country', 'year'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
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
