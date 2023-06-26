<?php

namespace App\Accessors;

trait DefaultAccessors
{
    public  function getTitleAttribute($value)
    {
       return strtoupper($value);
    }

    public  function getTitleAndBodyAttribute($value)
    {
       return $this->title . ' - ' . $this->body;
    }
}
