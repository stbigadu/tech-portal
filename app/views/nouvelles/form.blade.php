@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Nouvelles
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
                        <h1><i class="fa fa-bullhorn fa-fw"></i> Nouvelles <small><?php echo ($currentRoute == 'portal.nouvelles.create') ? 'Ajouter' : 'Modifier'; ?> une nouvelle</small></h1>
                    </div>
                </div>
            </div>
            
            <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
            
                <?php if ($errors->count() > 0) : ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-exclamation-circle fa-fw fa-3x pull-left"></i>
                        <div style="margin-left: 70px">
                            <h4>Oups!</h4> La nouvelle n'a pu être <?php echo ($currentRoute == 'portal.nouvelles.create') ? 'ajoutée' : 'modifiée'; ?>. Les erreurs suivants se sont produits:
                            <?php echo HTML::ul($errors->all()); ?>
                        </div>
                    </div>
                <?php endif; ?>
            
                <?php echo ($currentRoute == 'portal.nouvelles.create') ? Form::open(array('route' => 'portal.nouvelles.store', 'files' => true)) : Form::model($article, array('route' => array('portal.nouvelles.update', $article->id))); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="btn-toolbar" role="toolbar">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-warning" ><i class="fa fa-save fa-fw"></i> <?php echo ($currentRoute == 'portal.nouvelles.create') ? 'Ajouter la nouvelle' : 'Enregistrer les modifications'; ?></button>
                                </div>
                                <div class="btn-group">
                                    <a href="<?php echo ($currentRoute == 'portal.nouvelles.create') ? route('portal.nouvelles.index', array('page' => Input::get('page'))) : route('portal.nouvelles.view', array($article->id, 'page' => Input::get('page'))); ?>" class="btn btn-default"><i class="fa fa-times fa-fw"></i> Annuler</a>
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
                                                <dt><label>Date</label></dt>
                                                <dd>Le <?php echo mb_strtolower(strftime('%A %e %B %Y, à %H h %M', strtotime(date('Y-m-d H:i:s')))); ?></dd>
                                                
                                                <dt><label>Auteur</label></dt>
                                                <dd><?php echo Auth::user()->full_name; ?> <br /><i class="fa fa-envelope-o fa-fw"></i> <?php echo HTML::mailto(Auth::user()->email); ?></dd>
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
                                                <dd><?php echo Form::text('title', null, array('class' => 'form-control input-lg', 'placeholder' => 'Titre de la nouvelle...', 'id' => 'title', 'style' => 'font-size: 24px; font-weight: 500')); ?></dd>
                                                <dd><?php echo Form::textarea('content', null, array('class' => 'form-control', 'placeholder' => 'Texte de la nouvelle...', 'id' => 'content', 'rows' => 15)); ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                    </div>
                <?php echo Form::close(); ?>
                
                <script type="text/javascript">
                $('.toggle-tooltip').tooltip({container: 'body'});
                </script>
                
                <script type="text/javascript">
                
                // Datetime Picker
                var datetimepickerParam = {
                        language: 'fr',
                        autoclose: true,
                        format: 'yyyy-mm-dd hh:ii:ss',
                        todayBtn: 'linked',
                        todayHighlight: true,
                        minuteStep: 15,
                };
                
                $('#datetime').datetimepicker(datetimepickerParam);
                
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
        @stop
        
    @stop
