<?php

namespace App\Http\Controllers;

use App\Set;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;
    protected $recommendedSets;
    protected $popularSets;

    public function __construct()
    {
        $this->user = auth()->user();
        view()->share('user', $this->user);

        $this->recommendedSets = new Set;
        $this->popularSets = new Set;

        $recommendedSets = $this->recommendedSets->getRecommendedSets($this->user->id);
        $popularSets = $this->popularSets->getUserStudyingSet($this->user->id);

        view()->share('recommendedSets', $recommendedSets);
        view()->share('popularSets', $popularSets);

    }
}
