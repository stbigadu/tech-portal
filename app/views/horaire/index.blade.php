@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Horaire
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
                        <h1><i class="fa fa-clock-o fa-fw"></i> Horaire <small>Heures d'ouverture de Tech Atelier (<em>Tech Workshop</em>)</small></h1>
                    </div>
                </div>
            </div>
            
            <?php if (count($current_events) > 0) : ?>
            <div class="row">
                <div class="col-lg-12">
                    <p class="lead">Évènements en cours</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Évènement</th>
                                <th class="text-center" style="width: 200px">Heures d'ouverture</th>
                                <th class="text-center" style="width: 300px">Mentor(s) présent(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($upcoming_events as $event) : ?>
                            <tr>
                                <td style="width: 50px"><i class="fa fa-calendar fa-fw fa-2x text-muted" style="margin-top: 5px"></i></td>
                                <td>
                                    <span class="small text-muted"><?php echo ($event->datetime_start == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($event->datetime_start))).', de '.mb_strtolower(strftime('%kh%M', strtotime($event->datetime_start))).' à '.mb_strtolower(strftime('%kh%M', strtotime($event->datetime_end))); ?></span><br />
                                    <strong><a href="<?php echo route('portal.events.past', array($event->id)); ?>"><?php echo strip_tags($event->title); ?></a></strong>
                                </td>
                                <td>
                                    <?php 
                                    $openingHour = $event->datetime_start;
                                    $closingHour = $event->datetime_end;
                                    foreach ($event->attendances as $attendance) 
                                    {
                                        if ($attendance->user->is_mentor && $attendance->is_attending)
                                        {
                                            if ($attendance->datetime_start < $openingHour)     $openingHour = $attendance->datetime_start;
                                            if ($attendance->datetime_end > $closingHour)       $closingHour = $attendance->datetime_end;
                                        }
                                    }
                                    ?>
                                    <div class="clock">
                                        <?php echo strftime('%k:%M', strtotime($openingHour)); ?>
                                        <i class="fa fa-caret-right fa-fw"></i>
                                        <?php echo strftime('%k:%M', strtotime($closingHour)); ?>
                                    </div>
                                </td>
                                <td>
                                    <?php foreach ($event->attendances as $attendance) : ?>
                                    <?php if ($attendance->user->is_mentor && $attendance->is_attending) : ?>
                                    <div class="row small text-muted">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                            <?php echo $attendance->user->full_name; ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="clock clock-small">
                                                <?php echo strftime('%k:%M', strtotime($attendance->datetime_start)); ?>
                                                <i class="fa fa-caret-right fa-fw"></i>
                                                <?php echo strftime('%k:%M', strtotime($attendance->datetime_end)); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (count($upcoming_events) > 0) : ?>
            <div class="row">
                <div class="col-lg-12">
                    <p class="lead">Évènements à venir</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Évènement</th>
                                <th class="text-center" style="width: 200px">Heures d'ouverture</th>
                                <th class="text-center" style="width: 300px">Mentor(s) présent(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($upcoming_events as $event) : ?>
                            <tr>
                                <td style="width: 50px"><i class="fa fa-calendar fa-fw fa-2x text-muted" style="margin-top: 5px"></i></td>
                                <td>
                                    <span class="small text-muted"><?php echo ($event->datetime_start == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($event->datetime_start))).', de '.mb_strtolower(strftime('%kh%M', strtotime($event->datetime_start))).' à '.mb_strtolower(strftime('%kh%M', strtotime($event->datetime_end))); ?></span><br />
                                    <strong><a href="<?php echo route('portal.events.past', array($event->id)); ?>"><?php echo strip_tags($event->title); ?></a></strong>
                                </td>
                                <td>
                                    <?php 
                                    $openingHour = $event->datetime_start;
                                    $closingHour = $event->datetime_end;
                                    foreach ($event->attendances as $attendance) 
                                    {
                                        if ($attendance->user->is_mentor && $attendance->is_attending)
                                        {
                                            if ($attendance->datetime_start < $openingHour)     $openingHour = $attendance->datetime_start;
                                            if ($attendance->datetime_end > $closingHour)       $closingHour = $attendance->datetime_end;
                                        }
                                    }
                                    ?>
                                    <div class="clock">
                                        <?php echo strftime('%k:%M', strtotime($openingHour)); ?>
                                        <i class="fa fa-caret-right fa-fw"></i>
                                        <?php echo strftime('%k:%M', strtotime($closingHour)); ?>
                                    </div>
                                </td>
                                <td>
                                    <?php foreach ($event->attendances as $attendance) : ?>
                                    <?php if ($attendance->user->is_mentor && $attendance->is_attending) : ?>
                                    <div class="row small text-muted">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                            <?php echo $attendance->user->full_name; ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="clock clock-small">
                                                <?php echo strftime('%k:%M', strtotime($attendance->datetime_start)); ?>
                                                <i class="fa fa-caret-right fa-fw"></i>
                                                <?php echo strftime('%k:%M', strtotime($attendance->datetime_end)); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (count($past_events) > 0) : ?>
            <div class="row">
                <div class="col-lg-12">
                    <p class="lead">Évènements antérieurs</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group pull-right">
                            <button class="btn btn-noborder disabled">
                                <?php echo $ItemsCount; ?> évènement(s) au total.
                                <i class="fa fa-files-o fa-fw"></i> Page(s) : 
                            </button>
                            <?php echo $past_events->links(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Évènement</th>
                                <th class="text-center" style="width: 200px">Heures d'ouverture</th>
                                <th class="text-center" style="width: 300px">Mentor(s) présent(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($past_events as $event) : ?>
                            <tr>
                                <td style="width: 50px"><i class="fa fa-calendar fa-fw fa-2x text-muted" style="margin-top: 5px"></i></td>
                                <td>
                                    <span class="small text-muted"><?php echo ($event->datetime_start == NULL) ? 'Aucune date.' : 'Le '.mb_strtolower(strftime('%A %e %B %Y', strtotime($event->datetime_start))).', de '.mb_strtolower(strftime('%kh%M', strtotime($event->datetime_start))).' à '.mb_strtolower(strftime('%kh%M', strtotime($event->datetime_end))); ?></span><br />
                                    <strong><a href="<?php echo route('portal.events.past', array($event->id)); ?>"><?php echo strip_tags($event->title); ?></a></strong>
                                </td>
                                <td>
                                    <?php 
                                    $openingHour = $event->datetime_start;
                                    $closingHour = $event->datetime_end;
                                    foreach ($event->attendances as $attendance) 
                                    {
                                        if ($attendance->user->is_mentor && $attendance->is_attending)
                                        {
                                            if ($attendance->datetime_start < $openingHour)     $openingHour = $attendance->datetime_start;
                                            if ($attendance->datetime_end > $closingHour)       $closingHour = $attendance->datetime_end;
                                        }
                                    }
                                    ?>
                                    <div class="clock">
                                        <?php echo strftime('%k:%M', strtotime($openingHour)); ?>
                                        <i class="fa fa-caret-right fa-fw"></i>
                                        <?php echo strftime('%k:%M', strtotime($closingHour)); ?>
                                    </div>
                                </td>
                                <td>
                                    <?php foreach ($event->attendances as $attendance) : ?>
                                    <?php if ($attendance->user->is_mentor && $attendance->is_attending) : ?>
                                    <div class="row small text-muted">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                            <?php echo $attendance->user->full_name; ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <div class="clock clock-small">
                                                <?php echo strftime('%k:%M', strtotime($attendance->datetime_start)); ?>
                                                <i class="fa fa-caret-right fa-fw"></i>
                                                <?php echo strftime('%k:%M', strtotime($attendance->datetime_end)); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
