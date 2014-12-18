<?php
/**
 * MODULO EMAILS ACTIONS. 
 * Pseudomodulo para accedear a las acciones de correo electronico.
 *
 * @package    pumukit
 * @subpackage emails
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class emailsActions extends sfActions
{
  /**
   * --  ANNOUNCEMAIL -- /editar.php/emails/announcemail
   *
   * Parametros: Identificador de mm, serial o channel, destino y cultura del mail.
   *
   */
  public function executeAnnounceMail()
  {
    if ($this->hasRequestParameter('mm')){
      $this->object = MmPeer::retrieveByPk( $this->getRequestParameter('mm') );
    }else{
      $this->object = SerialPeer::retrieveByPk( $this->getRequestParameter('serial') );
    }
    $this->forward404Unless( $this->object );

    if ( $this->getRequestParameter('to') == sfConfig::get('app_mail_lista') ) {
      $this->object->setMail(1);
      $this->object->save();
    }

    // send the email
    $raw_email = $this->sendEmail('emails', 'sendMail');

    // log the email
    if ($this->hasRequestParameter('mm')){
      LogEmailPeer::act('mm', $this->getRequestParameter('mm'), $this->getRequestParameter('to'), $this->getUser()->getAttribute('login'), $_SERVER['REMOTE_ADDR'] );
      $this->emails = LogEmailPeer::getEmails('mm', $this->getRequestParameter('mm'));
    }else{
      LogEmailPeer::act('serial', $this->getRequestParameter('serial'), $this->getRequestParameter('to'), $this->getUser()->getAttribute('login'), $_SERVER['REMOTE_ADDR'] );
      $this->emails = LogEmailPeer::getEmails('serial', $this->getRequestParameter('serial'));
    }
    $this->logMessage($raw_email, 'debug');

    $this->msg_alert = array('info', "Email enviado con exito.");

  }

  /**
   * --  PREVIEW -- /editar.php/emails/preview
   *
   * Parametros: Identificador de mm, serial o channel, destino y cultura del mail.
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('mm')){
      $this->object = MmPeer::retrieveByPk( $this->getRequestParameter('mm') );
      $this->emails = LogEmailPeer::getEmails('mm', $this->getRequestParameter('mm'));
    }else{
      $this->object = SerialPeer::retrieveByPk( $this->getRequestParameter('serial') );
      $this->emails = LogEmailPeer::getEmails('serial', $this->getRequestParameter('serial'));
    }
    $this->object->setCulture( 'es' );

    $this->img1 = '/uploads/uvigo/banner_mail.jpg';
    $this->img2 = '/uploads/uvigo/logo_tv_mail.jpg';
    $this->img3 = $this->object->getFirstUrlPic();

    $this->to = sfConfig::get('app_mail_lista');
  }



  /**
   * --  SENDMAIL -- /editar.php/emails/sendmail
   *
   * Parametros: Identificador de mm, serial o channel, destino y cultura del mail.
   *
   */
  public function executeSendMail()
  {
    if ($this->hasRequestParameter('mm')){
      $this->object = MmPeer::retrieveByPk( $this->getRequestParameter('mm') );
    }else{
      $this->object = SerialPeer::retrieveByPk( $this->getRequestParameter('serial') );
    }
    $this->object->setCulture( $this->getRequestParameter('culture') );
    //$this->getUser()->setCulture( $this->getRequestParameter('culture') );

    // class initialization
    $mail = new sfMail();	
    $mail->initialize();
    $mail->setMailer('sendmail');
    $mail->setCharset('utf-8'); 
      

    // definition of the required parameters
    $mail->setSender(sfConfig::get('app_mail_from'), sfConfig::get('app_mail_from_text'));
    $mail->setFrom(sfConfig::get('app_mail_from'), sfConfig::get('app_mail_from_text'));
    $mail->addReplyTo(sfConfig::get('app_mail_from'));
      
    $mail->addAddress($this->getRequestParameter('to'));	
      
    $mail->setSubject(sfConfig::get('app_mail_subject_'. $this->getRequestParameter('culture') ));
    $mail->setContentType('text/html; charset=utf-8');

    $mail->addEmbeddedImage(sfConfig::get('sf_web_dir').'/uploads/uvigo/banner_mail.jpg', 'CID1', 'banner', 'base64', 'image/gif');
    $mail->addEmbeddedImage(sfConfig::get('sf_web_dir').'/uploads/uvigo/logo_tv_mail.jpg', 'CID2', 'logo', 'base64', 'image/gif');
    $mail->addEmbeddedImage(sfConfig::get('sf_web_dir'). $this->object->getFirstUrlPic(), 'CID3', 'pic', 'base64', 'image/jpg');

    $this->mail = $mail;

    $this->img1 = "cid:CID1";
    $this->img2 = "cid:CID2";
    $this->img3 = "cid:CID3";
  }

}
