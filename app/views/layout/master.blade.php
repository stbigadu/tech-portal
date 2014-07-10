<!DOCTYPE html>
<html lang="fr-ca">

<head>
@section('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tech Portail: @yield('title') - Équipe Team 3990: Tech for Kids</title> 
    
    @section('stylesheets')
        <!-- Font Awesome -->
        {{ HTML::style('/assets/font-awesome/css/font-awesome.css'); }}
        
        <!-- Bootstrap -->
        {{ HTML::style('/assets/bootstrap/css/bootstrap.min.css'); }} 
        
        <!-- Styles -->
        {{ HTML::style('/assets/styles/t4k-styles.css'); }}
    @show
    
    @section('scripts_header')
    @show
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
@show
</head>

<body>

@section('body')
    
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">Tech Portail</a>
            </div>
            <?php if (Auth::check()) : ?>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo route('portal.nouvelles.index'); ?>"><i class="fa fa-bullhorn fa-fw"></i> Nouvelles</a></li>
                <li><a href="#"><i class="fa fa-calendar fa-fw"></i> Calendrier</a></li>
                <li><a href="#"><i class="fa fa-clock-o fa-fw"></i> Horaire</a></li>
                <li><a href="#"><i class="fa fa-users fa-fw"></i> Équipe</a></li>
            </ul>
            <?php endif; ?>
            <ul class="nav navbar-nav navbar-right">
                <?php if (Auth::check()) : ?>
                <li><p class="navbar-text">Bonjour, <strong><?php echo Auth::user()->first_name; ?></strong>!</p></li>
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Mon compte</a></li>
                <li><a href="<?php echo route('portal.users.logout'); ?>"><i class="fa fa-power-off fa-fw"></i> Se déconnecter</a></li>
                <?php endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th fa-fw"></i> <i class="fa fa-caret-down fa-fw"></i></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Applications pour élèves et mentors</li>
                        <li><a href="#"><i class="fa fa-cube fa-fw"></i> Tech Portail</a></li>
                        <li class="disabled"><a href="#"><i class="fa fa-briefcase fa-fw"></i> Tech Projets</a></li>
                        <li class="disabled"><a href="#"><i class="fa fa-automobile fa-fw"></i> Tech Parts</a></li>
                        <li class="disabled"><a href="#"><i class="fa fa-bug fa-fw"></i> Tech Incidents</a></li>
                        <li class="disabled"><a href="#"><i class="fa fa-fw"></i> Tech Wiki</a></li>
                        <li><a href="https://my.usfirst.org/stims/" target="_blank"><i class="fa fa-fw"></i> STIMS</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Platforme</li>
                        <li><a href="http://academy.team3990.com" target="_blank"><i class="fa fa-book fa-fw"></i> Tech Académie</a></li>
                        <li class="disabled"><a href="#"><i class="fa fa-flask fa-fw"></i> Tech Labo</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header no-wrap">Applications pour mentors et apprentis mentors</li>
                        <li><a href="http://courriel.team3990.com" target="_blank"><i class="fa fa-envelope fa-fw"></i> Tech Courriel</a></li>
                        <li><a href="https://my.usfirst.org/frc/tims/site.lasso" target="_blank"><i class="fa fa-fw"></i> TIMS</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="container">
        @yield('content')
    </div>
    
@show

@section('footer')

    @section('footer-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-muted text-center">
            <hr />
            <small>
                Équipe Team 3990: Tech for Kids. 
                <i class="fa fa-info-circle fa-fw"></i> Version 4.0.0 (20140609). <a href="#">Change Log</a>. 
                <i class="fa fa-question-circle fa-fw"></i> Soutien technique: <a href="mailto:webmaster@team3990.com">webmaster@team3990.com</a>
                <br />
                <i class="fa fa-facebook fa-fw"></i> facebook.com/team3990 
                <i class="fa fa-twitter fa-fw"></i> @team3990 
                <i class="fa fa-youtube-play fa-fw"></i> youtube.com/team3990 
                <i class="fa fa-google-plus fa-fw"></i> Google+ 
                <i class="fa fa-tumblr fa-fw"></i> team3990.tumblr.com 
                <i class="fa fa-pinterest fa-fw"></i> pinterest.com/team3990 
                <i class="fa fa-instagram fa-fw"></i> @team3990
                <i class="fa fa-github fa-fw"></i> github.com/team3990
            </small>
            </div>
        </div>
    </div>
    @show

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	{{ HTML::script('/assets/jquery/jquery-2.1.1.min.js'); }}
	{{ HTML::script('/assets/bootstrap/js/bootstrap.min.js'); }}
    	
	@section('scripts_eof')
	@show
	
@show

</body>

</html>