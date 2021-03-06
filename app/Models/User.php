<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the Events for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        public function Events()
        {
            return $this->hasMany(Events::class, 'user_id', 'id');
        }

            /**
             * Get the profiles associated with the User
             *
             * @return \Illuminate\Database\Eloquent\Relations\HasOne
             */
            public function profiles()
            {
                return $this->hasOne(profiles::class, 'user_id', 'id');
            }

        public function skill()
            {
        return $this->belongsToMany(skill::class, 'user__skills', 'user_id', 'skill_id');
            }

        public function offers()
            {
        return $this->hasMAny(Offers::class, 'user_id');
            } 
            
            
            public function role()
            {
        return $this->belongsTo(Role::class);
            } 


    }
