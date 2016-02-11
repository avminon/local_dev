<?php

namespace App;

use Config;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'terms';
    protected $guarded = [];

    protected $fillable = ['question', 'answer'];

    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'term_id');
    }

    public function assign($values)
    {

        $this->set_id = $values->input('set_id');
        $this->question = $values->input('term_question');
        $this->answer = $values->input('term_answer');

        $this->save();
    }
}
