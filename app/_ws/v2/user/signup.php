<?php
use MMWS\Controller\UserController;

global $procedure;
unset($data['_']);

if($procedure == 'create_user'){
  $u = new UserController($data);
  if ($r = $u->createUser()){
    send(is_array($r) ? $r : ['res' => $r]);
  }
}
