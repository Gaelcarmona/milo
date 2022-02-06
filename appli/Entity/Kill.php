<?php
namespace appli\Entity;
final class Kill
{

	//Constante de classe (Post::DB_TABLE dans la classe même)
	public const DB_TABLE = 'milo_kills';



	/** @var Result int $result */ 
	private  Result  $result ;

	/** @var User $user */ 
	private  User $user;





	/**
	 * Fonction d'hydratation servant à remplir l'objet
	 *
	 * @param array $aData
	 * @return void
	 */
	function hydrate(array $aData): self
	{


			$this->setResult(\appli\Repository\ResultRepository::find($aData['resultId']));
			$this->setUser(\appli\Repository\UserRepository::find($aData['userKilledId']));


			return $this; // En cas de version fluent

	}


	/**
	 * Get the value of user
	 *
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * Set the value of user
	 *
	 * @param User $user
	 *
	 * @return self
	 */
	public function setUser(User $user): self
	{
		$this->user = $user;

		return $this;
	}

		/**
	 * Get the value of result
	 *
	 * @return Result
	 */
	public function getResult(): Result
	{
		return $this->result;
	}

	/**
	 * Set the value of result
	 *
	 * @param Result $result
	 *
	 * @return self
	 */
	public function setResult(Result $result): self
	{
		$this->result = $result;

		return $this;
	}


}