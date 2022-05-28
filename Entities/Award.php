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
    protected $table = 'hrm_staff_awards';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'name', 'institution', 'country', 'year'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

}
