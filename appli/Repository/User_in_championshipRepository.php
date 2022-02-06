<?php
namespace appli\Repository;
final class User_in_championshipRepository
{

    //Constante de classe (Post::DB_TABLE dans la classe même)
    public const DB_TABLE = 'milo_user_in_championship';

    /**
     * Version statique commune à tous mes objets User_in_championship = rattachée au référentiel User_in_championship
     *
     * @return array
     */
    public static function findAll(): array{
        //Connexion
       $pdo = connect();
    
       $query = $pdo->query('
        SELECT 
            u_id AS userId,
            c_id AS championshipId,
            uic_elo AS elo 
        FROM '.self::DB_TABLE.'
        ');
           $aUser_in_championships = [];
           while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {
               //Création d'un objet User_in_championship
               $oUser_in_championship = new \appli\Entity\User_in_championship();
               // Finalement on remplit par hydratation
               $oUser_in_championship->hydrate($aData);
               //Stockage de l'objet Post dans le tableau $aPosts
               $aUser_in_championships[] = $oUser_in_championship;
           }
               return $aUser_in_championships;
    }

    /**
     * Version statique commune à tous mes objets User_in_championship = rattachée au référentiel User_in_championship
     *
     * @param integer $id
     * @return User_in_championship | null
     */
    public static function find(int $id): ?\appli\Entity\User_in_championship
      {
        //Connexion
        $pdo = connect();
        $query = $pdo->prepare('
            SELECT 
            u_id AS userId,
            c_id AS championshipId,
            uic_elo AS elo
            FROM '.self::DB_TABLE.'
            WHERE  u_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\User_in_championship())->hydrate($aData); 
       }
       return null;
    }

    public static function delete(\appli\Entity\User_in_championship $oUser_in_championship):void
    {
        //Connexion
        $pdo = connect();
        
        $query = $pdo->prepare('
        DELETE FROM '. self::DB_TABLE .'
        WHERE  u_id = :id
        ');
        $query -> execute([   
            ':id' =>  $oUser_in_championship->getUser()->getId(),
          ]
       );
       

    }

    public static function insert(\appli\Entity\User_in_championship $oUser_in_championship): void{
		$pdo = connect();
		$query = $pdo->prepare('
		INSERT INTO ' . self::DB_TABLE . ' 
            (u_id, c_id,  uic_elo) 
        VALUES 
            ( :userId, :championshipId,  NULL)
        ');

		$query -> bindValue(':userId', $oUser_in_championship->getUser()->getId(), \PDO::PARAM_STR);
        $query -> bindValue(':championshipId', $oUser_in_championship->getChampionship()->getId(), \PDO::PARAM_INT);

	
		$query -> execute();	
	}
    

    public static function update(\appli\Entity\User_in_championship $oUser_in_championship) : void{

		$pdo = connect();
		$query = $pdo->prepare('
		UPDATE ' . self::DB_TABLE . ' 
        SET 
            u_id = :userId,
            c_id = :championshipId,
            uic_elo = :elo
        WHERE u_id = :id
        ');
		// Passage de id en tant qu'entier 
		$query -> bindValue(':userId', $oUser_in_championship->getUser()->getId(), \PDO::PARAM_STR);
        $query -> bindValue(':championshipId', $oUser_in_championship->getChampionship()->getId(), \PDO::PARAM_INT);
        $query -> bindValue(':elo', $oUser_in_championship->getElo(), \PDO::PARAM_INT);
		// Exécution sans passer les valeurs
		$query -> execute();
	}

        /**
     * Version statique commune à tous mes objets User_in_championship = rattachée au référentiel User_in_championship
     *
     * @param integer $id
     * @return User_in_championship | null
     * 
     * test
     */
    public static function findbyUserId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            u_id AS userId,
            c_id AS championshipId,
            uic_elo AS elo
            FROM '.self::DB_TABLE.'
            WHERE  u_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aUser_in_championships = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet User_in_championship
            $oUser_in_championship = new \appli\Entity\User_in_championship();

            // Finalement on remplit par hydratation
            $oUser_in_championship->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aUser_in_championships[] = $oUser_in_championship;

        }
        return $aUser_in_championships;

    }




    public static function findbyChampionshipId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            '.self::DB_TABLE.'.u_id AS userId,
            u_pseudo AS pseudo,
            c_id AS championshipId,
            uic_elo AS elo
            FROM '.self::DB_TABLE.'
            INNER JOIN milo_users on '.self::DB_TABLE.'.u_id = milo_users.u_id
            WHERE  c_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aUser_in_championships = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet User_in_championship
            $oUser_in_championship = new \appli\Entity\User_in_championship();

            // Finalement on remplit par hydratation
            $oUser_in_championship->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aUser_in_championships[] = $oUser_in_championship;

        }
        return $aUser_in_championships;

    }



}