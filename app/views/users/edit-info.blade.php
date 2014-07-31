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
                        <h1><i class="fa fa-user fa-fw"></i> Bonjour <?php echo Auth::user()->full_name; ?>! <small>Modifier mes informations personnelles et mes coordonnées</small></h1>
                    </div>
                </div>
            </div>
            
            <?php echo Form::open(array('route' => 'portal.users.update.info', 'class' => 'form-horizontal')); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <div class="btn-group">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-save fa-fw"></i> Enregistrer les modifications</button>
                        </div>
                        
                        <div class="btn-group">
                            <a href="<?php echo route('portal.users.profile'); ?>" class="btn btn-default"><i class="fa fa-times-circle fa-fw"></i> Annuler</a>
                        </div>
                    
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Informations personnelles</h3>
                        </div>
                        <div class="panel-body">
                        
                            <div class="form-group">
                                <label for="first_name" class="col-sm-4 control-label">Prénom</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"><?php echo Auth::user()->first_name; ?></p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="last_name" class="col-sm-4 control-label">Nom</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"><?php echo Auth::user()->last_name; ?></p>
                                </div>
                            </div>
                            
                            <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
                            <div class="form-group">
                                <label for="professional_title" class="col-sm-4 control-label">Titre professionnel</label>
                                <div class="col-sm-8">
                                    <?php echo Form::text('professional_title', Auth::user()->professional_title, array('class' => 'form-control', 'placeholder' => 'Titre professionnel...', 'id' => 'professional_title')); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <label for="role" class="col-sm-4 control-label">Rôle</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"><?php echo Auth::user()->role->title; ?></p>
                                </div>
                            </div>
                            
                            <?php if (Auth::user()->is_student) : ?>
                            <div class="form-group">
                                <label for="groupe" class="col-sm-4 control-label">Groupe</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static"><?php echo Auth::user()->groupe; ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Informations de contact</h3>
                        </div>
                        <div class="panel-body">
                            
                            <div class="form-group">
                                <label for="email" class="col-sm-4 control-label">Courriel</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                        <?php echo Form::email('email', Auth::user()->email, array('class' => 'form-control', 'placeholder' => 'exemple@team3990.com', 'id' => 'email')); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="cellphone_number" class="col-sm-4 control-label">Téléphone (cellulaire)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
                                        <?php echo Form::text('cellphone_number', Auth::user()->cellphone_number, array('class' => 'form-control', 'placeholder' => '(555) 555-5555', 'id' => 'cellphone_number')); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="home_number_1" class="col-sm-4 control-label">Téléphone (maison #1)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                        <?php echo Form::text('home_number_1', Auth::user()->home_number_1, array('class' => 'form-control', 'placeholder' => '(555) 555-5555', 'id' => 'home_number_1')); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="home_number_2" class="col-sm-4 control-label">Téléphone (maison #2)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                        <?php echo Form::text('home_number_2', Auth::user()->home_number_2, array('class' => 'form-control', 'placeholder' => '(555) 555-5555', 'id' => 'home_number_2')); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="other_number" class="col-sm-4 control-label">Téléphone (autre)</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-building fa-fw"></i></span>
                                        <?php echo Form::text('other_number', Auth::user()->other_number, array('class' => 'form-control', 'placeholder' => '(555) 555-5555', 'id' => 'other_number')); ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                
                    <?php if ($errors->count() > 0) : ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-exclamation-circle fa-fw fa-3x pull-left"></i>
                        <div style="margin-left: 70px">
                            <h4>Oups!</h4> Le mot de passe n'a pu être modifié. Les erreurs suivants se sont produits:
                            <?php echo HTML::ul($errors->all()); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                
                    <div class="alert alert-warning">
                        <i class="fa fa-info-circle fa-fw fa-2x pull-left"></i>
                        <div style="margin-left: 50px">
                            <strong>Numéro de cellulaire</strong>
                            Si vous possédez un numéro de cellulaire, nous vous prions de le spécifier. Lors de sorties en groupe, cela peut être utile s'il y a besoin de vous retrouver rapidement.
                        </div>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="fa fa-info-circle fa-fw fa-2x pull-left"></i>
                        <div style="margin-left: 50px">
                            <strong>En cas d'urgence</strong>
                            Les trois autres champs pour les numéros de téléphone sont les numéros à contacter en cas d'urgence. Il peut s'agir de :
                            <ul>
                                <li>Numéro à votre domicile</li>
                                <li>Numéro de cellulaire de vos parents</li>
                                <li>Numéro de téléphone au travail</li>
                                <li>etc...</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php echo Form::close(); ?>
            
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
