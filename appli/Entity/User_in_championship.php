<?php
namespace appli\Entity;
final class User_in_championship
{

	//Constante de classe (Post::DB_TABLE dans la classe même)
	public const DB_TABLE = 'milo_user_in_championship';

	/** @var User $user */ 
	private User $user;
    
    /** @var Championship $championship */ 
	private Championship $championship;
    
	/** @var int $elo */ 
	private ?int $elo =null;

	/**
	 * Fonction d'hydratation servant à remplir l'objet
	 *
	 * @param array $aData
	 * @return void
	 */
	function hydrate(array $aData): self
	{

			$this->setElo($aData['elo']);
			$this->setUser(\appli\Repository\UserRepository::find($aData['userId']));
            $this->setChampionship(\appli\Repository\ChampionshipRepository::find($aData['championshipId']));


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
	 * Get the value of championship
	 *
	 * @return Championship
	 */
	public function getChampionship(): Championship
	{
		return $this->championship;
	}

	/**
	 * Set the value of championship
	 *
	 * @param Championship $championship
	 *
	 * @return self
	 */
	public function setChampionship(Championship $championship): self
	{
		$this->championship = $championship;

		return $this;
	}

	/**
	 * Get the value of elo
	 *
	 * @return ?int
	 */
	public function getElo(): ?int
	{
		return $this->elo;
	}

	/**
	 * Set the value of elo
	 *
	 * @param ?int $elo
	 *
	 * @return self
	 */
	public function setElo(?int $elo): self
	{
		$this->elo = $elo;

		return $this;
	}
}