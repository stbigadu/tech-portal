@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Calendrier
        @stop
        
        @section('stylesheets')
            @parent
            <!-- Bootstrap WYSIWYG -->
            {{ HTML::style('/assets/bootstrap3-wysihtml5/dist/bootstrap3-wysihtml5.min.css'); }}
            <!-- Bootstrap Datetime Picker -->
            {{ HTML::style('/assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'); }}
        @stop
        
        @section('scripts_header')
            @parent
            <!-- Bootstrap WYSIWYG -->
            {{ HTML::script('/assets/bootstrap3-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js'); }}
            {{ HTML::script('/assets/bootstrap3-wysihtml5/dist/locales/bootstrap-wysihtml5.fr-FR.js'); }}
            <!-- Bootstrap Datetime Picker -->
            {{ HTML::script('/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'); }}
            {{ HTML::script('/assets/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.fr.js'); }}
        @stop
        
    @stop

    {{-- HTML Body Section --}}
    @section('body')
    
        @parent
    
        @section('content')
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1><i class="fa fa-calendar fa-fw"></i> Calendrier <small><?php echo ($currentRoute == 'portal.events.create') ? 'Ajouter' : 'Modifier'; ?> un évènement</small></h1>
                    </div>
                </div>
            </div>
            
            <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
            
                <?php if ($errors->count() > 0) : ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-exclamation-circle fa-fw fa-3x pull-left"></i>
                        <div style="margin-left: 70px">
                            <h4>Oups!</h4> L'évènement n'a pu être <?php echo ($currentRoute == 'portal.events.create') ? 'ajouté' : 'modifié'; ?>. Les erreurs suivants se sont produits:
                            <?php echo HTML::ul($errors->all()); ?>
                        </div>
                    </div>
                <?php endif; ?>
            
                <?php echo ($currentRoute == 'portal.events.create') ? Form::open(array('route' => 'portal.events.store', 'files' => true)) : Form::model($event, array('route' => array('portal.events.update', $event->id))); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="btn-toolbar" role="toolbar">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-warning" ><i class="fa fa-save fa-fw"></i> <?php echo ($currentRoute == 'portal.events.create') ? 'Ajouter l\'évènement' : 'Enregistrer les modifications'; ?></button>
                                </div>
                                <div class="btn-group">
                                    <a href="<?php echo ($currentRoute == 'portal.events.create') ? route('portal.events.index', array('page' => Input::get('page'))) : route(Input::get('view'), array($event->id, 'page' => Input::get('page'))); ?>" class="btn btn-default"><i class="fa fa-times fa-fw"></i> Annuler</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#form-info" role="tab" data-toggle="tab">Informations</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="form-info">
                                    <div class="panel panel-default panel-tabs">
                                        <div class="panel-body">
                                            <dl>
                                                
                                                <dt><label>Auteur</label></dt>
                                                <dd><?php echo Auth::user()->full_name; ?> <br /><i class="fa fa-envelope-o fa-fw"></i> <?php echo HTML::mailto(Auth::user()->email); ?></dd>
                                                
                                                <dt><label for="date_event">Début de l'évènement</label></dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <?php echo Form::text('datetime_start', null, array('class' => 'form-control date', 'placeholder' => 'Début de l\'évènement...', 'id' => 'datetime_start')); ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                    </div>
                                                </dd>
                                                
                                                <dt><label for="time_start">Fin de l'évènement</label></dt>
                                                <dd>
                                                    <div class="input-group">
                                                        <?php echo Form::text('datetime_end', null, array('class' => 'form-control date', 'placeholder' => 'Fin de l\'évènement...', 'id' => 'datetime_end')); ?>
                                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                    </div>
                                                </dd>
                                                
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#form-content" role="tab" data-toggle="tab">Contenu</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="form-info">
                                    <div class="panel panel-default panel-tabs">
                                        <div class="panel-body">
                                            <dl>
                                                <dd><?php echo Form::text('title', null, array('class' => 'form-control input-lg', 'placeholder' => 'Titre de l\'évènement...', 'id' => 'title', 'style' => 'font-size: 24px; font-weight: 500')); ?></dd>
                                                <dd><?php echo Form::textarea('content', null, array('class' => 'form-control', 'placeholder' => 'Texte de l\'évènement...', 'id' => 'content', 'rows' => 15)); ?></dd>
                                            </dl>
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
                $('.toggle-tooltip').tooltip({container: 'body'});
            </script>
    
            <script type="text/javascript">
                // WYSIHTML5 Textarea Editor
                var wysihtml5Param = {
                        locale: 'fr-FR',
                        html: true,
                        color: true,
                        size: 'sm',
                        fa: true
                };
                
                $('#content').wysihtml5(wysihtml5Param);
            </script>
            
            <script type="text/javascript">
                // Datetime Picker
                var datetimepickerParam1 = {
                        language: 'fr',
                        autoclose: true,
                        format: 'yyyy-mm-dd hh:ii',
                        startView: 3,
                        minView: 0,
                        maxView: 3,
                        minuteStep: 15,
                        todayBtn: true,
                        todayHighlight: true
                };
                var datetimepickerParam2 = {
                        language: 'fr',
                        autoclose: true,
                        format: 'yyyy-mm-dd hh:ii',
                        startView: 1,
                        minView: 0,
                        maxView: 0,
                        minuteStep: 15
                };
    
                $('#datetime_start').datetimepicker(datetimepickerParam1).on('changeDate', function(ev) {
                    $('#datetime_end').val($('#datetime_start').val());
                });
                $('#datetime_end').datetimepicker(datetimepickerParam2);
            </script>
            
        @stop
        
    @stop
