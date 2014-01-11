<?php
namespace Library\Models;

use \Library\Entities\Louer;

abstract class LouerManager extends \Library\Manager
{

	abstract public function loue($idCLient, $idLoue);
	
	
  
}