<?php
namespace appli\Repository;
final class DeckRepository
{

    //Constante de classe (Post::DB_TABLE dans la classe même)
    public const DB_TABLE = 'milo_decks';

    /**
     * Version statique commune à tous mes objets Deck = rattachée au référentiel Deck
     *
     * @return array
     */
    public static function findAll(): array{
        //Connexion
       $pdo = connect();
    
       $query = $pdo->query('
        SELECT 
            d_id AS id,
            d_title AS title, 
            d_datecreate AS dateCreate,
            u_id AS userId
        FROM '.self::DB_TABLE.'
        ');

           $aDecks = [];

           while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

               //Création d'un objet Deck
               $oDeck = new \appli\Entity\Deck();

               //Remplisage de l'objet POST (id,title, content, date)
               // Finalement on remplit par hydratation
               $oDeck->hydrate($aData);

               //Stockage de l'objet Post dans le tableau $aPosts
               $aDecks[] = $oDeck;
   
   
               // Autre option :
               // array_push($aPosts,$oPost);
           }
               return $aDecks;
    }

    /**
     * Version statique commune à tous mes objets Deck = rattachée au référentiel Deck
     *
     * @param integer $id
     * @return Deck | null
     */
    public static function find(int $id): ?\appli\Entity\Deck
      {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            d_id AS id,
            d_title AS title, 
            d_datecreate AS dateCreate,
            u_id AS userId
            FROM '.self::DB_TABLE.'
            WHERE  d_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
       );
       $aData = $query->fetch(\PDO::FETCH_ASSOC);
	
       if ($aData) {
           return (new \appli\Entity\Deck())->hydrate($aData); 
       }
       return null;
    }

    public static function delete(\appli\Entity\Deck $oDeck):void
    {
        //Connexion
        $pdo = connect();
        
        $query = $pdo->prepare('
        DELETE FROM '. self::DB_TABLE .'
        WHERE  d_id = :id
        ');
        $query -> execute([   
            ':id' =>  $oDeck->getId(),
          ]
       );
       

    }

    public static function insert(\appli\Entity\Deck $oDeck): void{
		$pdo = connect();
		$query = $pdo->prepare('
		INSERT INTO ' . self::DB_TABLE . ' 
            (d_id, d_title, u_id, d_datecreate) 
        VALUES 
            (NULL, :title, :user, NOW() )
        ');

        $query -> bindValue(':user', $oDeck->getUser()->getId(), \PDO::PARAM_INT);
		$query -> bindValue(':title', $oDeck->getTitle(), \PDO::PARAM_STR);

	
		$query -> execute();	
	}
    

    public static function update(\appli\Entity\Deck $oDeck) : void{

		$pdo = connect();
		$query = $pdo->prepare('
		UPDATE ' . self::DB_TABLE . ' 
        SET d_title = :title,
            u_id = :user
        WHERE d_id = :id
        ');
        $query -> bindValue(':id', $oDeck->getId(), \PDO::PARAM_INT);
        $query -> bindValue(':user', $oDeck->getUser()->getId(), \PDO::PARAM_INT);
		$query -> bindValue(':title', $oDeck->getTitle(), \PDO::PARAM_STR);

		
		// Exécution sans passer les valeurs
		$query -> execute();
	}


    public static function findbyUserId(int $id): array
    {
        //Connexion
        $pdo = connect();
    
        $query = $pdo->prepare('
            SELECT 
            d_id AS id,
            d_title AS title, 
            d_datecreate AS dateCreate,
            u_id AS userId
            FROM '.self::DB_TABLE.'
            WHERE  u_id = :id
        ');
        $query -> execute([   
            ':id' =>  $id
          ]
        );

        $aDecks = [];

        while ($aData = $query->fetch(\PDO::FETCH_ASSOC)) {

          
            $oDeck = new \appli\Entity\Deck();

            // Finalement on remplit par hydratation
            $oDeck->hydrate($aData);

            //Stockage de l'objet Post dans le tableau $aPosts
            $aDecks[] = $oDeck;

        }
        return $aDecks;

    }

    public static function insertByUserId(\appli\Entity\Deck $oDeck): void{
		$pdo = connect();
		$query = $pdo->prepare('
		INSERT INTO ' . self::DB_TABLE . ' 
            (d_id, d_title, u_id, d_datecreate) 
        VALUES 
            (NULL, :title, :user, NOW() )
        ');
        
        $query -> bindValue(':user', $id, \PDO::PARAM_INT);
		$query -> bindValue(':title', $oDeck->getTitle(), \PDO::PARAM_STR);

	
		$query -> execute();	
	}



}