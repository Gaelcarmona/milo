<?php
namespace appli\Entity;
final class Match
{

	//Constante de classe (Post::DB_TABLE dans la classe même)
	public const DB_TABLE = 'milo_matchs';

  	/** @var int $name */ 
	  private ?int $id = null;

	/** @var string $title */ 
	private string $title ='';

    /** @var DateTime $dateCreate */ 
	private \DateTime $dateCreate;

	/** @var Championship $championship */ 
	private Championship $championship;



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
			$this->setTitle($aData['title']);
			$this->setDateCreate($oDateCreate);
			$this->setChampionship(\appli\Repository\ChampionshipRepository::find($aData['championshipId']));


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
	 * Get the value of title
	 *
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * Set the value of title
	 *
	 * @param string $title
	 *
	 * @return self
	 */
	public function setTitle(string $title): self
	{
		$this->title = $title;

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
}