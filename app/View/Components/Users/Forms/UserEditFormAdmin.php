<?php

namespace App\View\Components\Users\Forms;

use Illuminate\View\Component;

class UserEditFormAdmin extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.users.forms.user-edit-form-admin');
    }
}
