@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Administration / Utilisateurs
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
                        <h1><i class="fa fa-cog fa-fw"></i> Administration <small>Gestion des utilisateurs</small></h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <div class="btn-group">
                            <a href="<?php echo route('portal.admin.users.create'); ?>" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> Ajouter un utilisateur</a>
                        </div>
                        
                    </div>
                    
                    <?php if (Session::has('store') && Session::get('store') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Utilisateur créé</h4> L'utilisateur &laquo; <strong><?php echo strip_tags(Session::get('object_name')); ?></strong> &raquo; a été créé avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (Session::has('update') && Session::get('update') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Utilisateur modifié</h4> L'utilisateur &laquo; <strong><?php echo strip_tags(Session::get('object_name')); ?></strong> &raquo; a été modifié avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (Session::has('destroy') && Session::get('destroy') == true) : ?>
                        <div class="alert alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-check-circle fa-fw fa-3x pull-left"></i>
                            <div style="margin-left: 70px">
                                <h4>Utilisateur supprimé</h4> L'utilisateur &laquo; <strong><?php echo strip_tags(Session::get('object_name')); ?></strong> &raquo; a été supprimé avec succès.
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Courriel</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $user->last_name; ?></td>
                                <td><?php echo $user->first_name; ?></td>
                                <td><?php echo ($user->email != NULL) ? '<i class="fa fa-envelope-o fa-fw"></i> '.HTML::mailto($user->email) : ''; ?></td>
                                <td><?php echo $user->role->title; ?></td>
                                <td>
                                    <a href="#" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                                    <button class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-destroy-<?php echo $user->id; ?>"><i class="fa fa-trash-o fa-fw"></i></button>
                                </td>
                            </tr>
                            
                            <div class="modal fade" id="modal-destroy-<?php echo $user->id; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Supprimer un utilisateur</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <i class="fa fa-user fa-fw fa-3x pull-left"></i>
                                                <div style="margin-left: 70px">
                                                    <h4 style="margin-top: 0"><?php echo strip_tags($user->full_name); ?></h4>
                                                    <i class="fa fa-envelope-o fa-fw"></i> <?php echo $user->email; ?><br />
                                                    <i class="fa fa-tag fa-fw"></i> <?php echo $user->role->title; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-danger text-center"><strong>Êtes-vous sûr de vouloir supprimer cet utilisateur?</strong></div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="<?php echo route('portal.admin.users.destroy', $user->id); ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i> Supprimer</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle fa-fw"></i> Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
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
        @stop
        
    @stop
