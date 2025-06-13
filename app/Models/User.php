<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;


class User extends Authenticatable /* implements FilamentUser */
{
    use HasApiTokens,HasRoles, HasFactory, Notifiable, SoftDeletes ,LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = "users";

   

    protected $fillable = [
        'name',
        'national_health_facility_registries_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'uni_id' => 'integer',
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable();
        
      
    }


public function roles()
{
    return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')
        ->select('*','roles.name as role'); 
}

// public function hasRole($roles)
// {
//     return $this->roles()->whereIn('name', (array)$roles)->exists();
// }

// public function units()
// {
//     return $this->belongsTo(Unit::class, 'unit_id');
// }

public function GetFacilityNameAttribute(){

    return 'Sample Facility';
}



}
