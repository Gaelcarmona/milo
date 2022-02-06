<?php
namespace appli\Entity;
final class User
{

	//Constante de classe (Post::DB_TABLE dans la classe même)
	public const DB_TABLE = 'milo_users';

  	/** @var int $id */ 
	  private ?int $id = null;

	/** @var string $pseudo */ 
	private string $pseudo = '';

    /** @var string $email */ 
	private string $email = '';

    /** @var string $pass */ 
	private string $pass = '';

    /** @var DateTime $dateCreate */ 
	private \DateTime $dateCreate;

    /** @var DateTime $dateConnect */ 
	private \DateTime $dateConnect;

	/** @var int $creatorId */ 
	private ?int $creatorId = null;

	/** @var bool $statut */ 
	private bool $statut;

	/**
	 * Fonction d'hydratation servant à remplir l'objet
	 *
	 * @param array $aData
	 * @return void
	 */
	function hydrate(array $aData): self
	{
		$oDateCreate= new \DateTime($aData['dateCreate']);
		$oDateConnect= new \DateTime($aData['dateConnect']);

			$this->setId($aData['id']);
			$this->setPseudo($aData['pseudo']);
			$this->setEmail($aData['mail']);
			$this->setPass($aData['pass']);
			$this->setDateCreate($oDateCreate);
			$this->setDateConnect($oDateConnect);
			$this->setCreatorId($aData['creatorId']);
			$this->setStatut($aData['statut']);
			

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
	 * Get the value of email
	 *
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * Set the value of email
	 *
	 * @param string $email
	 *
	 * @return self
	 */
	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get the value of pass
	 *
	 * @return string
	 */
	public function getPass(): string
	{
		return $this->pass;
	}

	/**
	 * Set the value of pass
	 *
	 * @param string $pass
	 *
	 * @return self
	 */
	public function setPass(string $pass): self
	{
		$this->pass = $pass;

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
	 * Get the value of dateConnect
	 *
	 * @return DateTime
	 */
	public function getDateConnect(): \DateTime
	{
		return $this->dateConnect;
	}

	/**
	 * Set the value of dateConnect
	 *
	 * @param DateTime $dateConnect
	 *
	 * @return self
	 */
	public function setDateConnect(\DateTime $dateConnect): self
	{
		$this->dateConnect = $dateConnect;

		return $this;
	}

	/**
	 * Get the value of id
	 *
	 * @return int|null
	 */
	public function getCreatorId(): ?int
	{
		return $this->creatorId;
	}

	/**
	 * Set the value of id
	 *
	 * @param int $id
	 *
	 * @return self
	 */
	public function setCreatorId(?int $creatorId): self
	{
		$this->creatorId = $creatorId;

		return $this;
	}

		/**
	 * Get the value of statut
	 *
	 * @return bool
	 */
	public function getStatut(): bool
	{
		return $this->statut;
	}

	/**
	 * Set the value of statut
	 *
	 * @param bool $statut
	 *
	 * @return self
	 */
	public function setStatut(bool $statut): self
	{
		$this->statut = $statut;

		return $this;
	}



	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
    public function averagePointsByMatchByChampionship($championshipId){

        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('

        SELECT AVG( r_score ) AS avg_score
        FROM milo_results 
        INNER JOIN milo_matchs  ON milo_results.m_id = milo_matchs.m_id
        INNER JOIN milo_championships  ON milo_championships.c_id = milo_matchs.c_id
        WHERE milo_results.u_id = :userId AND milo_matchs.c_id = :championshipId
            ');
            $query -> execute([   
                ':userId' =>  self::getId(),
                ':championshipId' =>  $championshipId
            ]
           );
           $aData = $query->fetch(\PDO::FETCH_ASSOC);
           if ($aData) {
			   
               return round($aData['avg_score'],2); 

           }
           return null;



    }



	public function averagePointsByMatch(){

        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('

        SELECT AVG( r_score ) AS avg_score
        FROM milo_results 
        WHERE milo_results.u_id = :userId 
        ');
		$query -> execute([   
			':userId' =>  self::getId()
		]
		);
		$aData = $query->fetch(\PDO::FETCH_ASSOC);
		if ($aData) {
			return round($aData['avg_score'],2); 
		}
		return null;



    }
}