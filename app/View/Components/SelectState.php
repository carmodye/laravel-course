<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use App\Models\State;

class SelectState extends Component
{
    public Collection $states;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->states = State::orderBy('name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-state');
    }
}
