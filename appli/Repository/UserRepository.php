<?php
namespace appli\Repository;
final class UserRepository
{

    //Constante de classe (Post::DB_TABLE dans la classe même)
    public const DB_TABLE = 'milo_users';

    /**
     * Version statique commune à tous mes objets User = rattachée au référentiel User
     *
     * @return array
     */
    public static function findAll(): array{
        //Connexion
       $pdo = connect();
    
       $query = $pdo->query('
        SELECT 
            u_id AS id,
            u_pseudo AS pseudo, 
            u_mail AS mail,
            u_pass AS pass,
            u_datecreate AS dateCreate,
            u_dateconnect AS dateConnect,
            u_creator_id AS creatorId,
            u_statut AS statut
        FROM '.self::DB_TABLE.'
        ');

           $aUsers = [];

           while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

               //Création d'un objet User
               $oUser = new \appli\Entity\User();

               //Remplisage de l'objet POST (id,title, content, date)
               // Finalement on remplit par hydratation
               $oUser->hydrate($aData);

               //Stockage de l'objet Post dans le tableau $aPosts
               $aUsers[] = $oUser;
   
   
               // Autre option :
               // array_push($aPosts,$oPost);
           }
               return $aUsers;
    }

    /**
     * Version statique commune à tous mes objets User = rattachée au référentiel User
     *
     * @param integer $id
     * @return User | null
     */
    public static function find(int $id): ?\appli\Entity\User
      {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            u_id AS id,
            u_pseudo AS pseudo, 
            u_mail AS mail,
            u_pass AS pass,
            u_datecreate AS dateCreate,
            u_dateconnect AS dateConnect,
            u_creator_id AS creatorId,
            u_statut AS statut
            FROM '.self::DB_TABLE.'
            WHERE  u_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\User())->hydrate($aData); 
       }
	   //2 versions :
	   //Création
	//    $oUser = new User();
	//    //Hydratation
	//    $oUser->hydrate($aData);
	//    return    $oUser;
	
		// Ou bien en une ligne, version fluent :
		//version 'fluent', implique un return dans la fonction hydrate ($this) au lieu de rien et un self après le paramètre au lieu du void
       return null;
    }

    public static function delete(\appli\Entity\User $oUser):void
    {
        //Connexion
        $pdo = connect();
        
        $query = $pdo->prepare('
        DELETE FROM '. self::DB_TABLE .'
        WHERE  u_id = :id
        ');
        $query -> execute([   
            ':id' =>  $oUser->getId(),
          ]
       );
       

    }

    public static function insert(\appli\Entity\User $oUser): void{
		$pdo = connect();
		$query = $pdo->prepare('
		INSERT INTO ' . self::DB_TABLE . ' 
            (u_pseudo, u_mail, u_pass, u_creator_id, u_statut) 
        VALUES 
            (:user, :mail, :pass, :creatorId, :statut )
        ');

		$query -> bindValue(':user', $oUser->getPseudo(), \PDO::PARAM_STR);
		$query -> bindValue(':mail', $oUser->getEmail(), \PDO::PARAM_STR);
        $query -> bindValue(':pass', $oUser->getPass(), \PDO::PARAM_STR);
        $query -> bindValue(':creatorId', $oUser->getCreatorId(), \PDO::PARAM_STR);
        $query -> bindValue(':statut', $oUser->getStatut(), \PDO::PARAM_BOOL);

	
		$query -> execute();	
	}
    

    public static function update(\appli\Entity\User $oUser) : void{

		$pdo = connect();
		$query = $pdo->prepare('
		UPDATE ' . self::DB_TABLE . ' 
        SET u_pseudo = :user,
            u_mail = :mail,
            u_pass = :pass,
            u_creator_id = :creatorId,
            u_statut = :statut
        WHERE u_id = :id
        ');
		// Passage de id en tant qu'entier 
        $query -> bindValue(':id', $oUser->getId(), \PDO::PARAM_INT);
		$query -> bindValue(':user', $oUser->getPseudo(), \PDO::PARAM_STR);
		$query -> bindValue(':mail', $oUser->getEmail(), \PDO::PARAM_STR);
        $query -> bindValue(':pass', $oUser->getPass(), \PDO::PARAM_STR);
        $query -> bindValue(':creatorId', $oUser->getCreatorId(), \PDO::PARAM_STR);
        $query -> bindValue(':statut', $oUser->getStatut(), \PDO::PARAM_STR);
		
		// Exécution sans passer les valeurs
		$query -> execute();
	}

    public static function findByCreatorId(int $id): array
    {
      //Connexion
      $pdo = connect();
  
      $query = $pdo->prepare('
          SELECT 
          u_id AS id,
          u_pseudo AS pseudo, 
          u_mail AS mail,
          u_pass AS pass,
          u_datecreate AS dateCreate,
          u_dateconnect AS dateConnect,
          u_creator_id AS creatorId,
          u_statut AS statut
          FROM '.self::DB_TABLE.'
          WHERE  u_creator_id = :id
      ');
      $query -> execute([   
          ':id' =>  $id
        ]
     );
     $aUsers = [];

     while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

         //Création d'un objet User
         $oUser = new \appli\Entity\User();

         // Finalement on remplit par hydratation
         $oUser->hydrate($aData);

         //Stockage de l'objet User dans le tableau $aUsers
         $aUsers[] = $oUser;

     }
     return $aUsers;

 }

 public static function findByChampionshipId(int $id): array
 {
   //Connexion
   $pdo = connect();

   $query = $pdo->prepare('
       SELECT 
       u_id AS id,
       u_pseudo AS pseudo, 
       u_datecreate AS dateCreate,
       u_creator_id AS creatorId,
       u_statut AS statut
       FROM '.self::DB_TABLE.'
       INNER JOIN 
       WHERE  u_creator_id = :id
   ');
   $query -> execute([   
       ':id' =>  $id
     ]
  );
  $aUsers = [];

  while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

      //Création d'un objet User
      $oUser = new \appli\Entity\User();

      // Finalement on remplit par hydratation
      $oUser->hydrate($aData);

      //Stockage de l'objet User dans le tableau $aUsers
      $aUsers[] = $oUser;

  }
  return $aUsers;

}


public static function findByEmailAndUsername(string $mail, string $pseudo): ?\appli\Entity\User
      {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT
            u_id AS id,
            u_pseudo AS pseudo, 
            u_mail AS mail,
            u_pass AS pass,
            u_datecreate AS dateCreate,
            u_dateconnect AS dateConnect,
            u_creator_id AS creatorId,
            u_statut AS statut
            FROM '.self::DB_TABLE.'
            WHERE  u_mail = :mail OR u_pseudo = :pseudo
        ');
        $query -> execute([   
            ':mail' =>  $mail,
            ':pseudo' =>  $pseudo
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\User())->hydrate($aData); 
       }
       return null;
    }

    public static function findByUserPseudo(string $pseudo): ?\appli\Entity\User
      {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT
            u_id AS id,
            u_pseudo AS pseudo, 
            u_mail AS mail,
            u_pass AS pass,
            u_datecreate AS dateCreate,
            u_dateconnect AS dateConnect,
            u_creator_id AS creatorId,
            u_statut AS statut
            FROM '.self::DB_TABLE.'
            WHERE  u_pseudo = :pseudo
        ');
        $query -> execute([   
            ':pseudo' =>  $pseudo
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\User())->hydrate($aData); 
       }
       return null;
    }






}