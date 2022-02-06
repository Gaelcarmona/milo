<?php
namespace appli\Entity;
final class Result
{

	//Constante de classe (Post::DB_TABLE dans la classe même)
	public const DB_TABLE = 'milo_results';

  	/** @var int $id */ 
	  private ?int $id = null;

	/** @var string $place */ 
	private string $place;

	/** @var int $score */ 
	private int $score;

	/** @var User $user */ 
	private User $user;

	/** @var Deck $deck */ 
	private Deck $deck;

	/** @var Match $match */ 
	private Match $match;



	/**
	 * Fonction d'hydratation servant à remplir l'objet
	 *
	 * @param array $aData
	 * @return void
	 */
	function hydrate(array $aData): self
	{
	
			$this->setId($aData['resultId']);
			$this->setPlace($aData['place']);
			$this->setScore($aData['score']);
			$this->setUser(\appli\Repository\UserRepository::find($aData['userId']));
			$this->setDeck(\appli\Repository\DeckRepository::find($aData['deckId']));
			$this->setMatch(\appli\Repository\MatchRepository::find($aData['matchId']));


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
	 * Get the value of place
	 *
	 * @return string
	 */
	public function getPlace(): int
	{
		return $this->place;
	}

	/**
	 * Set the value of place
	 *
	 * @param string $place
	 *
	 * @return self
	 */
	public function setPlace(string $place): self
	{
		$this->place = $place;

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

		/**
	 * Get the value of deck
	 *
	 * @return Deck
	 */
	public function getDeck(): Deck
	{
		return $this->deck;
	}

	/**
	 * Set the value of deck
	 *
	 * @param Deck $deck
	 *
	 * @return self
	 */
	public function setDeck(Deck $deck): self
	{
		$this->deck = $deck;

		return $this;
	}



		/**
	 * Get the value of match
	 *
	 * @return Match
	 */
	public function getMatch(): Match
	{
		return $this->match;
	}

	/**
	 * Set the value of match
	 *
	 * @param Match $match
	 *
	 * @return self
	 */
	public function setMatch(Match $match): self
	{
		$this->match = $match;

		return $this;
	}

	/**
	 * Get the value of score
	 */ 
	public function getScore()
	{
		return $this->score;
	}

	/**
	 * Set the value of score
	 *
	 * @return  self
	 */ 
	public function setScore($score)
	{
		$this->score = $score;

		return $this;
	}
}