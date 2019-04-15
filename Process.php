<?php

class Mytable
{
    private $baseName;
    private $tableName;
    private $bdd;
    private $resexe;
    
    function __construct($_namebdd, $table, $_user, $_mdp) {
        $this->baseName = $_namebdd;
        $this->tableName = $table;
        
        try
        {
            $dsn = 'mysql:host:localhost;charset=utf8;dbname='.$this->baseName;
            $this->bdd = new PDO($dsn, $_user, $_mdp);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            echo "Échec : " . $e->getMessage();
        }
        $rq="SELECT * FROM ".$this->baseName.".".$this->tableName;
        $this->resexe = $this->bdd->query($rq);
    }
    
    public function Rendre_HTML() {
        
        echo "<table class='tab'>";
        $nbcol=$this->resexe->columnCount();
        $idKey = $this->GetPrimaryKey($nbcol);
        $index = $this->Info_Table($idKey);
        while($donnees = $this->resexe->fetch(PDO::FETCH_NUM))
        {
            echo "<tr>";
            $id = $donnees[$index];
            echo "<td><a href=Update.php?id=".$id.">Modifier</a></td>";
            echo '<td><a href="Delete.php?id='.$id.'"><button>Supprimer</button></a></td>';
            for($i=0;$i<$nbcol;$i++)
            {
                echo "<td style='color: black'>".$donnees[$i]."</td>";
            }
            echo"</tr>";
        }
        echo "</table>";
    }
    
    public function Info_Table($idName) {
        $answer = $this->bdd->query("SHOW COLUMNS FROM ".$this->baseName.".".$this->tableName);
        $nomChamps = array();
        echo "<th>Modifier</th>";
        echo "<th>Supprimer</th>";
        $i = 0;
        $j = 0;
        while($items = $answer->fetch(PDO::FETCH_NUM))
        {
            if ($items[0] == $idName) {
                $j = $i;
            }
            $nomChamps[0] = $items[0];
            echo"<th style='color: black'>".$nomChamps[0]."</th>";
            $i++;
        }
        return $j;
    }
    
    public function GetPrimaryKey($nbBoucle) {
        $i = 0;
        $tabPrimary = array();
        while ($i < $nbBoucle)
        {
            if (count($tabPrimary = $this->resexe->getColumnMeta($i)['flags']) == 2 ) {
                $tabPrimary = $this->resexe->getColumnMeta($i)['flags'];
                if ($tabPrimary[1] == 'primary_key') {
                    echo "<br />";
                    $chaine = $this->resexe->getColumnMeta($i)['name'];
                    return $chaine;
                }
            }
            $i++;
        }
    }
    
    public function GetPrimary() {
        $nbCol = $this->resexe->columnCount();
        $i = 0;
        $primary = array();
        $chaine = utf8_encode("Clé inéxistante.");
        while ($i < $nbCol)
        {
            $primary = $this->resexe->getColumnMeta($i)['flags'];
            if ($primary[1] == 'primary_key') {
                echo "<br />";
                $chaine =  "Le nom de la colonne ".utf8_encode("où se trouve la clé")." primaire est : ".$this->resexe->getColumnMeta($i)['name'];
                return $chaine;
            }
            $i++;
        }
        return $chaine;
    }
    
    public function GetInfo($_id) {
        $nbRow = $this->resexe->columnCount();
        $idName = $this->GetPrimaryKey($nbRow);
        $request = "SELECT * FROM ".$this->baseName.".".$this->tableName." WHERE ".$idName." = ".$_id;
        $answer = $this->bdd->query($request);
        $items = $answer->fetch(PDO::FETCH_NUM);
        return $items;
    }
    
    public function Ajout($_nom, $_adr, $_prix, $_comm, $_note, $_date) {
        //$sql = "INSERT INTO ".$this->baseName.".".$this->tableName." VALUES (id, '".$_nom."', '".$_adr."', '".$_prix."', '".$_comm."', '".$_note."', '".$_date."')";
        $sql = "INSERT INTO ".$this->baseName.".".$this->tableName." VALUES (id, :nom, :adr, :prix, :com, :note, :date)";
        $state = $this->bdd->prepare($sql);
        $state->bindParam(':nom', $_nom);
        $state->bindParam(':adr', $_adr);
        $state->bindParam(':prix', $_prix);
        $state->bindParam(':com', $_comm);
        $state->bindParam(':note', $_note);
        $state->bindParam(':date', $_date);
        $state->execute();
        echo var_dump($state);
        return "La ligne à bien été ajouté.";
    }
    
    public function Modification($_id, $_nom, $_adr, $_prix, $_comm, $_note, $_date) {
        $labase = "UPDATE ".$this->baseName.".".$this->tableName." SET";
        $sql = $labase." nom = '".$_nom."', adresse = '".$_adr."', prix = '".$_prix."', commentaire = '".$_comm."', note = '".$_note."', visite='".$_date."' WHERE id = ".$_id;
        echo $sql;
        $this->bdd->query($sql);
        return "Les informations ont bien été mis à jour.";
    }
    
    public function Delete($_id) {
        $sql = 'DELETE FROM '.$this->baseName.".".$this->tableName.' WHERE id = '.$_id;
        $this->bdd->query($sql);
        return "La ligne à bien été supprimer.";
    }
    
    public function GetUserId($_user) {
        $sql = "SELECT id FROM ".$this->baseName.".".$this->tableName." WHERE login = '".$_user."'";
        $rq = $this->bdd->query($sql);
        $id = $rq->fetch(PDO::FETCH_NUM);
        return $id[0];
    }
    
    public function Create_User($_nom, $_email, $_pass) {
        $rqLog = "SELECT nom FROM ".$this->baseName.".".$this->tableName." WHERE login = '".$_nom."'";
        $resLog = $this->bdd->query($rqLog);
        $rqEmail = "SELECT email FROM ".$this->baseName.".".$this->tableName." WHERE email = '".$_email."'";
        $resEmail = $this->bdd->query($rqEmail);
        if ($resLog->fetch(PDO::FETCH_NUM) != null) {
            return "Ce nom d'utilisateur existe déjà.";
        }
        elseif ($resEmail->fetch(PDO::FETCH_NUM) != null)
        {
            return "Cet email est déjà utilisé.";
        }
        else
        {
            $sql = "INSERT INTO ".$this->baseName.".".$this->tableName." VALUES (id, '', '', 1, :email, :login, :pass)";
            $state = $this->bdd->prepare($sql);
            $state->bindParam(':login', $_nom);
            $state->bindParam(':email', $_email);
            $state->bindParam(':pass', $_pass);
            $state->execute();
            return $this->GetUserId($_nom);
        }
    }
    
    public function VerifyUser($_user, $_mdp) {
        $sql = "SELECT password FROM ".$this->baseName.".".$this->tableName." WHERE login = '".$_user."'";
        $rq = $this->bdd->query($sql);
        $answer = $rq->fetch(PDO::FETCH_NUM);
        if ($answer == null) {
            return "L'identifiant où le mot de passe est incorrect.";
        }
        elseif (!password_verify($_mdp, $answer[0])) {
            return "L'identifiant où le mot de passe est incorrect.";
        }
        else 
        {
            return true;
        }
    }
}

?>