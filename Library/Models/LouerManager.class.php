<?php
namespace Library\Models;

use \Library\Entities\Louer;

abstract class LouerManager extends \Library\Manager
{
	/*
	 * check if a client $idClient has rent a film $idLoue
	 * @idClient the id of the client
	 * @idLoue the id of the film to rent
	 * @return the "louer" object
	 */
	abstract public function loue($idClient, $idLoue);

	/*
	 * Rent a film
	 * @idClient the id of the client
	 * @idLoue the id of the film to rent
	 * @return void
	 */
	abstract public function location($idC, $idFilm);

	/*
	 * Films rented by a client
	 * @idClient the id of the client
	 * @return films rented by this client
	 */
	abstract public function rentedBy($idC);
	
	
}