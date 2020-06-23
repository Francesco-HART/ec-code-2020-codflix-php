<?php

require_once('database.php');

class User
{

    protected $id;
    protected $email;
    protected $password;
    protected $isActive;

    public function __construct($user = null)
    {
        $isActive = null;
        if ($user != null):
            $this->setId(isset($user->id) ? $user->id : null);
            $this->setEmail($user->email);
            $this->setPassword(isset($user->password) ? $user->password : false, isset($user->password_confirm) ? $user->password_confirm : false);
        endif;
    }

    /***************************
     * -------- SETTERS ---------
     ***************************/

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email incorrect');
        }
        $this->email = $email;
    }

    public function setPassword($password, $password_confirm = false)
    {
        if (!$password) {
            throw new Exception('Champ mot de passe manquant');
        }
        if (strpos($password, " ") != false) {
            throw new Exception('Champ mot de passe ne doit pas contenir d\'éspaces');
        }
        if (!$password) {
            throw new Exception('Champ mot de passe manquant');
        }
        if ($password_confirm && $password != $password_confirm) {
            throw new Exception('Vos mots de passes sont différents');
        }
        $this->password = $password;
    }

    public function setIsActive()
    {

        $this->isActive = true;
    }

    /***************************
     * -------- GETTERS ---------
     ***************************/

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }


    /***********************************
     * -------- CREATE NEW USER ---------
     ************************************/

    public function createUser()
    {

        // Open database connection
        $db = init_db();

        // Check if email already exist
        $req = $db->prepare("SELECT * FROM user WHERE email = '" . $this->email . "'");
        $req->execute();
        if ($req->rowCount() > 0) throw new Exception("Email deja utilisé");
        if ($this->email == '') {
            throw new Exception("Email requis");
        }
        // Insert new user
        $req->closeCursor();
        $req = $db->prepare("INSERT INTO user ( email, password ) VALUES ( :email, :password )");
        $req->execute(array(
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ));

        if ($this->sendActivationMail()) {
            throw new Exception('Erreur du serveur l\'email de confirmation n\'a pas pu être envoyé');
        }
        // Close databse connection
        $db = null;
    }

    /**************************************
     * -------- GET USER DATA BY ID --------
     ***************************************/

    public static function getUserById($id)
    {

        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT * FROM user WHERE id = ?");
        $req->execute(array($id));

        // Close databse connection
        $db = null;

        return $req->fetch();
    }

    /***************************************
     * ------- GET USER DATA BY EMAIL -------
     ****************************************/

    public function getUserByEmail()
    {
        // Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM user WHERE email = ?");
        $req->execute(array($this->getEmail()));
        // Close databse connection
        $db = null;
        return $req->fetch();
    }

    /**
     * @return bool true if email is send
     */
    private function sendActivationMail(): bool
    {

        $isSend = false;
        $res = $this->getUserByEmail();
        $target = $this->email;
        $info = "Activation de votre compte";
        $header = "From: inscription@codflix.com";
        $msg = 'Codflix,
        For activer your compt, clic on the link  
        http://codflix/inscription/activation.php?log=' . $res['id'] . ' 

        ---------------';
        try {
            mail($target, $info, $msg, $header);
            $isSend = true;
            return $isSend;
        } catch (Exception $e) {
            throw new Exception('Erreur du serveur l\'email de confirmation n\'a pas pu être envoyé');
        }

    }
}