<?php
/**
 * Class MemberManager
 *
 * Define Manager for Members
 *
 */

class MemberManager extends BackManager
{
    private  $bdd;

    /**
     * MemberManager constructor.
     *
     * call static function in backmanager Liraby for connection to BDD
     */
    public function __construct()
    {
        $this->bdd = parent ::bddAssign();
    }

    /**
     *  getMember($pseudo) method .
     *
     * Get One user definition from a $pseudo
     *
      * @param $pseudo
     * @return User
     */

    public function getMember($pseudo)
    {
        $bdd = $this->bdd;
        $query = 'SELECT * FROM member WHERE pseudo =:pseudo';


        $req = $bdd->prepare($query);
        $req->bindValue(':pseudo', $pseudo , PDO::PARAM_INT);
        $req->execute();
        $row= $req->fetch(PDO::FETCH_ASSOC);

        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setPass($row['pass']);
        $user->setEmail($row['email']);
        $user->setRight($row['rights']);

        return $user;
    }

}