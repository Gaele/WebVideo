<?php
namespace Library;

session_start();

class User extends ApplicationComponent
{

  const ADMIN_COOKIE =   'admin';
  const AUTH_COOKIE =    'auth';
  const FLASH_COOKIE =   'flash';
  
  public function getAttribute($attr)
  {
    return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
  }
  
  public function getFlash()
  {
    $flash = $_SESSION[User::FLASH_COOKIE];
    unset($_SESSION[User::FLASH_COOKIE]);
    
    return $flash;
  }
  
  public function hasFlash()
  {
    return isset($_SESSION[User::FLASH_COOKIE]);
  }
  
  public function isAdministrator()
  {
	return isset($_SESSION[User::ADMIN_COOKIE]) && $_SESSION[User::ADMIN_COOKIE] === true;
  }
  
  public function isAuthenticated()
  {
    return isset($_SESSION[User::AUTH_COOKIE]) && !empty($_SESSION[User::AUTH_COOKIE]);
  }
  
  public function getAuthenticated()
  {
    return $_SESSION[User::AUTH_COOKIE];
  }
  
  public function setAttribute($attr, $value)
  {
    $_SESSION[$attr] = $value;
  }
  
  public function setAuthenticated($authenticated)
  {
    $_SESSION[User::AUTH_COOKIE] = $authenticated;
  }
  
  public function setAdministrator($authenticated = true)
  {
    if (!is_bool($authenticated))
    {
      throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAdministrator() doit être un boolean');
    }
    
    $_SESSION[User::ADMIN_COOKIE] = $authenticated;
  }
  
  public function setFlash($value)
  {
    $_SESSION[User::FLASH_COOKIE] = $value;
  }
}