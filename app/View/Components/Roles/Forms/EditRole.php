<?php

namespace App\View\Components\Roles\Forms;

use Illuminate\View\Component;

class EditRole extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.roles.forms.edit-role');
    }
}
