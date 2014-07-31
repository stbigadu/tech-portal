@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Mon profil
        @stop
        
        @section('stylesheets')
            @parent
        @stop
        
        @section('scripts_header')
            @parent
        @stop
        
    @stop

    {{-- HTML Body Section --}}
    @section('body')
    
        @parent
    
        @section('content')
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1><i class="fa fa-user fa-fw"></i> Bonjour <?php echo Auth::user()->full_name; ?>! <small>Mon profil</small></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <div class="btn-group">
                            <a href="<?php echo route('portal.users.edit.info'); ?>" class="btn btn-default"><i class="fa fa-user fa-fw"></i> Modifier mes informations</a>
                        </div>
                        
                        <div class="btn-group">
                            <a href="<?php echo route('portal.users.edit.password'); ?>" class="btn btn-default"><i class="fa fa-lock fa-fw"></i> Modifier mon mot de passe</a>
                        </div>
                    
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                    <?php if (Session::has('update_password') && Session::get('update_password') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Mot de passe modifié</h4> Votre mot de passe a été modifié avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (Session::has('update_info') && Session::get('update_info') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Informations personnelles et coordonnées modifiés</h4> Vos informations personnelles et coordonnées de contact ont été modifiés avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Informations personnelles</h3>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                            
                                <dt>Prénom</dt>
                                <dd><?php echo $user->first_name; ?></dd>
                                
                                <dt>Nom</dt>
                                <dd><?php echo $user->last_name; ?></dd>
                                
                                <?php if ($user->is_mentor || $user->is_junior_mentor) : ?>
                                <dt>Titre professionnel</dt>
                                <dd><?php echo $user->professional_title; ?></dd>
                                <?php endif; ?>
                                
                                <dt>Rôle</dt>
                                <dd><?php echo $user->role->title; ?></dd>
                                
                                <?php if ($user->is_student) : ?>
                                <dt>Groupe</dt>
                                <dd><?php echo $user->groupe; ?></dd>
                                <?php endif; ?>
                                
                            </dl>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Informations de contact</h3>
                        </div>
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                            
                                <dt>Courriel</dt>
                                <dd><i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?></a></dd>
                                
                                <dt>Téléphone (cellulaire)</dt>
                                <dd><i class="fa fa-mobile fa-fw"></i> <?php echo $user->cellphone_number; ?></dd>
                                
                                <dt>Téléphone (maison #1)</dt>
                                <dd><i class="fa fa-phone fa-fw"></i> <?php echo $user->home_number_1; ?></dd>
                                
                                <dt>Téléphone (maison #2)</dt>
                                <dd><i class="fa fa-phone fa-fw"></i> <?php echo $user->home_number_2; ?></dd>
                                
                                <dt>Téléphone (autre)</dt>
                                <dd><i class="fa fa-building fa-fw"></i> <?php echo $user->other_number; ?></dd>
                                                                
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            
        @stop
        
    @stop
    
    @section('footer')
        
        @parent 
        
        @section('footer-content')
            @parent
        @stop
    
        @section('scripts_eof')
            @parent
            <script language="javascript" type="text/javascript">
            function popup(url) {
            	newwindow=window.open(url,'','height=500,width=700,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes');
            	newwindow.focus()
            	return false;
            }
            </script>
        @stop
        
    @stop
