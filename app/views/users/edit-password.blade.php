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
                        <h1><i class="fa fa-user fa-fw"></i> Bonjour <?php echo Auth::user()->full_name; ?>! <small>Modifier mon mot de passe</small></h1>
                    </div>
                </div>
            </div>
            
            <?php echo Form::open(array('route' => 'portal.users.update.password', 'class' => 'form-horizontal')); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <div class="btn-group">
                            <button type="submit" class="btn btn-warning"><i class="fa fa-save fa-fw"></i> Enregistrer le nouveau mot de passe</button>
                        </div>
                        
                        <div class="btn-group">
                            <a href="<?php echo route('portal.users.profile'); ?>" class="btn btn-default"><i class="fa fa-times-circle fa-fw"></i> Annuler</a>
                        </div>
                    
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        
                            <div class="form-group">
                                <label for="old_password" class="col-sm-4 control-label">Mot de passe actuel</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                        <?php echo Form::password('old_password', array('class' => 'form-control', 'placeholder' => 'Tapez votre mot de passe actuel...', 'id' => 'old_password')); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="new_password" class="col-sm-4 control-label">Nouveau mot de passe</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                        <?php echo Form::password('new_password', array('class' => 'form-control', 'placeholder' => 'Tapez votre nouveau mot de passe...', 'id' => 'new_password')); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="new_password_confirmation" class="col-sm-4 control-label"></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                        <?php echo Form::password('new_password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirmez votre nouveau mot de passe...', 'id' => 'new_password_confirmation')); ?>
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
                        <i class="fa fa-exclamation-circle fa-fw fa-2x pull-left"></i>
                        <div style="margin-left: 50px">
                            <strong>Entre 6 et 25 caractères!</strong>
                            Vous devez choisir un mot de passe entre 6 et 25 caractères.
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
