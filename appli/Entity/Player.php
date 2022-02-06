<?php
namespace appli\Entity;
final class Player
{

	//Constante de classe (Post::DB_TABLE dans la classe même)
	public const DB_TABLE = 'milo_players';

  	/** @var int $name */ 
	  private ?int $id = null;

	/** @var string $pseudo */ 
	private string $pseudo;

    /** @var DateTime $dateCreate */ 
	private \DateTime $dateCreate;

	/** @var User $user */ 
	private User $user;



	/**
	 * Fonction d'hydratation servant à remplir l'objet
	 *
	 * @param array $aData
	 * @return void
	 */
	function hydrate(array $aData): self
	{
		$oDateCreate= new \DateTime($aData['dateCreate']);

			$this->setId($aData['id']);
			$this->setPseudo($aData['pseudo']);
			$this->setDateCreate($oDateCreate);
			$this->setUser(\appli\Repository\UserRepository::find($aData['userId']));


			return $this; // En cas de version fluent

	}
	/**
	 * Get the value of id
	 *
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @param int $id
	 *
	 * @return self
	 */
	public function setId(int $id): self
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of pseudo
	 *
	 * @return string
	 */
	public function getPseudo(): string
	{
		return $this->pseudo;
	}

	/**
	 * Set the value of pseudo
	 *
	 * @param string $pseudo
	 *
	 * @return self
	 */
	public function setPseudo(string $pseudo): self
	{
		$this->pseudo = $pseudo;

		return $this;
	}


	/**
	 * Get the value of dateCreate
	 *
	 * @return DateTime
	 */
	public function getDateCreate(): \DateTime
	{
		return $this->dateCreate;
	}

	/**
	 * Set the value of dateCreate
	 *
	 * @param DateTime $dateCreate
	 *
	 * @return self
	 */
	public function setDateCreate(\DateTime $dateCreate): self
	{
		$this->dateCreate = $dateCreate;

		return $this;
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
}