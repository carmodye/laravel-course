<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use App\Models\Maker;
use Illuminate\Support\Facades\Cache;

class SelectMaker extends Component
{
     public Collection $makers;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // get all makers from db
        // $this->makers = Maker::orderBy('name')->get();
        $this->makers = Cache::rememberForever('makers', function() {
		   return Maker::orderBy('name')->get();
		});
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-maker');
    }
}
