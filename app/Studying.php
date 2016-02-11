<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Studying extends Model
{
    public $table = 'studying';
    protected $guarded = [];

    protected $fillable = ['set_id', 'user_id'];

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function sets()
    {
        return $this->hasMany(User::class, 'sets');
    }

    public function addStudy($setId, $userId)
    {
        $this->set_id = $setId;
        $this->user_id = $userId;
        $this->save();
    }

    public function removeStudy($setId, $userId)
    {
        $studyEntry = Studying::where('set_id', $setId)->where('user_id', $userId);
        $studyEntry->delete();
    }
}
