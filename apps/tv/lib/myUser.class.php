<?php

class myUser extends sfBasicSecurityUser
{


  /**
   *
   */
  public function resetPan()
  {
    $this->setAttribute('nivel2_name' , null);
    $this->setAttribute('nivel3_name' , null);
    $this->setAttribute('nivel4_name' , null);
    $this->setAttribute('nivel2_url' , null);
    $this->setAttribute('nivel3_url' , null);
    $this->setAttribute('nivel4_url' , null);
  }


  /**
   *
   */
  public function panNivelUno()
  {
    sfConfig::set("pan_nivel_1", true);
    $this->resetPan();
  }


  /**
   *
   */
  public function panNivelDos($name, $url)
  {
    sfConfig::set("pan_nivel_2", true);
    $this->setAttribute('nivel2_name' , $name);
    $this->setAttribute('nivel3_name' , null);
    $this->setAttribute('nivel4_name' , null);
    $this->setAttribute('nivel2_url' , $url);
    $this->setAttribute('nivel3_url' , null);
    $this->setAttribute('nivel4_url' , null);
  }



  /**
   *
   */
  public function panNivelTres($serial)
  {
    sfConfig::set("pan_nivel_3", true);
    $this->setAttribute('nivel3_name' , $serial->getTitle());
    $this->setAttribute('nivel4_name' , null);
    $this->setAttribute('nivel3_url' , 'serial/index?id=' . $serial->getId());
    $this->setAttribute('nivel4_url' , null);

    if(!$this->hasAttribute('nivel2_url')){  
      $this->setAttribute('nivel2_name' , 'Todos');
      $this->setAttribute('nivel2_url' , 'library/index');    
    }
  }


  /**
   *
   */
  public function panNivelCuatro($mmobj)
  {
    sfConfig::set("pan_nivel_4", true);
    $this->setAttribute('nivel3_name' , $mmobj->getSerial()->getTitle());
    $this->setAttribute('nivel4_name' , $mmobj->getTitle());
    $this->setAttribute('nivel3_url' , 'serial/index?id=' . $mmobj->getSerial()->getId());
    $this->setAttribute('nivel4_url' , 'video/index?id=' . $mmobj->getId());

    if(!$this->hasAttribute('nivel2_url')){  
      $this->setAttribute('nivel2_name' , 'Todos');
      $this->setAttribute('nivel2_url' , 'library/index');    
    }
  }



}
