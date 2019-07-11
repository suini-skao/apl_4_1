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
    $reqa=$bdd->query('SELECT* FROM admin_conf');
    if(isset($_POST['user'])&&isset($_POST['umdp'])&&isset($_POST['aut']))
    {
        $base=$bdd;
        adminins($base,$_POST['user'],$_POST['umdp'],$_POST['aut']);
        header('location:admins.php');
    }
    if(isset($_GET['id']))
    {
        $id=protect($_GET['id']);
        sup_admin($id,$bdd);
        header('location:admins.php');
    }
    $base=$bdd;
    $reqm=$bdd->prepare("SELECT* FROM g_messagerie  WHERE lire=:ok");
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
    <title>Gestiob administration 3</title>

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
                                            <i class="zmdi zmdi-account"></i>Gestion Admin</a>
                                    </div>
                                    
                                    <div class="account-dropdown__item">
                                        <a href="form.php">
                                            <i class="zmdi zmdi-account"></i>Gestion Utilisateur</a>
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
                                            <a href="#">compte</a>
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
            <section>
                <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                    <h4>Users</h4>
                    <br>
                        <table class="table table-data2">
                                <thead>
                                        <tr>
                                            
                                            <th>speudo</th>
                                            <th>aurorisation</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                          <?php while($admin=$reqa->fetch()) {?>
                                            <tr class="tr-shadow">
                                                
                                                <td>
                                                    <span class=""> <?php echo $admin['email']; ?></span>
                                                </td>
                                                <td>
                                                <?php echo $admin['autor']; ?>
                                                 </td>
                                                
                                                
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a  href="admins.php?idt=<?php echo $admin['ida'];?>"><button class="item" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                        <a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>

                                          <?php }?>
                                        </tbody>
                        </table>
                    </div>
                    <div class="col-lg-3">
                        <h4>Ajouter un administrateur</h4> <br>
                        <form action="" method="post">
                            <label for="user">Speudo Admin</label>
                            <input type="text" name="user" id="user" class="form-control">
                            <label for="umdp">Mot de passe</label>
                            <input type="text" name="umdp" id="umdp" class="form-control">
                            <label for="au">Autorisation</label>
                            <input type="text" name="aut" id="aut" class="form-control">
                            <br>
                            <button type="submit"  class="form-control status--process" >Sauvegarder</button>
                        </form>
                       
                    </div>
                </div>
                <div>
            </section>
           
            <!-- END DATA TABLE-->

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
     <?php
     if(isset($_GET['idt']))
     {
         ?>
         <div class="pupconf">
             <h4 class="texts"> Confirmer la suppression</h4>
             <a href="admins.php"><button class="bt1 pointy"> Fermer</button></a>
             <a href="admins.php?id=<?php echo $_GET['idt'];?>"><button class="bt2 pointy"> Confirmer</button></a>
         </div>
         
         <?php
     }
     
     
     ?>                                       
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