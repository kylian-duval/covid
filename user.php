<?php
class user
{

    private $_Nom;
    private $_PDO;
    private $_Id;
    private $_Mdp;
    private $_Prenom;
    private $_MonPersonnage;

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

    public function setUser($id,$login,$mdp,$prenom){
        $this->_id = $id;
        $this->_login = $login;
        $this->_mdp = $mdp;
        $this->_prenom = $prenom;
    }

    public function setUserById($id){
        $Result = $this->_bdd->query("SELECT * FROM `User` WHERE `id`='".$id."' ");
        if($tab = $Result->fetch()){ 
            $this->setUser($tab["id"],$tab["login"],$tab["mdp"],$tab["prenom"]);
            //chercher son personnage
            $personnage = new Personnage($this->_bdd);
            $personnage->setPersonnageById($tab["idPersonnage"]);
            $this->_MonPersonnage = $personnage;
        }
    }

    public function setPersonnage($Perso){
        $this->_MonPersonnage = $Perso;
        //je mémorise en base l'association du personnage dans user
        $req ="UPDATE `user` SET `id_personnage`='".$Perso->getID()."' WHERE  `id` = '".$this->_Id."'";
        $Result = $this->_bdd->query($req);
    }

    public function getPrenom(){
        return $this->_prenom;
    }

    public function getNomPersonnage(){
        return $this->_MonPersonnage->getNom();
    }
    
}
