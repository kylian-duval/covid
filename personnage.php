<?php
class personnage
{
    //priver :
    private $_Nom;
    private $_Vie;
    private $_degat;
    private $_PDO;
    //public:

    public function __construct($PDO)
    {
        $this->_PDO = $PDO;
    }

    public function setPersonnage($id, $nom, $vie, $degat)
    {
        $this->_id = $id;
        $this->_Nom = $nom;
        $this->_Vie = $vie;
        $this->_degat = $degat;
    }

    public function getNom()
    {
        return $this->_Nom;
    }
    public function getId()
    {
        return $this->_id;
    }

    public function setPersonnageById($id)
    {
        $Result = $this->_PDO->query("SELECT * FROM `Personnage` WHERE `id`='" . $id . "' ");
        if ($tab = $Result->fetch()) {

            $this->setPersonnage($tab["id"], $tab["nom"], $tab["vie"], $tab["dega"]);
        }
    }

    //Retourne une liste HTML de tous les personnages
    //et permet d'attribuer un perso à un user
    // retour un objet personnage
    public function getChoixPersonnage()
    {
        $Result = $this->_PDO->query("SELECT * FROM `Personnage` ");
?>
        <form action="" method="POST" onChange="this.parentNode.submit()">
            <select name="idPersonnage" id="idPersonnage">
                <option value=""> Choisi un perso</option>;
                <?php while ($tab = $Result->fetch()) {
                    echo '<option value="' . $tab["id"] . '"> ' . $tab["nom"] . '</option>';
                }
                ?>
            </select>
            <input type="submit">
        </form>
<?php
        if (isset($_POST["idPersonnage"])) {
            $this->setPersonnageById($_POST["idPersonnage"]);
        }

        return $this;
    }
}




?>