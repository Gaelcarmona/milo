<?php
namespace appli\Repository;
final class MatchRepository
{

    //Constante de classe (Post::DB_TABLE dans la classe même)
    public const DB_TABLE = 'milo_matchs';

    /**
     * Version statique commune à tous mes objets Match = rattachée au référentiel Match
     *
     * @return array
     */
    public static function findAll(): array{
        //Connexion
       $pdo = connect();
    
       $query = $pdo->query('
        SELECT 
            m_id AS id,
            m_title AS title, 
            m_datecreate AS dateCreate,
            c_id AS championshipId
        FROM '.self::DB_TABLE.'
        ');

           $aMatchs = [];

           while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

               //Création d'un objet Match
               $oMatch = new \appli\Entity\Match();

               // Finalement on remplit par hydratation
               $oMatch->hydrate($aData);

               //Stockage de l'objet Post dans le tableau $aPosts
               $aMatchs[] = $oMatch;
   
   
               // Autre option :
               // array_push($aPosts,$oPost);
           }
               return $aMatchs;
    }

    /**
     * Version statique commune à tous mes objets Match = rattachée au référentiel Match
     *
     * @param integer $id
     * @return Match | null
     */
    public static function find(int $id): ?\appli\Entity\Match
      {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            m_id AS id,
            m_title AS title, 
            m_datecreate AS dateCreate,
            c_id AS championshipId
            FROM '.self::DB_TABLE.'
            WHERE  m_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\Match())->hydrate($aData); 
       }
       return null;
    }

    public static function delete(\appli\Entity\Match $oMatch):void
    {
        //Connexion
        $pdo = connect();
        
        $query = $pdo->prepare('
        DELETE FROM '. self::DB_TABLE .'
        WHERE  m_id = :id
        ');
        $query -> execute([   
            ':id' =>  $oMatch->getId(),
          ]
       );
       

    }

    public static function insert(\appli\Entity\Match $oMatch): void{
		$pdo = connect();
		$query = $pdo->prepare('
		INSERT INTO ' . self::DB_TABLE . ' 
            (m_id, m_title, m_datecreate, c_id) 
        VALUES 
            (NULL, :title, NOW(), :championship )
        ');

		$query -> bindValue(':title', $oMatch->getTitle(), \PDO::PARAM_STR);
        $query -> bindValue(':championship', $oMatch->getChampionship()->getId(), \PDO::PARAM_INT);

	
		$query -> execute();	
	}
    

    public static function update(\appli\Entity\Match $oMatch) : void{

		$pdo = connect();
		$query = $pdo->prepare('
		UPDATE ' . self::DB_TABLE . ' 
        SET 
            m_title = :title,
            c_id = :championship
        WHERE m_id = :id
        ');
		// Passage de id en tant qu'entier 
        $query -> bindValue(':id', $oMatch->getId(), \PDO::PARAM_INT);
		$query -> bindValue(':title', $oMatch->getTitle(), \PDO::PARAM_STR);
        $query -> bindValue(':championship', $oMatch->getChampionship()->getId(), \PDO::PARAM_INT);
		// Exécution sans passer les valeurs
		$query -> execute();
	}


    public static function findbyChampionshipId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            m_id AS id,
            m_title AS title, 
            m_datecreate AS dateCreate,
            c_id AS championshipId
            FROM '.self::DB_TABLE.'
            WHERE  c_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aMatchs = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet Player
            $oMatch = new \appli\Entity\Match();

            // Finalement on remplit par hydratation
            $oMatch->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aMatchs[] = $oMatch;

        }
        return $aMatchs;

    }



}