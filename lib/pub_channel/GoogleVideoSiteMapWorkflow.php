<?php

class GoogleVideoSiteMapWorkflow  extends BaseWorkflow{
  protected $name = "GoogleVideoSiteMap";

  public function getName()
  {
    return $this->name;
  }
  
  public function select(Mm $mm){
  }

  public function postselect(Mm $mm){
  }

  public function deselect(Mm $mm){
  }
}