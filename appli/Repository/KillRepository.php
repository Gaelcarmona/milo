<?php
namespace appli\Repository;
final class KillRepository
{

    //Constante de classe (Post::DB_TABLE dans la classe même)
    public const DB_TABLE = 'milo_kills';

    /**
     * Version statique commune à tous mes objets Kill = rattachée au référentiel Kill
     *
     * @return array
     */
    public static function findAll(): array{
        //Connexion
       $pdo = connect();
    
       $query = $pdo->query('
        SELECT 
            result_id AS resultId,
            user_killed_id AS userKilledId
        FROM '.self::DB_TABLE.'
        ');
           $aKills = [];
           while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {
               //Création d'un objet Kill
               $oKill = new \appli\Entity\Kill();
               // Finalement on remplit par hydratation
               $oKill->hydrate($aData);
               //Stockage de l'objet Post dans le tableau $aPosts
               $aKills[] = $oKill;
           }
               return $aKills;
    }

    /**
     * Version statique commune à tous mes objets Kill = rattachée au référentiel Kill
     *
     * @param integer $id
     * @return Kill | null
     */
    public static function find(int $resultId, int $killedId): ?\appli\Entity\Kill
      {
        //Connexion
        $pdo = connect();
        $query = $pdo->prepare('
            SELECT 
            result_id AS resultId,
            user_killed_id AS userKilledId
            FROM '.self::DB_TABLE.'
            WHERE  result_id   = :result_id 
            AND user_killed_id = :user_killed_id
        ');
        $query -> execute([   
            ':result_id' =>  $resultId,
            ':user_killed_id' =>  $killedId
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\Kill())->hydrate($aData); 
       }
       return null;
    }

    public static function delete(\appli\Entity\Kill $oKill):void
    {
        //Connexion
        $pdo = connect();
        
        $query = $pdo->prepare('
        DELETE FROM '. self::DB_TABLE .'
        WHERE  result_id = :result_id
        AND user_killed_id = :user_killed_id
        ');
        $query -> execute([   
            ':result_id' =>  $oKill->getResult()->getId(),
            ':user_killed_id' =>  $oKill->getUser()->getId()
          ]
       );
       

    }

    public static function insert(\appli\Entity\Kill $oKill): void{
		$pdo = connect();
		$query = $pdo->prepare('
		INSERT INTO ' . self::DB_TABLE . ' 
            (result_id,  user_killed_id) 
        VALUES 
            (:resultId, :userKilledId )
        ');


        $query -> bindValue(':userKilledId', $oKill->getUser()->getId(), \PDO::PARAM_INT);
        $query -> bindValue(':resultId', $oKill->getResult()->getId(), \PDO::PARAM_INT);


		$query -> execute();	
	}
    

    public static function update(\appli\Entity\Kill $oKill) : void{

		$pdo = connect();
		$query = $pdo->prepare('
		UPDATE ' . self::DB_TABLE . ' 
        SET 
            result_id = :resultId,
            user_killed_id AS userKilledId
        WHERE result_id = :id
        ');
		// Passage de id en tant qu'entier 

        $query -> bindValue(':userKilledId', $oKill->getPlayer()->getId(), \PDO::PARAM_INT);
        $query -> bindValue(':resultId', $oKill->getResult()->getId(), \PDO::PARAM_INT);
		// Exécution sans passer les valeurs
		$query -> execute();
	}

    public static function findbyResultId($id): array
    {
        //Connexion
        $pdo = connect();

        $query = $pdo->prepare('
            SELECT 
            result_id AS resultId,
            user_killed_id AS userKilledId
        FROM '.self::DB_TABLE.'
        INNER JOIN milo_results ON '.self::DB_TABLE.'.result_id = milo_results.r_id
        INNER JOIN milo_users ON '.self::DB_TABLE.'.user_killed_id = milo_users.u_id
        WHERE  result_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aKills = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

            //Création d'un objet Player
            $oKill = new \appli\Entity\Kill();

            // Finalement on remplit par hydratation
            $oKill->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aKills[] = $oKill;

        }
        return $aKills;

    }



    // public static function findAllbyResult(): array{
    //     //Connexion
    //    $pdo = connect();
    
    //    $query = $pdo->query('
    //     SELECT 
    //         result_id AS resultId,
    //         user_killed_id AS userKilledId
    //     FROM '.self::DB_TABLE.'
    //     INNER JOIN milo_results ON '.self::DB_TABLE.'.result_id = milo_results.r_id
    //     INNER JOIN milo_users ON '.self::DB_TABLE.'.user_killed_id = milo_users.u_id
    //     ');
    //        $aKills = [];
    //        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {
    //            //Création d'un objet Kill
    //            $oKill = new \appli\Entity\Kill();
    //            // Finalement on remplit par hydratation
    //            $oKill->hydrate($aData);
    //            //Stockage de l'objet Post dans le tableau $aPosts
    //            $aKills[] = $oKill;
    //        }
    //            return $aKills;
    // }

    public static function deletePlayer(\appli\Entity\Kill $oKill):void
    {
        //Connexion
        $pdo = connect();
        
        $query = $pdo->prepare('
        DELETE FROM '. self::DB_TABLE .'
        WHERE  result_id = :id AND user_killed_id =:idKilled
        ');
        $query -> execute([   
            ':id' =>  $oKill->getResult(),
            ':idKilled' => $oKill->getPlayer()
          ]
       );
       

    }

}