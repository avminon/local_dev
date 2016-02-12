<?php

namespace App;

use App\Result;
use App\Term;
use Config;
use DB;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    const AVAILABILITY_0 = 0;
    const AVAILABILITY_1 = 1;
    const AVAILABILITY_2 = 2;
    const AVAILABILITY_3 = 3;
    const AVAILABILITY_4 = 4;
    const NUMBER_SET = 5;
    const NO_SETS = 0;
    const NOT_RECOMMENDED = 0;
    const RECOMMENDED = 1;

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

    public function studying()
    {
        return $this->hasMany(Studying::class, 'set_id');
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

    public function getCountStudying()
    {
        return $this->studying()->count();
    }

    public function getTerms($setId, $userId)
    {
        $terms = Term::where('set_id', $setId)
            ->orderBy(DB::raw('RAND()'))
            ->get();
        $resultsToInsert = [];
        foreach ($terms as $term) {
            $resultsToInsert[] = [
                'set_id' => intval($setId),
                'term_id' => $term->id,
            ];
        }
        try {
            $this->Result = new Result;
            $this->Result->insert($resultsToInsert);
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUserStudyingSet($userId)
    {
        $setIds = Studying::where('user_id', $userId)->lists('set_id');
        $sets = Set::with('user')->whereIn('id', $setIds)->get();

        return $sets;
    }

    public function getUserCreatedSet($userId)
    {
        $sets = Set::where('user_id', $userId)->get();

        return $sets;
    }

    public function filterSetsForUser($userId, $type)
    {
        $follow = new Follow;
        $followers = $follow->getFollowers($userId);
        $followees = $follow->getFollowees($userId);

        $users = [
            'id' => $userId,
            'followers' => $followers,
            'followees' => $followees,
        ];

        //dd($userId, $followers, $followees);
        $sets = Set::where('name', 'like', '%' . $type . '%')
            ->where(function ($query1) use ($users) {
                $query1->orWhere(function ($query) use ($users) {
                    $query->where('availability', Set::AVAILABILITY_0);
                })
                    ->orWhere(function ($query) use ($users) {
                        $query->where('availability', Set::AVAILABILITY_1)
                            ->where('user_id', $users['id']);
                    })
                    ->orWhere(function ($query) use ($users) {
                        $query->where('availability', Set::AVAILABILITY_2)
                            ->where('user_id', $users['id'])
                            ->orWhereIn('user_id', $users['followers']);
                    })
                    ->orWhere(function ($query) use ($users) {
                        $query->where('availability', Set::AVAILABILITY_3)
                            ->where('user_id', $users['id'])
                            ->orWhereIn('user_id', $users['followees']);
                    })
                    ->orWhere(function ($query) use ($users) {
                        $query->where('availability', Set::AVAILABILITY_4)
                            ->where('user_id', $users['id'])
                            ->orWhereIn('user_id', $users['followees'])
                            ->orWhereIn('user_id', $users['followers']);
                    });

            });

        return $sets;
    }

    public function getNewSetsForUser($userId)
    {
        $sets = Set::filterSetsForUser($userId, '')
            ->orderBy('id', 'desc')
            ->get();

        return $sets;
    }

    public function getSetsForUser($userId, $type)
    {
        $sets = Set::filterSetsForUser($userId, $type)
            ->get();

        return $sets;
    }

    public function getRecommendedSets($userId)
    {
        $sets = Set::filterSetsForUser($userId, '')
            ->where('recommended', Set::AVAILABILITY_1)
            ->get();

        return $sets;
    }

    public function getUserFolloweeActivities($userId)
    {
        $followeeIds = Follow::where('follower_id', $userId)->lists('followee_id');
        $activities = Activity::with('user')->whereIn('user_id', $followeeIds)->get();

        return $activities;
    }

    public function getPopularSet($userId)
    {
        $sets = Set::join('studying', 'studying.set_id', '=', 'sets.id')
            ->selectRaw('sets.*, count(studying.set_id) as total')
            ->groupBy('studying.set_id')
            ->orderBy('total', 'desc')
            ->get();
        return $sets;
    }

    // public function addToRecommended($setId)
    // {
    //     $this->recommended = Set::RECOMMENDED;
    //     $this->save;
    // }

    // public function removeFromRecommended($setId)
    // {
    //     $this->recommended = Set::NOT_RECOMMENDED;
    //     $this->save;
    // }
}
