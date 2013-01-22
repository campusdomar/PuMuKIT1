<?php


class emailAnnounce extends BaseAnnounce{
  protected $name = "email";

  protected $lista =  "uvigotv@listas.uvigo.es, comunidade@listas.uvigo.es";
  protected $from = "tv@uvigo.es";
  protected $from_text = "UVigo-TV";
  protected $subject_es = "[UVigoTV] Nuevos vídeos";
  protected $subject_gl = "[UVigoTV] Novos vídeos";

  public function getName()
  {
    return $this->name;
  }
  
  public function announceMm(Mm $mm){
    file_put_contents(sfConfig::get('sf_log_dir') . '/announces.log', "email mm" . $mm->getId() . " \n", FILE_APPEND);    
    $this->pr();
  }

  public function announceSerial(Serial $serial){
    file_put_contents(sfConfig::get('sf_log_dir') . '/announces.log', "email serial " . $serial->getId() . " \n", FILE_APPEND);    
    $this->pr();
  }

  private function pr(){
    $databaseManager = new sfDatabaseManager();
    $databaseManager->initialize();


    $mail = new sfMail();
    $mail->initialize();
    $mail->setMailer('sendmail');
    $mail->setCharset('utf-8');
    
    $mail->setSender(sfConfig::get('app_info_mail'), 'Email automatico');
    $mail->setFrom(sfConfig::get('app_info_mail'), 'Email automatico');
    $mail->addReplyTo(sfConfig::get('app_info_mail'));
    
    $mail->addAddress('rubenrua@uvigo.es');
    
    $mail->setSubject('Mensajes PuMuKIT (Diario)');
    $mail->setBody('
Prueba 
--
'.date('u').'
');

    $mail->send();

    return true;
  }

}
