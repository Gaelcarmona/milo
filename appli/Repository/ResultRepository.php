<?php
namespace appli\Repository;
final class ResultRepository
{

    //Constante de classe (Post::DB_TABLE dans la classe même)
    public const DB_TABLE = 'milo_results';

    /**
     * Version statique commune à tous mes objets Result = rattachée au référentiel Result
     *
     * @return array
     */
    public static function findAll(): array{
        //Connexion
       $pdo = connect();
    
       $query = $pdo->query('
        SELECT 
            r_id AS id,
            r_place AS place, 
            r_score AS score,
            u_id AS userId,
            d_id AS deckId,
            m_id AS matchId
        FROM '.self::DB_TABLE.'
        ');
           $aResults = [];
           while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {
               //Création d'un objet Result
               $oResult = new \appli\Entity\Result();
               // Finalement on remplit par hydratation
               $oResult->hydrate($aData);
               //Stockage de l'objet Post dans le tableau $aPosts
               $aResults[] = $oResult;
           }
               return $aResults;
    }

    /**
     * Version statique commune à tous mes objets Result = rattachée au référentiel Result
     *
     * @param integer $id
     * @return Result | null
     */
    public static function find(int $id): ?\appli\Entity\Result
      {
        //Connexion
        $pdo = connect();
        $query = $pdo->prepare('
            SELECT 
            r_id AS resultId,
            r_place AS place,
            r_score AS score, 
            u_id AS userId,
            d_id AS deckId,
            m_id AS matchId
            FROM '.self::DB_TABLE.'
            WHERE  r_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\Result())->hydrate($aData); 
       }
       return null;
    }

    public static function delete(\appli\Entity\Result $oResult):void
    {
        //Connexion
        $pdo = connect();
        
        $query = $pdo->prepare('
        DELETE FROM '. self::DB_TABLE .'
        WHERE  r_id = :id
        ');
        $query -> execute([   
            ':id' =>  $oResult->getId(),
          ]
       );
       

    }

    public static function insert(\appli\Entity\Result $oResult): void{
		$pdo = connect();
		$query = $pdo->prepare('
		INSERT INTO ' . self::DB_TABLE . ' 
            (r_id, r_place, r_score, u_id, d_id, m_id) 
        VALUES 
            (NULL, :place, :score, :userId, :deck, :match )
        ');

		$query -> bindValue(':place', $oResult->getPlace(), \PDO::PARAM_STR);
        $query -> bindValue(':score', $oResult->getScore(), \PDO::PARAM_STR);
        $query -> bindValue(':userId', $oResult->getUser()->getId(), \PDO::PARAM_INT);
        $query -> bindValue(':deck', $oResult->getDeck()->getId(), \PDO::PARAM_INT);
        $query -> bindValue(':match', $oResult->getMatch()->getId(), \PDO::PARAM_INT);

		$query -> execute();	
	}
    

    public static function update(\appli\Entity\Result $oResult) : void{

		$pdo = connect();
		$query = $pdo->prepare('
		UPDATE ' . self::DB_TABLE . ' 
        SET 
            r_place = :place,
            r_score = :score,
            u_id = :userId,
            d_id = :deck,
            m_id = :match
        WHERE r_id = :id
        ');
		// Passage de id en tant qu'entier 
        $query -> bindValue(':id', $oResult->getId(), \PDO::PARAM_INT);
		$query -> bindValue(':place', $oResult->getPlace(), \PDO::PARAM_STR);
        $query -> bindValue(':score', $oResult->getScore(), \PDO::PARAM_STR);
        $query -> bindValue(':userId', $oResult->getUser()->getId(), \PDO::PARAM_INT);
        $query -> bindValue(':deck', $oResult->getDeck()->getId(), \PDO::PARAM_INT);
        $query -> bindValue(':match', $oResult->getMatch()->getId(), \PDO::PARAM_INT);
		// Exécution sans passer les valeurs
		$query -> execute();
	}

        /**
     * Version statique commune à tous mes objets Result = rattachée au référentiel Result
     *
     * @param integer $id
     * @return Result | null
     * 
     * test
     */
    public static function findbyMatchId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            r_id AS resultId,
            r_place AS place,
            r_score AS score, 
            u_id AS userId,
            d_id AS deckId,
            m_id AS matchId
            FROM '.self::DB_TABLE.'
            WHERE  m_id = :id
            ORDER BY place ASC
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aResults = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet Result
            $oResult = new \appli\Entity\Result();

            // Finalement on remplit par hydratation
            $oResult->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aResults[] = $oResult;

        }
        return $aResults;

    }



    public static function findbyDeckId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            r_id AS resultId,
            r_place AS place,
            r_score AS score, 
            u_id AS userId,
            d_id AS deckId,
            m_id AS matchId
            FROM '.self::DB_TABLE.'
            WHERE  d_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aResults = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet Result
            $oResult = new \appli\Entity\Result();

            // Finalement on remplit par hydratation
            $oResult->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aResults[] = $oResult;

        }
        return $aResults;

    }

    public static function findbyUserId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            r_id AS resultId,
            r_place AS place, 
            r_score AS score,
            u_id AS userId,
            d_id AS deckId,
            m_id AS matchId
            FROM '.self::DB_TABLE.'
            WHERE  u_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aResults = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet Result
            $oResult = new \appli\Entity\Result();

            // Finalement on remplit par hydratation
            $oResult->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aResults[] = $oResult;

        }
        return $aResults;

    }




}