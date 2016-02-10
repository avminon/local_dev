<?php

namespace App;

use Config;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{

    protected $guarded = [];

    protected $fillable = ['category_id', 'user_id', 'availability', 'image', 'name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function terms()
    {
        return $this->hasMany(Term::class, 'set_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'set_id');
    }

    public function getImageAttribute($values)
    {
        return (!empty($values)) ? $values : 'noimage.png';
    }

    public function assign($values)
    {
        if (!is_null($values->input('category_id'))) {
            $this->id = $values->input('category_id');
        }

        $path = config()->get('paths.set_path');
        $this->user_id = $values->input('userId');
        $this->name = $values->input('set_name');
        $this->description = $values->input('set_desc');
        $this->category_id = $values->input('category');
        $this->availability = $values->input('availability');
        $this->question_language = $values->input('questionLanguage');
        $this->answer_language = $values->input('answerLanguage');

        if (!empty($values->file('set_image'))) {
            $imageName = uniqid() . '.' . $values->file('set_image')->getClientOriginalExtension();
            $this->image = $imageName;
            $values->file('set_image')->move($path, $imageName);
        }
        $this->save();
    }

    public function getCountTerms()
    {
        return $this->terms()->count();
    }
}
