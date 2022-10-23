<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select2 extends Component
{
    public $model;
    public $title;
    public $options;
    public $selected;
    public $multiple;
    public $allowNull;
    public $tags;

    public $alt;
    /**
     * FormSelect2 constructor.
     * @param $model
     * @param $title
     * @param $options
     * @param $selected
     */
    public function __construct($model, $title='', $options, $selected, $multiple = True, $allowNull = False, $tags = False, $alt = False)
    {
        $this->model     = $model;
        $this->title     = $title;
        $this->options   = $options;
        $this->selected  = $selected;
        $this->multiple  = $multiple;
        $this->tags      = $tags;
        $this->allowNull = $allowNull;

        $this->alt = $alt;
    }

    public function isSelected($option = '')
    {
        return in_array($option, $this->selected);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.form.select2');
    }
}
