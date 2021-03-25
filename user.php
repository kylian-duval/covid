<?php
class user
{

    private $_Nom;
    private $_PDO;
    private $_Id;
    private $_Mdp;
    private $_Prenom;

    public function __construct($PDO)
    {
        $this->_PDO = $PDO;
    }
    public function connection($Nom, $MDP)
    {
        $this->_Nom = $Nom;
        $this->_Mdp = $MDP;
        
        $vérifNam = $this->_PDO->prepare("SELECT * FROM `user` WHERE `nom`= ? AND `mdp`= ?"); //vérification si le nom d'utilisateur et le mdp rentrer par le user
        $vérifNam->execute(array($this->_Nom, $this->_Mdp));
        $userExist = $vérifNam->rowCount();
    if ($userExist == 1) {
        echo "vous etre connecter";
        $_SESSION['id'] = true;
    } else {
        echo "tu connais pas des identifient ";
    }
    }
    
}
