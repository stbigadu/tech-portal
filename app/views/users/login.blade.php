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
                    {{ HTML::image('/assets/images/logos-t4k/T4K_RGB_round[colour]_transparent.png', 'Équipe Team 3990: Tech for Kids', array('class' => 'img-responsive')) }}
                </div>
    
                <div class="col-lg-4 col-md-4">
                    {{ Form::open(array('url' => 'users/connection', 'class' => 'form_signin')) }}
                    
                        <h2 class="form-signin-heading login-heading">Se connecter</h2>
                        
                        <p>Pour continuer sur <strong>Tech Portail</strong>, veuillez vous connecter.</p>
                        
                        @if(Session::has('message'))
                            <div class="alert alert-danger">
                                <p>{{ Session::get('message') }}</p>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                
                        <div class="input-group" style="margin-bottom: 10px">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Nom d'utilisateur" required autofocus />
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required />
                        </div>
                        
                        <label class="checkbox">
                            <input type="checkbox" value="remember-me" /> Se souvenir de moi sur cet ordinateur
                        </label>
                        
                        <p><button class="btn btn-t4k" type="submit">Connexion <i class="fa fa-chevron-circle-right fa-fw"></i></button></p>
                        
                        <p><a href="#">J'ai oublié mon mot de passe</a></p>
                        
                    {{ Form::close() }}
                    
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
