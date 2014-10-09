@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Calendrier
        @stop
        
        @section('stylesheets')
            @parent
            <!-- Bootstrap Datetime Picker -->
            {{ HTML::style('/assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css'); }}
        @stop
        
        @section('scripts_header')
            @parent
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
                        <h1><i class="fa fa-calendar fa-fw"></i> Calendrier <small>Tous les évènements</small></h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <?php if (Auth::user()->is_mentor) : ?>
                        <div class="btn-group">
                            <a href="<?php echo route('portal.events.create', array('page' => Input::get('page'))); ?>" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> Ajouter un évènement</a>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($event != NULL && Auth::user()->is_mentor) : ?>
                        <div class="btn-group">
                            <a href="<?php echo route('portal.events.edit', array($event->id, 'page' => Input::get('page'), 'view' => $currentRoute)); ?>" class="btn btn-default"><i class="fa fa-pencil fa-fw"></i> Modifier l'évènement</a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-default" data-toggle="modal" data-target="#modal-destroy-<?php echo $event->id; ?>"><i class="fa fa-trash-o fa-fw"></i> Supprimer l'évènement</button>
                        </div>
                        <div class="modal fade" id="modal-destroy-<?php echo $event->id; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Supprimer un évènement</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <i class="fa fa-calendar fa-fw fa-3x pull-left"></i>
                                                <div style="margin-left: 70px">
                                                    <h4 style="margin-top: 0"><?php echo strip_tags($event->title); ?></h4>
                                                    Débute le <strong><?php echo mb_strtolower(strftime('%A %e %B %Y, à %H h %M', strtotime($event->datetime_start))); ?></strong><br />
                                                    Se termine le <strong><?php echo mb_strtolower(strftime('%A %e %B %Y, à %H h %M', strtotime($event->datetime_end))); ?></strong><br />
                                                    Par <?php echo $event->user->full_name; ?> (<i class="fa fa-envelope-o fa-fw"></i> <?php echo HTML::mailto($event->user->email); ?>)
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-danger text-center"><strong>Êtes-vous sûr de vouloir supprimer cet évènement?</strong></div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo route('portal.events.destroy', $event->id); ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($currentRoute == 'portal.events.past') : ?>
                        <div class="btn-group pull-right">
                            <button class="btn btn-noborder disabled">
                                <?php /* ?><?php echo $ItemsCount; ?> évènement(s) au total. <?php */ ?>
                                <i class="fa fa-files-o fa-fw"></i> Page(s) : 
                            </button>
                            <?php echo $past_events->links(); ?>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12<?php echo (isset($event)) ? ' hidden-xs' : ''; ?>">
                
                    {{-- Current events ************************************************************************************************************** --}}
                    <?php if (isset($current_events) && count($current_events) > 0) : ?>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a>En ce moment</a></li>
                    </ul>
                    <div class="panel panel-default panel-tabs">
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
                
                    <ul class="nav nav-tabs" role="tablist">
                        <li<?php echo ($currentRoute == 'portal.events.upcoming' || $currentRoute == 'portal.events.index') ? ' class="active"' : ''; ?>><a href="<?php echo route('portal.events.upcoming'); ?>">À venir</a></li>
                        <li<?php echo ($currentRoute == 'portal.events.past') ? ' class="active"' : ''; ?>><a href="<?php echo route('portal.events.past'); ?>">Passés</a></li>
                    </ul>
                    
                    {{-- Past events ***************************************************************************************************************** --}}
                    <?php if ($currentRoute == 'portal.events.past') : ?>
                    <div class="panel panel-default panel-tabs">
                        <div class="list-group">
                            <?php if (count($past_events) > 0) : ?>
                                <?php foreach ($past_events as $e) : ?>
                                <a href="<?php echo route('portal.events.past', array($e->id, 'page' => Input::get('page'))); ?>" class="list-group-item<?php echo ($e->id == @$event->id) ? ' list-group-item-warning' : ''; ?>">
                                    <p class="list-group-item-subtitle small"><?php echo ($e->datetime_start == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($e->datetime_start))).', de '.mb_strtolower(strftime('%kh%M', strtotime($e->datetime_start))).' à '.mb_strtolower(strftime('%kh%M', strtotime($e->datetime_end))); ?></p>
                                    <p class="list-group-item-heading"><strong><?php echo strip_tags($e->title); ?></strong></p>
                                    <p class="list-group-item-text small"><?php echo T4KHelpers::trunc_string(strip_tags($e->content), 100); ?></p>
                                </a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="panel-body">
                                    <div class="alert alert-warning text-center">Aucun événement antérieur.</div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    {{-- Current and upcoming events ************************************************************************************************* --}}
                    <?php else : ?>
                    <div class="panel panel-default panel-tabs">
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
                    </div>
                    
                    <?php endif; ?>
                                            
                </div>
                
                <?php if (!isset($event)) : ?>
                <div class="col-lg-8 col-md-8 col-sm-6 hidden-xs">
                
                    {{-- Event Status Messages ******************************************************************************************************* --}}
                    <?php if (Session::has('destroy') && Session::get('destroy') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Évènement supprimé</h4> L'évènement &laquo; <strong><?php echo strip_tags(Session::get('object_name')); ?></strong> &raquo; a été supprimé avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="alert alert-warning text-center">Veuillez choisir un évènement.</div>
                </div>
                <?php else : ?>
                
                    <?php if (isset($event)) : ?>
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                        
                        <div class="row">
                            <div class="col-lg-12">
                    
                                {{-- Event Status Messages ******************************************************************************************* --}}
                                <?php if (Session::has('store') && Session::get('store') == true) : ?>
                                    <div class="alert alert-success alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                                        <div style="margin-left: 70px">
                                            <h4>Évènement créé</h4> L'évènement &laquo; <strong><?php echo strip_tags($event->title); ?></strong> &raquo; a été créé avec succès.
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (Session::has('update') && Session::get('update') == true) : ?>
                                    <div class="alert alert-success alert-dismissable fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                                        <div style="margin-left: 70px">
                                            <h4>Évènement modifié</h4> L'évènement &laquo; <strong><?php echo strip_tags($event->title); ?></strong> &raquo; a été modifié avec succès.
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                {{-- Attendance status *********************************************************************************************** --}}                                
                                <?php if ($event->is_user_attending == true) : ?>
                                
                                    <?php echo Form::open(array('route' => 'portal.events.confirm')); ?>
                                    <?php echo Form::hidden('id', $event->id); ?>
                                    <?php echo Form::hidden('attending', 0); ?>
                                    <?php echo Form::hidden('view', $currentRoute); ?>
                                    <?php echo Form::hidden('page', Input::get('page')); ?>
                                    <div class="alert alert-success">
                                        <i class="fa fa-check-circle fa-fw"></i> 
                                        <strong>Présence confirmée</strong> 
                                        Merci de participer à l'évènement! 
                                        <button type="submit" class="btn btn-danger btn-xs pull-right"><i class="fa fa-times-circle fa-fw"></i> Finalement, je serai absent(e)</button>
                                    </div>
                                    <?php echo Form::close(); ?>
                                
                                <?php elseif ($event->is_user_attending === null) : ?>
                                
                                    <div class="alert alert-warning">
                                        <i class="fa fa-question-circle fa-fw fa-3x pull-left"></i>
                                        <div style="margin-left: 75px">
                                            <h3 style="margin: 0">Confirmez votre présence</h3>
                                            <p>Serez-vous présent à l'évènement?</p>
                                            
                                            <?php echo Form::open(array('route' => 'portal.events.confirm')); ?>
                                            <?php echo Form::hidden('id', $event->id); ?>
                                            <?php echo Form::hidden('date_event', str_limit($event->datetime_start, 10, '')); ?>
                                            <?php echo Form::hidden('attending', 1); ?>
                                            <?php echo Form::hidden('view', $currentRoute); ?>
                                            <?php echo Form::hidden('page', Input::get('page')); ?>
                                            <div class="row">
                                                <div class="col-lg-4"><p><button type="submit" class="btn btn-success"><i class="fa fa-check-circle fa-fw"></i> Oui, je serai présent(e)</button></p></div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">De :</span>
                                                        <input class="form-control date text-center" id="time_start" name="time_start" type="text" value="<?php echo strftime('%k:%M', strtotime($event->datetime_start)); ?>" />
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">À :</span>
                                                        <input class="form-control date text-center" id="time_end" name="time_end" type="text" value="<?php echo strftime('%k:%M', strtotime($event->datetime_end)); ?>" />
                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo Form::close(); ?>
                                            
                                            <?php echo Form::open(array('route' => 'portal.events.confirm')); ?>
                                            <?php echo Form::hidden('id', $event->id); ?>
                                            <?php echo Form::hidden('attending', 0); ?>
                                            <?php echo Form::hidden('view', $currentRoute); ?>
                                            <?php echo Form::hidden('page', Input::get('page')); ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle fa-fw"></i> Non, je serai absent(e)</button>
                                                </div>
                                            </div>
                                            <?php echo Form::close(); ?>
    
                                        </div>
                                    </div>
                                    
                                <?php else : ?>
                                
                                    <?php echo Form::open(array('route' => 'portal.events.confirm')); ?>
                                    <?php echo Form::hidden('id', $event->id); ?>
                                    <?php echo Form::hidden('date_event', str_limit($event->datetime_start, 10, '')); ?>
                                    <?php echo Form::hidden('attending', 1); ?>
                                    <?php echo Form::hidden('view', $currentRoute); ?>
                                    <?php echo Form::hidden('page', Input::get('page')); ?>
                                    <div class="alert alert-danger">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p><i class="fa fa-times-circle fa-fw"></i> <strong>Absence confirmée</strong> Nous sommes tristes. Revenez!</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 text-right"><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check-circle fa-fw"></i> Finalement, je serai présent(e)</button></div>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">De :</span>
                                                    <?php echo Form::text('time_start', strftime('%k:%M', strtotime($event->datetime_start)), array('class' => 'form-control date text-center input-sm', 'id' => 'time_start')); ?>
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">À :</span>
                                                    <input class="form-control date text-center input-sm" id="time_end" name="time_end" type="text" value="<?php echo strftime('%k:%M', strtotime($event->datetime_end)); ?>" />
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo Form::close(); ?>
                                
                                <?php endif; ?>
                                
                                {{-- Event details *************************************************************************************************** --}}
                                <div class="panel panel-default">
                                    <div class="panel-heading text-muted small">
                                        <dl class="dl-horizontal">
                                            
                                            <dt>Début</dt>
                                            <dd><i class="fa fa-clock-o fa-fw"></i> <?php echo ($event->datetime_start == NULL) ? 'Aucune date.' : 'le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($event->datetime_start))).', à '.mb_strtolower(strftime('%kh%M', strtotime($event->datetime_start))); ?></dd>
                                            
                                            <dt>Fin</dt>
                                            <dd><i class="fa fa-clock-o fa-fw"></i> <?php echo ($event->datetime_start == NULL) ? 'Aucune date.' : 'le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($event->datetime_end))).', à '.mb_strtolower(strftime('%kh%M', strtotime($event->datetime_end))); ?></dd>
                                            
                                            <dt>Créé par</dt>
                                            <dd><i class="fa fa-user fa-fw"></i> <?php echo $event->user->full_name; ?></dd>
                                            
                                        </dl>
                                    </div>
                                    <div class="panel-body">
                                        
                                        <h1 style="margin-top: 0; padding-top: 0"><?php echo $event->title; ?></h1>
                                        
                                        <?php echo $event->content; ?>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="row">
                        
                            {{-- Attendance status *************************************************************************************************** --}}
                            <div class="col-lg-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-check-circle fa-fw"></i> Personnes présentes</h3>
                                    </div>
                                    <table class="table small table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th class="text-center">Début</th>
                                                <th class="text-center">Fin</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; ?>
                                            <?php foreach ($event->attendances as $attendance) : ?>
                                            <?php if ($attendance->is_attending == true) : ?>
                                            <tr>
                                                <td><?php echo $attendance->user->full_name; ?></td>
                                                <td class="text-center"><?php echo ($attendance->datetime_start == NULL) ? 'Aucune date.' : mb_strtolower(strftime('%kh%M', strtotime($attendance->datetime_start))); ?></td>
                                                <td class="text-center"><?php echo ($attendance->datetime_start == NULL) ? 'Aucune date.' : mb_strtolower(strftime('%kh%M', strtotime($attendance->datetime_end))); ?></td>
                                            </tr>
                                            <?php $count++; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center active" colspan="3"><?php echo $count; ?> présent(e)s</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                            {{-- Attendance status *************************************************************************************************** --}}
                            <div class="col-lg-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-times-circle fa-fw"></i> Personnes absentes</h3>
                                    </div>
                                    <table class="table small table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; ?>
                                            <?php foreach ($event->attendances as $attendance) : ?>
                                            <?php if ($attendance->is_attending == false) : ?>
                                            <tr>
                                                <td><?php echo $attendance->user->full_name; ?></td>
                                            </tr>
                                            <?php $count++; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center active" colspan="2"><?php echo $count; ?> absent(e)s</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                                            
                    </div>
                    <?php endif; ?>
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
            
            <?php if (isset($event)) : ?>
            <script type="text/javascript">
            
            // Datetime Picker
            var datetimepickerParam = {
                    language: 'fr',
                    autoclose: true,
                    format: 'hh:ii',
                    startView: 1,
                    minView: 0,
                    maxView: 1,
                    minuteStep: 15,
                    startDate: '<?php echo str_limit($event->datetime_start, 10, ''); ?> 00:00:00',
                    endDate: '<?php echo str_limit($event->datetime_end, 10, ''); ?> 23:59:59' 
            };
            
            $('#time_start').datetimepicker(datetimepickerParam);
            $('#time_end').datetimepicker(datetimepickerParam);
            
            </script>
            <?php endif; ?>
            
        @stop
        
    @stop
