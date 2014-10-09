@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Nouvelles
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
                        <h1><i class="fa fa-bullhorn fa-fw"></i> Nouvelles <small>Toutes les nouvelles</small></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <?php if (Auth::user()->is_mentor) : ?>
                        <div class="btn-group">
                            <a href="<?php echo route('portal.nouvelles.create', array('page' => Input::get('page'))); ?>" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> Ajouter une nouvelle</a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($article) && Auth::user()->is_mentor) : ?>
                        <div class="btn-group">
                            <a href="<?php echo route('portal.nouvelles.edit', array($article->id, 'page' => Input::get('page'))); ?>" class="btn btn-default"><i class="fa fa-pencil fa-fw"></i> Modifier la nouvelle</a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-default" data-toggle="modal" data-target="#modal-destroy-<?php echo $article->id; ?>"><i class="fa fa-trash-o fa-fw"></i> Supprimer la nouvelle</button>
                        </div>
                        <div class="modal fade" id="modal-destroy-<?php echo $article->id; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Supprimer une nouvelle</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <i class="fa fa-bullhorn fa-fw fa-3x pull-left"></i>
                                                <div style="margin-left: 70px">
                                                    <h4 style="margin-top: 0"><?php echo strip_tags($article->title); ?></h4>
                                                    Le <strong><?php echo mb_strtolower(strftime('%A %e %B %Y, à %H h %M', strtotime($article->datetime))); ?></strong><br />
                                                    Par <?php echo $article->user->full_name; ?> (<i class="fa fa-envelope-o fa-fw"></i> <?php echo HTML::mailto($article->user->email); ?>)
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-danger text-center"><strong>Êtes-vous sûr de vouloir supprimer cette nouvelle?</strong></div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo route('portal.nouvelles.destroy', $article->id); ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="btn-group pull-right">
                            <button class="btn btn-noborder disabled">
                                <?php echo $ItemsCount; ?> nouvelle(s) au total.
                                <i class="fa fa-files-o fa-fw"></i> Page(s) : 
                            </button>
                            <?php echo $articles->links(); ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12<?php echo ($currentRoute == 'portal.nouvelles.view') ? ' hidden-xs' : ''; ?>">
                    <div class="panel panel-default">
                        <div class="list-group">
                            <?php foreach ($articles as $a) : ?>
                            <a href="<?php echo route('portal.nouvelles.view', array($a->id, 'page' => Input::get('page'))); ?>" class="list-group-item<?php echo (@$article->id == $a->id) ? ' list-group-item-warning' : ''; ?>">
                                <small><small><p class="list-group-item-text"><?php echo ($a->datetime == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($a->datetime))); ?></p></small></small>
                                <p class="list-group-item-heading"><strong><?php echo strip_tags($a->title); ?></strong></p>
                                <small><p class="list-group-item-text"><?php echo T4KHelpers::trunc_string(strip_tags($a->content), 100); ?></p></small>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <?php if ($currentRoute == 'portal.nouvelles.index') : ?>
                <div class="col-lg-8 col-md-8 col-sm-6 hidden-xs">
                
                    <?php if (Session::has('destroy') && Session::get('destroy') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Nouvelle supprimée</h4> La nouvelle &laquo; <strong><?php echo strip_tags(Session::get('object_name')); ?></strong> &raquo; a été supprimée avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="alert alert-warning text-center">Veuillez choisir une nouvelle.</div>
                </div>
                <?php else : ?>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                
                    <?php if (Session::has('store') && Session::get('store') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Nouvelle créée</h4> La nouvelle &laquo; <strong><?php echo strip_tags($article->title); ?></strong> &raquo; a été créée avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (Session::has('update') && Session::get('update') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Nouvelle modifiée</h4> La nouvelle &laquo; <strong><?php echo strip_tags($article->title); ?></strong> &raquo; a été modifiée avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading text-muted small">
                            <dl class="dl-horizontal">
                                
                                <dt>Date</dt>
                                <dd><i class="fa fa-clock-o fa-fw"></i> <?php echo ($article->datetime == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($article->datetime))); ?></dd>
                                
                                <dt>Créé par</dt>
                                <dd><i class="fa fa-user fa-fw"></i> <?php echo $article->user->full_name; ?> (<i class="fa fa-envelope-o fa-fw"></i> <?php echo HTML::mailto($article->user->email); ?>)</dd>
                                
                            </dl>
                        </div>
                        <div class="panel-body">
                            <h1 style="margin-top: 0; padding-top: 0"><?php echo $article->title; ?></h1>
                            <hr />
                            <?php echo $article->content; ?>
                        </div>
                        <?php if (count($article->files) > 0) : ?>
                        <ul class="list-group">
                            <li class="list-group-item">
                                Pièce(s) jointe(s) :
                                <ul>
                                    <?php foreach ($article->files as $file) : ?>
                                        <li>
                                            <a href="<?php echo url($file->path); ?>" target="_blank"><i class="fa fa-cloud-download fa-fw"></i> <?php echo $file->name ?></a> 
                                            <span class="text-muted">(<?php echo number_format(round($file->size / 1024), 0, ',', ' '); ?> Ko)</span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        </ul>
                        <?php endif; ?>
                    </div>
                
                </div>
                <?php endif; ?>
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
        @stop
        
    @stop
