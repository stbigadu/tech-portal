@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Documents
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
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1><i class="fa fa-file fa-fw"></i> Documents <small>Tous les documents</small></h1>
                    </div>
                </div>
            </div>
            
            <?php /* ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
                        <div class="btn-group">
                            <a href="#" class="btn btn-default"><i class="fa fa-folder fa-fw"></i> Ajouter un dossier</a>
                        </div>
                        
                        <div class="btn-group">
                            <a href="#" class="btn btn-default"><i class="fa fa-file-o fa-fw"></i> Ajouter des fichiers</a>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
            <?php */ ?>
            
            <div class="row">
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active">
                            <a href="<?php echo route('portal.docs.index'); ?>"><i class="fa fa-file fa-fw"></i> Documents</a> 
                            <i class="fa fa-angle-right fa-fw"></i> 
                            <?php echo substr($path, strlen($base_dir)); ?>
                        </li>
                    </ol>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px" class="text-center"><i class="fa fa-square-o fa-fw"></i></th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th style="width: 100px">Taille</th>
                                <th style="width: 200px" class="text-center">Dernière modification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($current_dir)) : ?>
                                <tr>
                                    <td colspan="5" class="active" style="padding-left: 60px"><a href="<?php echo route('portal.docs.index', array('path' => $parent_dir)); ?>"><i class="fa fa-level-up fa-fw"></i> Retourner au dossier supérieur</a></td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach ($dirs as $dir) : ?>
                                <tr>
                                    <td class="text-center"></td>
                                    <td><i class="fa fa-folder fa-fw"></i> <a href="<?php echo route('portal.docs.index', array('path' => substr($dir, strlen($base_dir)))); ?>"><?php echo substr($dir, strlen($path)); ?></a></td>
                                    <td>Dossier</td>
                                    <td class="text-right"></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php foreach ($files as $file) : ?>
                                <tr>
                                    <td class="text-center"></td>
                                    <td><i class="fa fa-file-o fa-fw"></i> <a href="<?php echo url(substr($file, strlen(public_path()))); ?>"><?php echo substr($file, strlen($path)+1); ?></a></td>
                                    <td><?php echo finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file); ?></td>
                                    <td class="text-right"><?php echo number_format(round($fs->size($file)/pow(1024, 1)), 0, ',', ' '); ?> Ko</td>
                                    <td class="text-center"><?php echo strftime('%Y/%m/%d, à %H:%M:%S', $fs->lastModified($file)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
