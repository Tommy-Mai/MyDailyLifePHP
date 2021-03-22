<?php namespace App\Traits;

use App\Models\MealTag;
use App\Models\TaskTag;
use App\Models\MealTask;
use App\Models\TaskTask;

trait CommonMethod
{
  public function getFormateDate(){
    return $this->date->format('Y/m/d');
  }

  public function getFormateTime(){
      return $this->time->format('H:i');
  }

  public function getMealTagName(){
    $tag = MealTag::find($this->tag_id);
    return $tag->name;
  }

  public function getTaskTagName(){
    $tag = TaskTag::find($this->tag_id);
    return $tag->name;
  }

  public function getFormateDateSearch(){
    return $this->format('Y/m/d');
  }

  public function getFormateTimeSearch(){
      return $this->format('H:i');
  }

  public function getTagNameSearch(){
    $tag = MealTag::find($this);
    return $tag->name;
  }
}