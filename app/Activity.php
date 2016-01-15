<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Activity extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class,'lesson_id');
    }

    public function get_activities(){
        $activities = DB::table('activities')
                ->leftJoin('lessons', 'lessons.id', '=', 'activities.lesson_id')
                ->where('user_id', '=' , Auth::getAuthIdentifier())
                ->get();
        return $activities;
    }
}
