<?php 
    require_once('../his_bd.php');
    require_once('fonction/fonctions.php');
 session_start();
 if(!isset($_SESSION['user']))
 {
     header('location:index.php');
 }
if(isset($_GET['dest']))
{
    dest_admin();
    header('location:index.php');
}

$reqt=$bdd->prepare('SELECT* FROM  g_messagerie WHERE lire=:a');
$reqt->execute(array("a"=>"non"));
$req2=$bdd->query('SELECT* FROM g_messagerie');
$base=$bdd;
$reqm=$bdd->prepare("SELECT* FROM g_messagerie WHERE lire=:ok");
$reqm->execute(array("ok"=>"non"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard 3</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <a href="dash.php">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="bot-line"></span>
                                </a>
                                
                            </li>
                           
                            
                            <li class="has-sub">
                                <a href="archive.php">
                                    <i class="fas fa-copy"></i>
                                    <span class="bot-line"></span>Archives</a>
                                
                            </li>
                            
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="header-button-item <?php if(nombre_not($base)!=0) {echo "has-noti";} ?> js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                                <div class="notifi__title">
                                    <p>Vous avez <?php  echo nombre_not($base);?> Notifications</p>
                                </div>
                                <?php while($not=$reqm->fetch()) { ?>
                                <a href="#">
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                   
                                    <div class="content">
                                        <p>Messages</p>
                                        <span class="date"><?php echo me_date($not['idg'],$base); ?> </span>
                                    </div>
                                    
                                </div>
                                </a>
                                <?php } ?>
                                <div class="notifi__footer">
                                    <a href="#">Mes Notifications</a>
                                </div>
                            </div>
                        </div>
                        
                        <?php if($_SESSION['aut']==1) { ?>
                        <div class="header-button-item js-item-menu">
                            <i class="zmdi zmdi-settings"></i>
                            <div class="setting-dropdown js-dropdown">
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="admins.php">
                                            <i class="zmdi zmdi-shield-security"></i>Gestion Admin</a>
                                    </div>
                                    
                                    <div class="account-dropdown__item">
                                        <a href="form.php">
                                            <i class="zmdi zmdi-account"></i>Gestion Utilisateur</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="plat.php">
                                            <i class="zmdi zmdi-collection-folder-image"></i>Gestion Plateforme</a>
                                    </div>
                                    
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                                
                                    
                                    
                                    
                             
                        <?php } ?>
                        
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                                  <img src="images/icon/avatar-01.png" alt="John Doe" />
                                                      </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">Admin</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="images/icon/avatar-01.png" alt="Admin" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">Admin</a>
                                            </h5>
                                            <span class="email"><?php echo $_SESSION['user'] ; ?></span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="compte.php">
                                                <i class="zmdi zmdi-account"></i>Compte</a>
                                        </div>
                                        <?php if($_SESSION['aut']==1) {?>
                                        <div class="account-dropdown__item">
                                            <a href="admins.php">
                                                <i class="zmdi zmdi-settings"></i>Autorisation</a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="dash.php?dest=ok">
                                            <i class="zmdi zmdi-power"></i>Deconnection</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                          <a class="js-arrow" href="dash.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            
                        </li>
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="archive.php">
                                <i class="fas fa-copy"></i>Archives</a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                
            <div class="header-button-item <?php if(nombre_not($base)!=0) {echo "has-noti";} ?> js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                        <div class="notifi__title">
                            <p>Vous avez <?php  echo nombre_not($base);?> Notifications</p>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c1 img-cir img-40">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <div class="content">
                                <p>Message</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        
                        <div class="notifi__footer">
                            <a href="#">Mes Notifications</a>
                        </div>
                    </div>
                </div>
               
                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <img src="images/icon/avatar-01.png" alt="Admin" />
                      
                                              </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">Admin</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                        <img src="images/icon/avatar-01.png" alt="Admin" />
                      
                                                          </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="compte.php">Admin</a>
                                    </h5>
                                    <span class="email"><?php echo $_SESSION['user'] ; ?></span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="compte.php">
                                        <i class="zmdi zmdi-account"></i>Compte</a>
                                </div>
                                <?php if($_SESSION['aut']==1) {?>
                                        <div class="account-dropdown__item">
                                            <a href="admins.php">
                                                <i class="zmdi zmdi-settings"></i>Autorisation</a>
                                        </div>
                                        <?php } ?>
                              
                            </div>
                            <div class="account-dropdown__footer">
                            <a href="dash.php?dest=ok">
                                            <i class="zmdi zmdi-power"></i>Deconnection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">Bienvenue:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="#">Acceuil</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Dashboard</li>
                                    </ul>
                                </div>
                                <form class="au-form-icon--sm" action="" method="post">
                                    <input class="au-input--w300 au-input--style2" type="text" placeholder="Search for datas &amp; reports...">
                                    <button class="au-btn--submit2" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Bienvenue
                                <span>Admin!</span>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->

            <!-- STATISTIC-->
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number"><?php echo nombre_admin($base);?></h2>
                                <span class="desc">Admins</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number"><?php echo nombre_ins($base);?></h2>
                                <span class="desc">Utilisateurs</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number"><?php echo nombre_messnot($base);?></h2>
                                <span class="desc">Messages Notifiés</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

            <!-- STATISTIC CHART-->
            <section class="statistic-chart">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">statistiques</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <!-- CHART-->
                            <div>
                                    <form>
                                        <input type="hidden" id="jan" value="">
                                        <input type="hidden" id="fev" value="">
                                        <input type="hidden" id="mar" value="">
                                        <input type="hidden" id="avri" value="">
                                        <input type="hidden" id="mai" value="">
                                        <input type="hidden" id="juin" value="">
                                        <input type="hidden" id="jull" value="">
                                        <input type="hidden" id="aout" value="">
                                        <input type="hidden" id="sep" value="">
                                        <input type="hidden" id="oct" value="">
                                        <input type="hidden" id="nov" value="">
                                        <input type="hidden" id="dec" value="">
                                    </form>
                            </div>
                            <div class="statistic-chart-1">
                                <h3 class="title-3 m-b-30">Demandes</h3>
                                <div class="chart-wrap">
                                    <canvas id="widgetChart5"></canvas>
                                </div>
                                <div class="statistic-chart-1-note">
                                    <span class="big">demandes</span>
                                    <span>/ mois</span>
                                </div>
                                
                            </div>
                            <!-- END CHART-->
                        </div>
                       
                            
                        <div class="col-md-6 col-lg-4">
                            <!-- CHART PERCENT-->
                            <div>
                           
                                    <form>
                                        <input type="hidden" id="design" value="">
                                        <input type="hidden" id="import" value="">
                                        <input type="hidden" id="coach" value="">
                                        <input type="hidden" id="devp" value="">

                                    </form>
                            </div>
                            <div class="chart-percent-2">
                                <h3 class="title-3 m-b-30">Stat de services</h3>
                                <div class="chart-wrap">
                                    <canvas id="percent-chart2"></canvas>
                                    <div id="chartjs-tooltip">
                                        <table></table>
                                    </div>
                                </div>
                                <div class="chart-info">
                                    <div class="chart-note">
                                        <span class="dot dot--blue"></span>
                                        <span>designs</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--red"></span>
                                        <span>import/eX</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--green"></span>
                                        <span>Coaching</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--grey"></span>
                                        <span>dev</span>
                                    </div>
                                </div>
                            </div>
                            <!-- END CHART PERCENT-->
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC CHART-->

            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">Historique</h3>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                <form method="get" action="">    
                                    <div class="rs-select2--light rs-select2--sm">
                                        <select class="js-select2" name="time">
                                            <option selected="selected">Auhourd'hui</option>
                                            <option value="3">3 jours</option>
                                            <option value="7">1 semaines</option>
                                            <option value="31">1 mois</option>
                                            <option value="a">Tous</option>

                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                   
                                    <button class="au-btn-filter" type="submit">
                                        <i class="zmdi zmdi-filter-list"></i>filtrer</button>
                                <form>        
                                        
                                </div>
                                
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            
                                            <th>nom</th>
                                            <th>email</th>
                                            <th>Contact</th>
                                            <th>description</th>
                                            <th>date</th>
                                            <th>status</th>
    
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php while($new=$reqt->fetch()) { $idt=$new['idp'];?>
                                        <tr class="tr-shadow">
                                            
                                            <td> <?php if($new['idp']!=0) {echo me_user($idt,$base); } else {echo $new['nom']; }?></td>
                                            <td>
                                                <span class="block-email"><?php  if($new['idp']!=0) { echo me_mail($idt,$base); } else {echo $new['mail'];}  ?> </span>
                                            </td>
                                            <td>
                                            <?php if($new['idp']!=0) { echo me_contact($idt,$base); } else { echo $new['notel']; } ?>
                                             </td>
                                            <td class="desc"><a href="#" data-toggle="modal" data-target="#<?php echo $new['idg']; ?>"></a><?php echo $new['msg']; ?></td>
                                            <td><?php echo $new['dates']; ?></td>
                                            <td>
                                                <?php if($new['lire']=="non") {?>
                                                <span class="status--denied">Non repondu</span>
                                                <?php }else{ ?>
                                                    <span class="status--process">Repondu</span>
                                                <?php } ?>
                                            </td>
                                            
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Repondre">
                                                    <a href="#" data-toggle="modal" data-target="#exampleModal2"> <i class="zmdi zmdi-mail-send"></i> </a>
                                                    </button>
                                                
                                                    <!--<button class="item" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="option">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button> -->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->
<!-- Modals -->
<?php while ($mes=$req2->fetch()) { ?>
<div class="modal fade" id="<?php echo $mes['idg'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message type: <i style="color:orangered;" >Information</i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $mes['msg']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="#" data-toggle="modal" data-target="#exampleModal2"><button type="button" class="btn btn-primary">Repondre</button></a>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!--Modals fin -->
<!-- Modal envois-->
<?php ?>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Ecrire Votre message </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <textarea id="message" placeholder="message"> 
            </textarea>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary">Envoyer</button>
      </div>
    </div>
  </div>
</div>
<?php ?>
<!-- Modal envois fin-->
            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->