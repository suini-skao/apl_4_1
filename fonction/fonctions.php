<?php
function nomp($idt,$bdd)
{
    $req=$bdd->prepare('SELECT* FROM team WHERE idt=:ok');
    $req->execute(array("ok"=>$idt));
    if($info=$req->fetch())
    {
        return $info['nomp'];
    }

}
function n_service($ids,$bdd)
{
    $req=$bdd->prepare('SELECT* FROM services WHERE ids=:ok');
    $req->execute(array("ok"=>$ids));
    if($info=$req->fetch())
    {
        return $info['services'];
    }

}
function quali($idt,$bdd)
{
    $req=$bdd->prepare('SELECT* FROM team WHERE idt=:ok');
    $req->execute(array("ok"=>$idt));
    if($info=$req->fetch())
    {
        return $info['qual'];
    }

}
function mails($idt,$bdd)
{
    $req=$bdd->prepare('SELECT* FROM team WHERE idt=:ok');
    $req->execute(array("ok"=>$idt));
    if($info=$req->fetch())
    {
        return $info['email'];
    }

}
function tel($idt,$bdd)
{
    $req=$bdd->prepare('SELECT* FROM team WHERE idt=:ok');
    $req->execute(array("ok"=>$idt));
    if($info=$req->fetch())
    {
        return $info['tel'];
    }

}
function pho($idt,$bdd)
{
    $req=$bdd->prepare('SELECT* FROM team WHERE idt=:ok');
    $req->execute(array("ok"=>$idt));
    if($info=$req->fetch())
    {
        return $info['photo'];
    }

}
function protect($a)
{
    return htmlspecialchars($a);
}
function insert($nom,$email,$message,$service,$lu,$conta,$bdd)
{
    $nomv=protect($nom);
    $emailv=protect($email);
    $messagev=protect($message);
    $luv=protect($lu);
    $cont=protect($conta);
    $serv=protect($service);
    $req=$bdd->prepare('INSERT INTO info_message (nom,email,messages,services,contact,dates,lire) VALUES (:a,:b,:c,:d,:e,:f,:g)');
    $req->execute(array(
        "a"=>$nomv,
        "b"=>$emailv,
        "c"=>$messagev,
         "d"=>$serv,
        "e"=>$cont,
        "f"=>date('Y-m-d'),
        "g"=>$luv
    ));
}
function me_user($id,$bdd)//nom utilisateur
{
    $ident=protect($id);
    $req=$bdd->prepare('SELECT* FROM proprio WHERE idp=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['nom'];
    }
}
function pre_user($id,$bdd)//nom utilisateur
{
    $ident=protect($id);
    $req=$bdd->prepare('SELECT* FROM proprio WHERE idp=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['prenom'];
    }
}

function id_user($email,$bdd)//nom utilisateur
{
    $ident=protect($email);
    $req=$bdd->prepare('SELECT* FROM proprio WHERE email=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['idp'];
    }
}
function me_mail($id,$bdd)//mail utilisateur
{
    $ident=protect($id);
    $req=$bdd->prepare('SELECT* FROM proprio WHERE idp=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['email'];
    }
}
function me_contact($id,$bdd)//contact utilisateur
{
    $ident=protect($id);
    $req=$bdd->prepare('SELECT* FROM proprio WHERE idp=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['contact'];
    }
}
function me_message($id,$bdd)//message utilisateur
{
    $ident=protect($id);
    $req=$bdd->prepare('SELECT* FROM info_message WHERE idi=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['messages'];
    }
}
function me_date($id,$bdd)//date msg utilisateur
{
    $ident=protect($id);
    $req=$bdd->prepare('SELECT* FROM  g_messagerie WHERE idg=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['dates'];
    }
}
function me_lu($id,$bdd)//verif lu msg utilisateur
{
    $ident=protect($id);
    $req=$bdd->prepare('SELECT* FROM info_message WHERE idi=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['lire'];
    }
}
function nombre_admin($bdd)// nombre d'admin
{
    $nombre=0;
    $req=$bdd->query("SELECT* FROM admin_conf");
    while($admin=$req->fetch())
    {
        $nombre=$nombre+1;
    }
    return $nombre;
}
function nombre_message($bdd)// nombre de message
{
    $nombre=0;
    $req=$bdd->query("SELECT* FROM info_message");
    while($msg=$req->fetch())
    {
        $nombre=$nombre+1;
    }
    return $nombre;
}
function nombre_messach($bdd)// nombre de message lu
{
    $nombre=0;
    $req=$bdd->prepare('SELECT* FROM g_messagerie WHERE (lire=:a || lire=:b )');
$req->execute(array("a"=>"lu",
                    "b"=>"rep"
));
    while($msg=$req->fetch())
    {
        $nombre=$nombre+1;
    }
    return $nombre;
}
function nombre_messnot($bdd)// nombre de message lu
{
    $nombre=0;
    $req=$bdd->prepare('SELECT* FROM  g_messagerie WHERE  lire=:a ');
$req->execute(array("a"=>"non"));
    while($msg=$req->fetch())
    {
        $nombre=$nombre+1;
    }
    return $nombre;
}
function nombre_not($bdd)// nombre d'admin
{
    $nombre=0;
    $req=$bdd->prepare("SELECT* FROM  g_messagerie WHERE lire=:ok");
    $req->execute(array("ok"=>"non"));
    while($msg=$req->fetch())
    {
        $nombre=$nombre+1;
    }
    return $nombre;
}
function nombre_ins($bdd)// nombre d'inscrit
{
    $nombre=0;
    $req=$bdd->query("SELECT* FROM  proprio ");
    
    while($msg=$req->fetch())
    {
        $nombre=$nombre+1;
    }
    return $nombre;
}
function intro_sev($info_serv,$bdd)
{
    $req=$bdd->prepare("SELECT* FROM serv_conf WHERE idserv=:ok");
    $req->execute(array("ok"=>1));
    if($info=$req->fetch())
    {
        $dev=protect($info['dev']);
        $desi=protect($info['desi']);
        $impe=protect($info['impe']);
        $coach=protect($info['coach']);
        switch ($info_serv) {
            case 'Developpement':
                $dev=$dev+1;
                break;
            case 'Design':
                $desi=$desi+1;
                break;
            case 'Import/Export':
                $impe=$impe+1;
                break;
            case 'Coaching':
                $coach=$coach+1;
                break;
        }
        $req2 = $bdd->prepare('UPDATE serv_conf SET dev = :a, desi = :b, impe=:c, coach=:d WHERE idserv = :e');
        $req2->execute(array(
        'a' => $dev,
        'b' => $desi,
        'c' => $impe,
        'd' => $coach,
        'e' => 1
                ));
    }
}
function info_mois()
{
    $mois="rien";
    $info=date("m");
    switch ($info) {
        case 01:
            $mois="janvier";
            break;
        case 02:
            $mois="fevrier";
            break;
        case 03:
            $mois="mars";
            break;
        case 04:
            $mois="avril";
            break;
        case 05:
            $mois="mai";
            break;
        case 06:
            $mois="juin";
            break;
        case 07:
            $mois="juillet";
            break;
        case 08:
            $mois="aout";
            break;
        case 09:
            $mois="septembre";
            break;
        case 10:
            $mois="octobre";
            break;
        case 11:
            $mois="novembre";
            break;
        case 12:
            $mois="decembre";
            break;
    }
    return $mois;
}
function mois_dem($info_mois,$bdd)
{
    $req=$bdd->prepare("SELECT* FROM mois_conf WHERE idmois=:ok");
    $req->execute(array("ok"=>1));
    if($info=$req->fetch())
    {
        $jan=protect($info['janvier']);
        $fev=protect($info['fevrier']);
        $mar=protect($info['mars']);
        $avr=protect($info['avril']);
        $mai=protect($info['mai']);
        $jun=protect($info['juin']);
        $jul=protect($info['juillet']);
        $aou=protect($info['aout']);
        $sep=protect($info['septembre']);
        $oct=protect($info['octobre']);
        $nov=protect($info['novembre']);
        $dec=protect($info['decembre']);
        switch ($info_mois) {
            case 'janvier':
                $jan=$jan+1;
                break;
            case 'fevrier':
                $fev=$fev+1;
                break;
            case 'mars':
                $mar=$mar+1;
                break;
            case 'avril':
                $avr=$avr+1;
                break;
            case 'mai':
                $mai=$mai+1;
                break;
            case 'juin':
                $jun=$jun+1;
                break;
            case 'juillet':
                $jul=$jul+1;
                break;
            case 'aout':
                $aou=$aou+1;
                break;
            case 'septembre':
                $sep=$sep+1;
                break;
            case 'octobre':
                $oct=$oct+1;
                break;
            case 'novembre':
                $nov=$nov+1;
                break;
            case 'decembre':
                $dec=$dec;
                break;
        }
        $req2 = $bdd->prepare('UPDATE mois_conf SET janvier = :a, fevrier = :b, mars=:c, avril=:d ,mai=:e,juin=:f,juillet=:g,aout=:h,septembre=:i,octobre=:j,novembre=:k,decembre=:l WHERE idmois = :m');
        $req2->execute(array(
        'a' => $jan,
        'b' => $fev,
        'c' => $mar,
        'd' => $avr,
        'e' => $mai,
        'f' => $jun,
        'g' => $jul,
        'h' => $aou,
        'i' => $sep,
        'j' => $oct,
        'k' => $nov,
        'l' => $dec,
        'm' => 1,
                ));
    }
}
function compte_serv($dev,$bdd)
{
    $av=protect($dev);
    $reqv=$bdd->prepare("SELECT* FROM serv_conf WHERE idserv=:ok");
    $reqv->execute(array("ok"=>1));
    if($aff=$reqv->fetch())
    {
        return $aff[$dev];
    }

}
function compte_mois($dev,$bdd)
{
    $av=protect($dev);
    $reqv=$bdd->prepare("SELECT* FROM mois_conf WHERE idmois=:ok");
    $reqv->execute(array("ok"=>1));
    if($aff=$reqv->fetch())
    {
        return $aff[$dev];
    }

}
function admin_id($id,$bdd)//contact utilisateur
{
    $ident=protect($id);
    $req=$bdd->prepare('SELECT* FROM admin_conf WHERE email=:msd');
    $req->execute(array("msd"=>$ident));
    if($info=$req->fetch())
    {
        return $info['ida'];
    }
}
function adminins($bdd,$nom,$mot,$aut)
{
    $nom=protect($nom);
    $mot=protect($mot);
    $aut=protect($aut);
    $req=$bdd->prepare('INSERT INTO admin_conf (email,autor) VALUES (:a,:b)');
    $req->execute(array(
        "a"=>$nom,
        "b"=>$aut
    ));
    $id=admin_id($nom,$bdd);
    $reqs=$bdd->prepare('INSERT INTO admin_mdp (mdp,ida) VALUES (:a,:b)');
    $reqs->execute(array(
        "a"=>$mot,
        "b"=>$id
    ));
}
function adminverif($bdd,$nom,$mot)
{
    $nom=protect($nom);
    $mot=protect($mot);
    
    $req=$bdd->prepare('SELECT* FROM admin_conf WHERE email=:a');
    $req->execute(array(
        "a"=>$nom
    ));
    if($verif=$req->fetch())
    {
        $id=admin_id($nom,$bdd);
        $reqs=$bdd->prepare('SELECT* FROM admin_mdp WHERE ida =:a');
        $reqs->execute(array(
            "a"=>$id
        ));
        if($aut=$reqs->fetch())
        {
            if($mot==$aut['mdp'])
            {
                session_start();
                $_SESSION['user']=$verif['email'];
                $_SESSION['aut']=$verif['autor'];
                return "autoriser";
            }else {return "erreur"; }
        }else {return "erreur"; }
    }else {return "erreur"; }
   
}
function sup_admin($id,$bdd) //suppression admin
{
    $req=$bdd->prepare('DELETE FROM admin_conf WHERE ida=:a');
    $req->execute(array(
        "a"=>$id
    ));
    $reqs=$bdd->prepare('DELETE FROM admin_mdp WHERE ida=:a');
    $reqs->execute(array(
        "a"=>$id
    ));
}
function img_nom($id,$bdd)
{  $id=protect($id);
    $reqm=$bdd->prepare("SELECT* FROM part_conf WHERE idp=:ok");
    $reqm->execute(array("ok"=>$id));
    if($inf=$reqm->fetch())
    {
        return $inf['img'];
    }
}
function img_mem($id,$bdd)
{  $id=protect($id);
    $reqm=$bdd->prepare("SELECT* FROM team WHERE idt=:ok");
    $reqm->execute(array("ok"=>$id));
    if($inf=$reqm->fetch())
    {
        return $inf['photo'];
    }
}
function img_nombre($bdd)
{  
    $n=0;
    $reqm=$bdd->query("SELECT* FROM part_conf ");
   
    while($inf=$reqm->fetch())
    {
        $n=$n+1;
    }
    return $n;
}
function img_ins($bdd,$img,$lien) // image sauv
{
    $img=protect($img);
    $lien=protect($lien);
  
    $req=$bdd->prepare('INSERT INTO part_conf (img,lien) VALUES (:a,:b)');
    $req->execute(array(
        "a"=>$img,
        "b"=>$lien
    ));
   
}
function sup_part($id,$lien,$bdd) // suppression partenaire
{
    $lien=protect($lien);
    if( file_exists($lien))
    {
    unlink($lien) ;
    Alternative: @unlink( $fichier ) ;
    $req=$bdd->prepare('DELETE FROM part_conf WHERE idp=:a');
    $req->execute(array(
        "a"=>$id
    ));
        }
    
}
function dest_admin()
{
    session_destroy();
}
function msg_rep($bdd,$idm,$mail,$reponse) // lors d'un envois de message sauvegarde dansla base de donnée
{
    $idm=protect($idm);
    $mail=protect($mail);
    $reponse=protect($reponse);
    $req=$bdd->prepare('INSERT INTO rep_message (idm,email,messages) VALUES (:a,:b,:c)');
    $req->execute(array(
        "a"=>$idm,
        "b"=>$mail,
        "c"=>$reponse
    ));
   
}
function ins_service($bdd,$service,$icone,$couleur)//enregistrement des services
{
    $service=protect( $service);
    $icone=protect($icone);
    $couleur=protect($couleur);
   
    $req=$bdd->prepare('INSERT INTO services (services,icon,couleur) VALUES (:a,:b,:c)');
    $req->execute(array(
        "a"=>$service,
        "b"=>$icone,
        "c"=>$couleur
    ));
}
function ins_pers($bdd,$nom,$quali,$email,$tel,$photo)//enregistrement des personnes
{
    $nom=protect($nom);
    $quali=protect($quali);
    $email=protect($email);
    $tel=protect($tel);
    $photo=protect($photo);
    $req=$bdd->prepare('INSERT INTO team (nomp,qual,email,tel,photo) VALUES (:a,:b,:c,:d,:e)');
    $req->execute(array(
        "a"=>$nom,
        "b"=>$quali,
        "c"=>$email,
        "d"=>$tel,
        "e"=>$photo
    ));
}
function ins_reponsable($bdd,$post,$idpersone,$idservice)//enregistrement des responsables
{
    $post=protect($post);
    $idpersone=protect($idpersone);
    $idservice=protect($idservice);
    $req=$bdd->prepare('INSERT INTO responsable (post,idt,ids) VALUES (:a,:b,:c)');
    $req->execute(array(
        "a"=>$post,
        "b"=>$idpersone,
        "c"=>$idservice
    ));
}
function sup_personne($bdd,$lien,$id) //supprimer une personne
{
    $lien=protect($lien);
    if( file_exists($lien))
    {
    unlink($lien) ;
    Alternative: @unlink( $lien ) ;
    $req=$bdd->prepare('DELETE FROM team WHERE idt=:a');
    $req->execute(array(
        "a"=>$id
    ));
        }
}
function sup_responsable($bdd,$id) //supprimer reponsable
{
    $lien=protect($lien);
    
    $req=$bdd->prepare('DELETE FROM responsable WHERE idr=:a');
    $req->execute(array(
        "a"=>$id
    ));
       
}
function sup_service($bdd,$ids) // suppression du service et des responsables
{
    $reqs=$bdd->prepare('SELECT* FROM responsable WHERE ids=:a');
    $reqs->execute(array("a"=>$ids));
    while($reps=$reqs->fetch())
    {
        sup_responsable($bdd,$reps['idr']);
    }
    $req=$bdd->prepare('DELETE FROM services WHERE ids=:a');
    $req->execute(array(
        "a"=>$ids
    ));
    
}
function id_p($bdd)
{
    $req=$bdd->query('SELECT* FROM team');
    while($rt=$req->fetch())
    {
        $idp=$rt['idt'];
    }
    $idp=$idp+1;
    return $idp;
}
function admin_idt($bdd,$email) 
{
    $id=protect($email);
    $reqm=$bdd->prepare("SELECT* FROM admin_conf WHERE email=:ok");
    $reqm->execute(array("ok"=>$id));
    if($inf=$reqm->fetch())
    {
        return $inf['ida'];
    }
}
function mod_ins($bdd,$id,$mdp)
{
    $id=protect($id);
    $mdp=protect($mdp);
    $req=$bdd->prepare('UPDATE admin_mdp SET mdp =:nv WHERE ida = :id');
    $req->execute(array(
        'id'=> $id,
        'nv' => $mdp
 ));
}
function mod_proprio($bdd,$id,$mdp)
{
    $id=protect($id);
    $mdp=protect($mdp);
    $req=$bdd->prepare('UPDATE mdp_prop SET mdp =:nv WHERE idp = :id');
    $req->execute(array(
        'id'=> $id,
        'nv' => $mdp
 ));
}
function verf_bloc_user($id,$bdd)
{
    $id=protect($id);
    $req=$bdd->prepare('SELECT* FROM proprio WHERE idp =:id');
    $req->execute(array(
        'id'=> $id   
 ));
 if($info=$req->fetch())
 {
    return $info['statu'] ;
 }
}
function bloc_user($id,$bdd)
{
    $id=protect($id);
    $req=$bdd->prepare('UPDATE proprio SET statu =:nv WHERE idp = :id');
    $req->execute(array(
        'id'=> $id,
        'nv' => "bloc"
 ));
}
function debloc_user($id,$bdd)
{
    $id=protect($id);
    $req=$bdd->prepare('UPDATE proprio SET statu =:nv WHERE idp = :id');
    $req->execute(array(
        'id'=> $id,
        'nv' => "autoris"
 ));
}
?>