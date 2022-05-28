<?php

namespace Luanardev\Modules\Employees\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Luanardev\Modules\Employees\Concerns\WithDeanship;
use Luanardev\Modules\Employees\Concerns\WithHeadship;
use Luanardev\Modules\Employees\Concerns\WithManagership;
use Luanardev\Modules\Employees\Concerns\WithStaffHelper;
use Luanardev\Modules\Employees\Concerns\WithEmailNotification;
use Luanardev\Modules\Employees\Concerns\WithQuietUpdate;
use Luanardev\Modules\Employees\Concerns\WithOfficialEmail;
use Luanardev\Modules\Employees\Concerns\WithGeneratedID;
use Luanardev\Modules\Employees\Concerns\WithUserAccount;
use Luanardev\Modules\Employees\Concerns\HasEmployment;
use Luanardev\Modules\Employees\Concerns\HasProgress;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


class Staff extends Model
{
    use WithDeanship,
        WithHeadship,
        WithManagership,
        WithStaffHelper,
        WithEmailNotification,
        WithQuietUpdate,
        WithOfficialEmail,
        WithGeneratedID,
        WithUserAccount,
        HasEmployment,
        HasProgress,
        HasFactory,
        Notifiable,
        Loggable;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hrm_staff_members';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id','national_id', 'title', 'firstname', 'lastname', 'middlename', 'maidenname','date_of_birth', 'gender', 'marital_status',
        'official_email', 'personal_email', 'contact_address', 'phone1', 'phone2', 'qualification', 'residence_country',
        'nationality', 'home_country', 'home_village', 'home_authority', 'home_district', 'avatar','signature', 'status',
        'disabled', 'convicted', 'disability', 'conviction', 'medical_condition'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
    ];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];
	
	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employment()
    {
        return $this->hasOne(Employment::class, 'staff_id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function spouse()
    {
        return $this->hasOne(Spouse::class, 'staff_id')->withDefault();
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kinsman()
    {
        return $this->hasOne(Kinsman::class, 'staff_id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function awards()
    {
        return $this->hasMany(Award::class, 'staff_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dependants()
    {
        return $this->hasMany(Dependant::class, 'staff_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qualifications()
    {
        return $this->hasMany(Qualification::class, 'staff_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experience()
    {
        return $this->hasMany(Experience::class, 'staff_id');
    }
	
	/**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'staff_id');
    }

    /**
     * Check whether staff has spouse
     *
     * @return boolean
     */
    public function hasSpouse()
    {
        return(!is_null($this->spouse->getKey()))?true:false;
    }

    /**
     * Check whether staff has spouse
     *
     * @return boolean
     */
    public function hasKinsman()
    {
        return(!is_null($this->kinsman->getKey()))?true:false;
    }
	
	/**
     * Check whether staff has employment
     *
     * @return boolean
     */
    public function hasEmployment()
    {
        return(!is_null($this->employment->getKey()))?true:false;
    }
    
    /**
     * Activate staff
     */
    public function activate()
    {
        $this->setAttribute('status', 'Active');
        $this->saveQuietly();
    }

    /**
     * Deactivate staff
     */
    public function deactivate()
    {
        $this->setAttribute('status', 'Inactive');
        $this->saveQuietly();
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
            fn ($query) => $query->where('id', 'like', "%{$term}%")
                ->orwhere('national_id', 'like', "%{$term}%")
                ->orWhere('firstname', 'like', "%{$term}%")
                ->orWhere('lastname', 'like', "%{$term}%")
        );
    }

    /**
     * Search Scope for Laravel Livewire DataTable
     * @var string $term
     */
    public static function search($term)
    {
        return static::where('id', 'like', "%{$term}%")
                ->orwhere('national_id', 'like', "%{$term}%")
                ->orWhere('firstname', 'like', "%{$term}%")
                ->orWhere('lastname', 'like', "%{$term}%");
    }

    /**
     * Find Staff by email
     *
     * @param string $email
     * @return self|null
     */
    public static function findByEmail($email)
    {
        return static::where('official_email', $email)
                ->orWhere('personal_email', $email)
                ->first();

    }

}
