<?php
namespace appli\Repository;
final class ChampionshipRepository
{

    //Constante de classe (Post::DB_TABLE dans la classe même)
    public const DB_TABLE = 'milo_championships';

    /**
     * Version statique commune à tous mes objets Championship = rattachée au référentiel Championship
     *
     * @return array
     */
    public static function findAll(): array{
        //Connexion
       $pdo = connect();
    
       $query = $pdo->query('
        SELECT 
            c_id AS id,
            c_title AS title, 
            c_datecreate AS dateCreate,
            u_id AS userId
        FROM '.self::DB_TABLE.'
        ');
           $aChampionships = [];
           while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {
               //Création d'un objet Championship
               $oChampionship = new \appli\Entity\Championship();
               // Finalement on remplit par hydratation
               $oChampionship->hydrate($aData);
               //Stockage de l'objet Post dans le tableau $aPosts
               $aChampionships[] = $oChampionship;
           }
               return $aChampionships;
    }

    /**
     * Version statique commune à tous mes objets Championship = rattachée au référentiel Championship
     *
     * @param integer $id
     * @return Championship | null
     */
    public static function find(int $id): ?\appli\Entity\Championship
      {
        //Connexion
        $pdo = connect();
        $query = $pdo->prepare('
            SELECT 
            c_id AS id,
            c_title AS title, 
            c_datecreate AS dateCreate,
            u_id AS userId
            FROM '.self::DB_TABLE.'
            WHERE  c_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\Championship())->hydrate($aData); 
       }
       return null;
    }

    public static function delete(\appli\Entity\Championship $oChampionship):void
    {
        //Connexion
        $pdo = connect();
        
        $query = $pdo->prepare('
        DELETE FROM '. self::DB_TABLE .'
        WHERE  c_id = :id
        ');
        $query -> execute([   
            ':id' =>  $oChampionship->getId(),
          ]
       );
       

    }

    public static function insert(\appli\Entity\Championship $oChampionship): int{
		$pdo = connect();
		$query = $pdo->prepare('
		INSERT INTO ' . self::DB_TABLE . ' 
            (c_id, c_title, c_datecreate, u_id) 
        VALUES 
            (NULL, :title, NOW(), :user )
        ');

		$query -> bindValue(':title', $oChampionship->getTitle(), \PDO::PARAM_STR);
        $query -> bindValue(':user', $oChampionship->getUser()->getId(), \PDO::PARAM_INT);

	
		$query -> execute();
        
        $id = $pdo->lastInsertId();

        return $id;
	}
    

    public static function update(\appli\Entity\Championship $oChampionship) : void{

		$pdo = connect();
		$query = $pdo->prepare('
		UPDATE ' . self::DB_TABLE . ' 
        SET 
            c_title = :title,
            u_id = :user
        WHERE c_id = :id
        ');
		// Passage de id en tant qu'entier 
        $query -> bindValue(':id', $oChampionship->getId(), \PDO::PARAM_INT);
		$query -> bindValue(':title', $oChampionship->getTitle(), \PDO::PARAM_STR);
        $query -> bindValue(':user', $oChampionship->getUser()->getId(), \PDO::PARAM_INT);
		// Exécution sans passer les valeurs
		$query -> execute();
	}

        /**
     * Version statique commune à tous mes objets Championship = rattachée au référentiel Championship
     *
     * @param integer $id
     * @return Championship | null
     * 
     * test
     */
    public static function findbyUserId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            c_id AS id,
            c_title AS title, 
            c_datecreate AS dateCreate,
            u_id AS userId
            FROM '.self::DB_TABLE.'
            WHERE  u_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aChampionships = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet Championship
            $oChampionship = new \appli\Entity\Championship();

            // Finalement on remplit par hydratation
            $oChampionship->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aChampionships[] = $oChampionship;

        }
        return $aChampionships;

    }

    public static function findbyExerciseId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            e_id AS exerciseId,
            m_id AS muscleId, 
            m_title AS muscleTitle
            FROM '.self::DB_TABLE.'
            INNER JOIN p_muscle on '.self::DB_TABLE.'.m_id = p_muscle.m_id
            WHERE  e_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aMuscles = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet Championship
            $oMuscle = new \appli\Entity\Muscle();

            // Finalement on remplit par hydratation
            $oMuscle->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aMuscles[] = $oMuscle;

        }
        return $aMuscles;

    }



}