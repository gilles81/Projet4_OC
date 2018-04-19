<?php
/**
 *
 *
 */

class MemberManager extends BackManager
{
    private  $bdd;

    public function __construct()
    {
        $this->bdd = parent ::bddAssign();
    }

    /**
     *  getMember($pseudo) method .
     *
     * Get One user definition from a $pseudo
     *
     */

    public function getMember($pseudo)
    {
        $bdd = $this->bdd;
        $query = "SELECT * FROM member WHERE pseudo =:pseudo";


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

    /**
     *  getMembers() method .
     *
     * Get all users in BDD
     *

     * @return BddUser
     */
    public function getMembers()
    {
        //TO TEST

        $bdd = $this->bdd;
        $query = "SELECT * FROM members WHERE member ";

        $req = $bdd->prepare($query);
        //$req->bindValue(':pseudo', $pseudo , PDO::PARAM_INT);
        $req->execute();
        $row= $req->fetch(PDO::FETCH_ASSOC);

        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        //$user->setPass($row['pass']);
        $user->setEmail($row['email']);
        $user>setRights($row['rights']);

        return $user;
    }

    /**
     * getAdminMember()
     *
     * Get Admins member in dataBase
     *
     * @return BddUser
     */
    public function getAdminMember()
    {
        $bdd = $this->bdd;
        $query = "SELECT * FROM members WHERE rights =:rights";

        $req = $bdd->prepare($query);
        $req->bindValue('rights', "1" , PDO::PARAM_INT);
        $req->execute();
        $row= $req->fetch(PDO::FETCH_ASSOC);

        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        //$user->setPass($row['pass']);
        $user->setEmail($row['email']);
        $user>setRights($row['rights']);

        return $user;
    }

    /**
     * createMenber()
     *
     * This method create a menber
     * DEVELLOPPEMENT USED ONLY
     *
     *
     */
    public function createMenber()
        // TODO => To remove after dev or create a creation users in administration session.

    {
        $bdd = $this->bdd;
        $pass_hache = password_hash('JForteroche', PASSWORD_DEFAULT);

        $req = $bdd->prepare('INSERT INTO member(pseudo, pass, email) VALUES(:pseudo, :pass, :email)');
        $req->execute(array(
            'pseudo' => 'JForteroche',
            'pass' => $pass_hache,
            'email' => ''));
    }

}