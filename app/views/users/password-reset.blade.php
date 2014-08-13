@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Connexion
        @stop
        
        @section('stylesheets')
           @parent
           {{ HTML::style('/assets/styles/t4k-login.css'); }} 
        @stop
        
        @section('scripts_header')
           @parent
        @stop
        
    @stop

    {{-- HTML Body Section --}}
    @section('body')
    
        @parent
    
        @section('content')
        <div class="container">
        
            <div class="row login-container">
            
                <div class="col-lg-4 col-md-4 col-lg-offset-2 col-md-offset-2 hidden-xs">
                    <?php echo HTML::image('/assets/images/logos-t4k/T4K_RGB_round[colour]_transparent.png', 'Équipe Team 3990: Tech for Kids', array('class' => 'img-responsive')); ?>
                </div>
    
                <div class="col-lg-4 col-md-4">
                    <?php echo Form::open(array('route' => 'portal.users.postreset', 'class' => 'form_signin')) ?>
                    
                        <?php echo Form::hidden('token', $token); ?>
                    
                        <h2 class="form-signin-heading login-heading">Réinitialiser votre mot de passe</h2>
                        
                        <p>Veuillez remplir les champs suivants pour réinitialiser votre mot de passe.</p>
                        
                        <?php if(Session::has('error')) : ?>
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-circle fa-fw fa-2x pull-left"></i>
                                <div style="margin-left: 50px">Le courriel ou le mot de passe est invalide. Veuillez réessayer à nouveau.</div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($errors->count() > 0) : ?>
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-circle fa-fw fa-2x pull-left"></i>
                                <div style="margin-left: 50px"><?php echo HTML::ul($errors->all()); ?></div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="input-group" style="margin-bottom: 10px">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <?php echo Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Courriel', 'id' => 'email')); ?>
                        </div>
                        
                        <div class="input-group" style="margin-bottom: 10px">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <?php echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Nouveau mot de passe', 'id' => 'password')); ?>
                        </div>
                        
                        <div class="input-group" style="margin-bottom: 10px">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <?php echo Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirmer le nouveau mot de passe', 'id' => 'password_confirmation')); ?>
                        </div>
                        
                        <p><button class="btn btn-t4k" type="submit">Réinitialiser le mot de passe <i class="fa fa-chevron-circle-right fa-fw"></i></button></p>
                        
                    <?php echo Form::close(); ?>
                    
                </div>
                            
            </div>
    
        </div>
        @stop
        
    @stop
    
    @section('footer')
        
        @parent 
        
        @section('footer-content')
        @stop
    
        @section('scripts_eof')
        @stop
        
    @stop
