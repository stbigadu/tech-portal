@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Mon profil
        @stop
        
        @section('stylesheets')
            @parent
            <!-- Selectize.js -->
            {{ HTML::style('/assets/selectize/dist/css/selectize.bootstrap3.css'); }}
        @stop
        
        @section('scripts_header')
            @parent
            <!-- Selectize.js -->
            {{ HTML::script('/assets/selectize/dist/js/standalone/selectize.min.js'); }}
        @stop
        
    @stop

    {{-- HTML Body Section --}}
    @section('body')
    
        @parent
    
        @section('content')
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1><i class="fa fa-cog fa-fw"></i> Administration <small>Gestion des utilisateurs <i class="fa fa-caret-right fa-fw"></i> <?php echo ($currentRoute == 'portal.admin.users.create') ? 'Ajouter' : 'Modifier'; ?> un utilisateur</small></h1>
                    </div>
                </div>
            </div>
            
            <?php if (Auth::user()->is_admin) : ?>
            
                <?php if ($errors->count() > 0) : ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-exclamation-circle fa-fw fa-3x pull-left"></i>
                        <div style="margin-left: 70px">
                            <h4>Oups!</h4> L'utilisateur n'a pu être <?php echo ($currentRoute == 'portal.admin.users.create') ? 'ajouté' : 'modifié'; ?>. Les erreurs suivants se sont produits:
                            <?php echo HTML::ul($errors->all()); ?>
                        </div>
                    </div>
                <?php endif; ?>
            
                <?php echo ($currentRoute == 'portal.admin.users.create') ? Form::open(array('route' => 'portal.admin.users.store', 'files' => true, 'class' => 'form-horizontal')) : Form::model($event, array('route' => array('portal.admin.users.update', $event->id), 'class' => 'form-horizontal')); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="btn-toolbar" role="toolbar">
                        
                            <div class="btn-group">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-save fa-fw"></i> <?php echo ($currentRoute == 'portal.admin.users.create') ? 'Ajouter l\'utilisateur' : 'Enregistrer les modifications'; ?></button>
                            </div>
                            
                            <div class="btn-group">
                                <a href="<?php echo route('portal.admin.users.index'); ?>" class="btn btn-default"><i class="fa fa-times-circle fa-fw"></i> Annuler</a>
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
                                        <?php echo Form::text('first_name', null, array('class' => 'form-control', 'placeholder' => 'Prénom de l\'utilisateur...', 'id' => 'first_name')); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name" class="col-sm-4 control-label">Nom</label>
                                    <div class="col-sm-8">
                                        <?php echo Form::text('last_name', null, array('class' => 'form-control', 'placeholder' => 'Nom de l\'utilisateur...', 'id' => 'last_name')); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="professional_title" class="col-sm-4 control-label">Titre professionnel</label>
                                    <div class="col-sm-8">
                                        <?php echo Form::text('professional_title', null, array('class' => 'form-control', 'placeholder' => 'Titre professionnel...', 'id' => 'professional_title')); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="role" class="col-sm-4 control-label">Rôle</label>
                                    <div class="col-sm-8">
                                        <?php echo Form::select('user_role_id', $roles_select, null, array('class' => 'form-control', 'id' => 'user_role_id')); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="groupe" class="col-sm-4 control-label">Groupe</label>
                                    <div class="col-sm-8">
                                        <?php echo Form::text('groupe', null, array('class' => 'form-control', 'placeholder' => 'Groupe de l\'élève...', 'id' => 'groupe')); ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    
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
                                            <?php echo Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'exemple@team3990.com', 'id' => 'email')); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="cellphone_number" class="col-sm-4 control-label">Téléphone (cellulaire)</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
                                            <?php echo Form::text('cellphone_number', null, array('class' => 'form-control', 'placeholder' => '(555) 555-5555', 'id' => 'cellphone_number')); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="home_number_1" class="col-sm-4 control-label">Téléphone (maison #1)</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                            <?php echo Form::text('home_number_1', null, array('class' => 'form-control', 'placeholder' => '(555) 555-5555', 'id' => 'home_number_1')); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="home_number_2" class="col-sm-4 control-label">Téléphone (maison #2)</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                            <?php echo Form::text('home_number_2', null, array('class' => 'form-control', 'placeholder' => '(555) 555-5555', 'id' => 'home_number_2')); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="other_number" class="col-sm-4 control-label">Téléphone (autre)</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-building fa-fw"></i></span>
                                            <?php echo Form::text('other_number', null, array('class' => 'form-control', 'placeholder' => '(555) 555-5555', 'id' => 'other_number')); ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
                <?php echo Form::close(); ?>
            
            <?php else : ?>
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-3 col-xs-12">
                    <div class="alert alert-danger text-center">Vous n'avez pas les droits d'administrateur pour effectuer cette opération.</div>
                </div>
            </div>
            <?php endif; ?>
            
        @stop
        
    @stop
    
    @section('footer')
        
        @parent 
        
        @section('footer-content')
            @parent
        @stop
    
        @section('scripts_eof')
            @parent
            <script type="text/javascript">
            
            $(function() {
                $('#user_role_id').selectize({
                    create: false,
                    sortField: 'text'
                });
            });
            
            </script>
        @stop
        
    @stop
