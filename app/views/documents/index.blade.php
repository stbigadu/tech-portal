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
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
                        
                        <div class="btn-group">
                            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#create-dir"><i class="fa fa-folder fa-fw"></i> Ajouter un dossier</a>
                        </div>
                        
                        <?php echo Form::open(array('route' => array('portal.docs.createdir', 'path' => Input::get('path')))); ?>
                        <div class="modal fade" id="create-dir" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-folder fa-fw"></i> Créer un nouveau dossier</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Veuillez indiquer un nom pour le nouveau dossier à créer dans le dossier actuel.</p>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-plus fa-fw"></i></span>
                                            <?php echo Form::text('create_dir', null, array('class' => 'form-control', 'id' => 'create_dir', 'placeholder' => 'Nom du nouveau dossier...')); ?>
                                        </div>
                                        &nbsp;
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-plus fa-fw"></i> Créer le nouveau dossier</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>
                        
                        <div class="btn-group">
                            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#add-files"><i class="fa fa-file-o fa-fw"></i> Ajouter des fichiers</a>
                        </div>
                        
                        <?php echo Form::open(array('route' => array('portal.docs.addfiles', 'path' => Input::get('path')), 'files' => true, 'id' => 'form-add-files')); ?>
                        <div class="modal fade" id="add-files" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-file-o fa-fw"></i> Ajouter des fichiers</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Sélectionnez les fichiers à ajouter au dossier actuel.</p>
                                        <div id="file-container">
                                            <?php echo Form::file('file[]', array('class' => '', 'style' => 'margin-bottom: 5px')); ?>
                                        </div>
                                        <div id="uploading" class="hide">
                                            &nbsp;
                                            <p>Téléchargement des fichiers en cours...</p>
                                            <div class="progress"><div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 100%"></div></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="submit-add-files" class="btn btn-warning"><i class="fa fa-plus fa-fw"></i> Ajouter les fichiers</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>
                        
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                
                    <ol class="breadcrumb">
                        <li class="active"><a href="<?php echo route('portal.docs.index'); ?>"><i class="fa fa-file fa-fw"></i> Documents</a></li>
                        <?php $breads = explode('/', substr($path, strlen($base_dir))); ?>
                        <?php foreach ($breads as $bread) : ?>
                            <li><?php echo $bread; ?></li>
                        <?php endforeach; ?>
                    </ol>
                
                    <?php if (Session::has('action') && Session::get('action') == 'create_dir') : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Dossier créé</h4> Le dossier <strong><?php echo Session::get('create_dir'); ?></strong> a été créé avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                
                    <?php if (Session::has('action') && Session::get('action') == 'rename_dir') : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Dossier renommé</h4> Le dossier <strong><?php echo Session::get('old_dir'); ?></strong> a été renommé avec succès pour <strong><?php echo Session::get('create_dir'); ?></strong>.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (Session::has('action') && Session::get('action') == 'delete_dir') : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Dossier supprimé</h4> Le dossier <strong><?php echo Session::get('delete_dir'); ?></strong> a été supprimé avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (Session::has('action') && Session::get('action') == 'add_files') : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Fichier(s) ajouté(s)</h4> <?php echo Session::get('count'); ?> fichier(s) a(ont) été ajouté(s) au dossier actuel avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (Session::has('action') && Session::get('action') == 'rename_file') : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Fichier renommé</h4> Le fichier <strong><?php echo Session::get('old_file'); ?></strong> a été renommé à <strong><?php echo Session::get('new_file'); ?></strong> avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (Session::has('action') && Session::get('action') == 'delete_file') : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Fichier supprimé</h4> Le fichier <strong><?php echo Session::get('delete_file'); ?></strong> a été supprimé avec succès.
                            </div>
                        </div>
                    <?php endif; ?>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px" class="text-center"><i class="fa fa-square-o fa-fw"></i></th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th style="width: 100px">Taille</th>
                                <th style="width: 200px" class="text-center">Dernière modification</th>
                                <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
                                <th style="width: 80px">Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($current_dir)) : ?>
                                <tr>
                                    <td colspan="<?php echo (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) ? 6 : 5; ?>" class="active" style="padding-left: 60px"><a href="<?php echo route('portal.docs.index', array('path' => $parent_dir)); ?>"><i class="fa fa-level-up fa-fw"></i> Retourner au dossier supérieur</a></td>
                                </tr>
                            <?php endif; ?>
                            <?php $i = 0; foreach ($dirs as $dir) : ?>
                                <tr>
                                    <td class="text-center"></td>
                                    <td><i class="fa fa-folder fa-fw"></i> <a href="<?php echo route('portal.docs.index', array('path' => substr($dir, strlen($base_dir)))); ?>"><?php echo substr($dir, strlen($path)); ?></a></td>
                                    <td>Dossier</td>
                                    <td class="text-right"></td>
                                    <td></td>
                                    <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
                                    <td>
                                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#rename-dir-<?php echo $i; ?>"><i class="fa fa-pencil fa-fw"></i></a> 
                                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete-dir-<?php echo $i; ?>"><i class="fa fa-trash-o fa-fw"></i></a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                
                                <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
                                <?php echo Form::open(array('route' => array('portal.docs.renamedir', 'path' => Input::get('path')))); ?>
                                <?php echo Form::hidden('old_dir', $dir); ?>
                                <div class="modal fade" id="rename-dir-<?php echo $i; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-folder fa-fw"></i> Renommer un dossier</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <i class="fa fa-folder fa-fw fa-3x pull-left"></i>
                                                        <div class="margin-left: 75px">
                                                            <?php echo substr($dir, strlen($path)); ?><br />
                                                            <span class="text-muted">Dossier</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>Indiquez un nouveau nom pour le dossier sélectionné.</p>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <?php echo Form::text('create_dir', substr($dir, strlen($path)), array('class' => 'form-control', 'id' => 'create_dir', 'placeholder' => 'Nouveau nom pour le dossier...')); ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-save fa-fw"></i> Renommer le dossier</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>
                                
                                <?php echo Form::open(array('route' => array('portal.docs.deletedir', 'path' => Input::get('path')))); ?>
                                <?php echo Form::hidden('delete_dir', $dir); ?>
                                <div class="modal fade" id="delete-dir-<?php echo $i; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                <h4 class="modal-title text-danger"><i class="fa fa-folder fa-fw"></i> Supprimer un dossier</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <i class="fa fa-folder fa-fw fa-3x pull-left"></i>
                                                        <div class="margin-left: 75px">
                                                            <?php echo substr($dir, strlen($path)); ?><br />
                                                            <span class="text-muted">Dossier</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle fa-fw fa-3x pull-left"></i>
                                                    <div style="margin-left: 75px">
                                                        <h3 style="margin-top: 0">Attention!</h3>
                                                        <p>Êtes-vous sûr de vouloir supprimer ce dossier? Ce dossier et tous les fichiers et dossiers qu'il contient seront définitivement supprimés et ne pourront être récupérés.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-save fa-fw"></i> Supprimer</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>
                                <?php endif; ?>
                                
                            <?php $i++; endforeach; ?>
                            <?php $i = 0; foreach ($files as $file) : ?>
                                <tr>
                                    <td class="text-center"></td>
                                    <td><i class="fa fa-file-o fa-fw"></i> <a href="<?php echo asset(mb_substr($file, strlen(public_path()))); ?>"><?php echo substr($file, strlen($path)+1); ?></a></td>
                                    <td><?php echo finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file); ?></td>
                                    <td class="text-right"><?php echo number_format(round($fs->size($file)/pow(1024, 1)), 0, ',', ' '); ?> Ko</td>
                                    <td class="text-center"><?php echo strftime('%Y/%m/%d, à %H:%M:%S', $fs->lastModified($file)); ?></td>
                                    <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
                                    <td>
                                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#rename-file-<?php echo $i; ?>"><i class="fa fa-pencil fa-fw"></i></a> 
                                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#delete-file-<?php echo $i; ?>"><i class="fa fa-trash-o fa-fw"></i></a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                                
                                <?php if (Auth::user()->is_mentor || Auth::user()->is_junior_mentor) : ?>
                                <?php echo Form::open(array('route' => array('portal.docs.renamefile', 'path' => Input::get('path')))); ?>
                                <?php echo Form::hidden('old_file', $file); ?>
                                <div class="modal fade" id="rename-file-<?php echo $i; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                <h4 class="modal-title"><i class="fa fa-file-o fa-fw"></i> Renommer un fichier</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <i class="fa fa-file-o fa-fw fa-3x pull-left"></i> <?php echo substr($file, strlen($path)+1); ?>
                                                        <div class="margin-left: 50px">
                                                            <span class="text-muted"><?php echo finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file); ?></span><br />
                                                            <span class="text-muted"><?php echo number_format(round($fs->size($file)/pow(1024, 1)), 0, ',', ' '); ?> Ko</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>Veuillez donner un nouveau nom au fichier sélectionné.<br />
                                                <span class="text-danger"><strong>Attention: faites attention à l'extension du fichier!</strong></span></p>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <?php echo Form::text('new_file', substr($file, strlen($path)+1), array('class' => 'form-control', 'id' => 'new_file', 'placeholder' => 'Nouveau nom pour le fichier...')); ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-save fa-fw"></i> Renommer le fichier</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>
                                
                                <?php echo Form::open(array('route' => array('portal.docs.deletefile', 'path' => Input::get('path')))); ?>
                                <?php echo Form::hidden('delete_file', $file); ?>
                                <div class="modal fade" id="delete-file-<?php echo $i; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                <h4 class="modal-title text-danger"><i class="fa fa-file-o fa-fw"></i> Supprimer un fichier</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <i class="fa fa-file-o fa-fw fa-3x pull-left"></i> <?php echo substr($file, strlen($path)+1); ?>
                                                        <div class="margin-left: 50px">
                                                            <span class="text-muted"><?php echo finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file); ?></span><br />
                                                            <span class="text-muted"><?php echo number_format(round($fs->size($file)/pow(1024, 1)), 0, ',', ' '); ?> Ko</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle fa-fw fa-3x pull-left"></i>
                                                    <div style="margin-left: 75px">
                                                        <h3 style="margin-top: 0">Attention!</h3>
                                                        <p>Êtes-vous sûr de vouloir supprimer ce fichier? Ce fichier définitivement supprimé et ne pourra plus être récupéré.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-save fa-fw"></i> Supprimer le fichier</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>
                                <?php endif; ?>
                                
                            <?php $i++; endforeach; ?>
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
            
            <script type="text/javascript">
            $('#submit-add-files').on('click', function() {
                $('#uploading').removeClass('hide').addClass('show');
                setTimeout(function() {
                	document.getElementById('form-add-files').submit();
                }, 25);
            });
            </script>
            
            <script type="text/javascript">
            $('input[type=file]').change(fileHandler);

            function fileHandler() {
                var form = $(this).closest('#file-container');
                $('<?php echo Form::file('file[]', array('class' => '', 'style' => 'margin-bottom: 5px')); ?>').change(fileHandler).appendTo(form);
            }
            </script>
            
        @stop
        
    @stop
