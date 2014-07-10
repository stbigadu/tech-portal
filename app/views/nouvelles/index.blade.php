@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Tableau de bord
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
                        <div class="btn-group">
                            <?php if (Auth::user()->is_admin) : ?>
                            <a href="<?php echo route('portal.nouvelles.create'); ?>" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> Ajouter une nouvelle</a>
                            <?php endif; ?>
                        </div>
                        <div class="btn-group">
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
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="list-group">
                            <?php foreach ($articles as $article) : ?>
                            <a href="#" class="list-group-item">
                                <small><small><p class="list-group-item-text"><?php echo ($article->datetime == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($article->datetime))); ?></p></small></small>
                                <p class="list-group-item-heading"><strong><?php echo strip_tags($article->title); ?></strong></p>
                                <small><p class="list-group-item-text"><?php echo T4KHelpers::trunc_string(strip_tags($article->content), 100); ?></p></small>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <div class="alert alert-warning text-center">Veuillez choisir une nouvelle.</div>
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
        @stop
        
    @stop
