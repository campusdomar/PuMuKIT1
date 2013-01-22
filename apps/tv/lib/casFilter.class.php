<?php


class casFilter extends sfFilter
{
  public function execute($filterChain)
  {

    if(isset($_SESSION['wsCASLoggedOut']) && $_SESSION['wsCASLoggedOut']) {
      unset($_SESSION['wsCASLoggedOut']);
      unset($_SESSION['phpCAS']);
    }

    if ($this->isFirstCall()) {
      phpCAS::client(CAS_VERSION_2_0, sfConfig::get ('app_cas_url'), sfConfig::get ('app_cas_port'), sfConfig::get ('app_cas_context'), false);
      //phpCAS::setDebug('/tmp/cas.log');
      phpCAS::setSingleSignoutCallback(array($this, 'casSingleSignOut'));
      phpCAS::setPostAuthenticateCallback(array($this, 'casPostAuth'));
      phpCAS::handleLogoutRequests(true, array(sfConfig::get ('app_cas_ip')));
      phpCAS::setNoCasServerValidation();
    }

    $filterChain->execute();   
  }


  //SSO CAS
  public function casPostAuth($ticket2logout) {
 
    // remember the current session name and id
    $old_session_name=session_name();
    $old_session_id=session_id();
 
    // close the current session for now
    session_write_close();
    session_unset();
    session_destroy();
 
    // create a new session where we'll store the old session data
    session_name("casauthssoutticket");
    session_id(preg_replace('/[^\w]/','',$ticket2logout));
    session_start();
 
    $_SESSION["old_session_name"] = $old_session_name;
    $_SESSION["old_session_id"] = $old_session_id;
 
    // close the ssout session again
    session_write_close();
    session_unset();
    session_destroy();
 
    // and open the old session again
    session_name($old_session_name);
    session_id($old_session_id);
    session_start();
  }

  
  //SSO CAS
  public function casSingleSignOut($ticket2logout)
  {
 
    $session_id = preg_replace('/[^\w]/','',$ticket2logout);
 
    // destroy a possible application session created before phpcas
    if(session_id() !== ""){
      session_unset();
      session_destroy();
    }
 
    // load the ssout session
    session_name("casauthssoutticket");
    session_id($session_id);
    session_start();
 
    // extract the user session data
    $old_session_name = $_SESSION["old_session_name"];
    $old_session_id = $_SESSION["old_session_id"];
 
    // close the ssout session again
    session_unset();
    session_destroy();
 
    // load the user session
    session_name($old_session_name);
    session_id($old_session_id);
    session_start();
 
    // set the flag that the user session is to be closed
    $_SESSION['wsCASLoggedOut'] = true;
 
    // close the user session again
    session_write_close();
    session_unset();
    session_destroy();
  }

}