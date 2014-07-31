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
                    <div class="page-header"><h1><i class="fa fa-dashboard fa-fw"></i> Bonjour <?php echo Auth::user()->first_name; ?>! <small>Dernières activités sur Tech Portail</small></h1></div>
                </div>
            </div>
            
            <div class="row">
            
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <?php if (count($current_events) > 0) : ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-calendar fa-fw"></i> Évènements en ce moment</h3>
                        </div>
                        <div class="list-group">
                            <?php foreach ($current_events as $e) : ?>
                            <a href="<?php echo route('portal.events.upcoming', array($e->id, 'page' => Input::get('page'))); ?>" class="list-group-item<?php echo ($e->id == @$event->id) ? ' list-group-item-warning' : ''; ?>">
                                <p class="list-group-item-subtitle small"><?php echo ($e->datetime_start == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($e->datetime_start))).', de '.mb_strtolower(strftime('%kh%M', strtotime($e->datetime_start))).' à '.mb_strtolower(strftime('%kh%M', strtotime($e->datetime_end))); ?></p>
                                <p class="list-group-item-heading"><strong><?php echo strip_tags($e->title); ?></strong></p>
                                <p class="list-group-item-text small"><?php echo T4KHelpers::trunc_string(strip_tags($e->content), 100); ?></p>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-calendar fa-fw"></i> Évènements à venir</h3>
                        </div>
                        <div class="list-group">
                            <?php if (count($upcoming_events) > 0) : ?>
                                <?php foreach ($upcoming_events as $e) : ?>
                                <a href="<?php echo route('portal.events.upcoming', array($e->id, 'page' => Input::get('page'))); ?>" class="list-group-item<?php echo ($e->id == @$event->id) ? ' list-group-item-warning' : ''; ?>">
                                    <p class="list-group-item-subtitle small"><?php echo ($e->datetime_start == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($e->datetime_start))).', de '.mb_strtolower(strftime('%kh%M', strtotime($e->datetime_start))).' à '.mb_strtolower(strftime('%kh%M', strtotime($e->datetime_end))); ?></p>
                                    <p class="list-group-item-heading"><strong><?php echo strip_tags($e->title); ?></strong></p>
                                    <p class="list-group-item-text small"><?php echo T4KHelpers::trunc_string(strip_tags($e->content), 100); ?></p>
                                </a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="panel-body">
                                    <div class="alert alert-warning text-center">Aucun événement à venir.</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="panel-footer text-center">
                            <a href="<?php echo route('portal.events.index'); ?>" class="btn btn-default">Voir tous les évènements <i class="fa fa-chevron-circle-right fa-fw"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Dernières nouvelles</h3>
                        </div>
                        <div class="list-group">
                            <?php foreach ($articles as $a) : ?>
                            <a href="<?php echo route('portal.nouvelles.view', array($a->id, 'page' => Input::get('page'))); ?>" class="list-group-item<?php echo (@$article->id == $a->id) ? ' list-group-item-warning' : ''; ?>">
                                <small><small><p class="list-group-item-text"><?php echo ($a->datetime == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($a->datetime))); ?></p></small></small>
                                <p class="list-group-item-heading"><strong><?php echo strip_tags($a->title); ?></strong></p>
                                <small><p class="list-group-item-text"><?php echo T4KHelpers::trunc_string(strip_tags($a->content), 100); ?></p></small>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="panel-footer text-center">
                            <a href="<?php echo route('portal.nouvelles.index'); ?>" class="btn btn-default">Voir toutes les nouvelles <i class="fa fa-chevron-circle-right fa-fw"></i></a>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="row hidden-xs">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1><i class="fa fa-th fa-fw"></i> Applications T4K <small>Toutes les applications de travail pour élèves et mentors</small></h1>
                    </div>
                </div>
            </div>
            <div class="row hidden-xs">
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="/" class="btn"><i class="fa fa-cube fa-fw fa-3x"></i><br />Tech Portail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="/" class="btn disabled"><i class="fa fa-briefcase fa-fw fa-3x"></i><br />Tech Projets</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="/" class="btn disabled"><i class="fa fa-car fa-fw fa-3x"></i><br />Tech Parts</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="/" class="btn disabled"><i class="fa fa-bug fa-fw fa-3x"></i><br />Tech Incidents</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="http://wiki.team3990.com" target="_blank" class="btn"><i class="fa fa-book fa-fw fa-3x"></i><br />Tech Wiki</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="http://academy.team3990.com" target="_blank" class="btn"><i class="fa fa-graduation-cap fa-fw fa-3x"></i><br />Tech Academy</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="http://courriel.team3990.com" target="_blank" class="btn"><i class="fa fa-envelope fa-fw fa-3x"></i><br />Tech Courriel</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="https://my.usfirst.org/frc/tims/site.lasso" target="_blank" class="btn"><i class="fa fa-globe fa-fw fa-3x"></i><br />TIMS</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="https://my.usfirst.org/stims/" target="_blank" class="btn"><i class="fa fa-globe fa-fw fa-3x"></i><br />STIMS</a>
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
        @stop
        
    @stop
