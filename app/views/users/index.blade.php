@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Équipe
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
                        <h1><i class="fa fa-bullhorn fa-fw"></i> Équipe <small>Tous les utilisateurs</small></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-toolbar" role="toolbar">
                    
                        <div class="btn-group">
                            <a href="#" onclick="popup('<?php echo route('portal.users.export'); ?>')" class="btn btn-default"><i class="fa fa-print fa-fw"></i> Imprimer la liste des membres de l'équipe</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#students" role="tab" data-toggle="tab">Élèves</a></li>
                        <li><a href="#mentors" role="tab" data-toggle="tab">Mentors & apprenti(e)s mentors</a></li>
                        <li><a href="#parents" role="tab" data-toggle="tab">Parents</a></li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="students">
                            <div class="panel panel-default panel-tabs">
                                <table class="table table-condensed table-hover small">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Courriel</th>
                                            <th class="text-center">Groupe</th>
                                            <th>Téléphone (maison #1)</th>
                                            <th>Téléphone (maison #2)</th>
                                            <th>Téléphone (mobile)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                        <?php if ($user->is_student) : ?>
                                        <tr>
                                            <td><?php echo $user->last_name; ?></td>
                                            <td><?php echo $user->first_name; ?></td>
                                            <td><?php echo ($user->email != NULL) ? '<i class="fa fa-envelope-o fa-fw"></i> '.HTML::mailto($user->email) : ''; ?></td>
                                            <td class="text-center"><?php echo $user->groupe; ?></td>
                                            <td><?php echo $user->home_number_1; ?></td>
                                            <td><?php echo $user->home_number_2; ?></td>
                                            <td><?php echo $user->cellphone_number; ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="mentors">
                            <div class="panel panel-default panel-tabs">
                                <table class="table table-condensed table-hover small">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Courriel</th>
                                            <th>Titre professionnel</th>
                                            <th>Téléphone (maison #1)</th>
                                            <th>Téléphone (maison #2)</th>
                                            <th>Téléphone (mobile)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                        <?php if ($user->is_mentor || $user->is_junior_mentor) : ?>
                                        <tr>
                                            <td><?php echo $user->last_name; ?></td>
                                            <td><?php echo $user->first_name; ?></td>
                                            <td><?php echo ($user->email != NULL) ? '<i class="fa fa-envelope-o fa-fw"></i> '.HTML::mailto($user->email) : ''; ?></td>
                                            <td><?php echo $user->professional_title; ?></td>
                                            <td><?php echo $user->home_number_1; ?></td>
                                            <td><?php echo $user->home_number_2; ?></td>
                                            <td><?php echo $user->cellphone_number; ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="parents">
                            <div class="panel panel-default panel-tabs">
                                <table class="table table-condensed table-hover small">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Courriel</th>
                                            <th class="text-center">Groupe</th>
                                            <th>Téléphone (maison #1)</th>
                                            <th>Téléphone (maison #2)</th>
                                            <th>Téléphone (mobile)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                        <?php if ($user->is_parent) : ?>
                                        <tr>
                                            <td><?php echo $user->last_name; ?></td>
                                            <td><?php echo $user->first_name; ?></td>
                                            <td><?php echo ($user->email != NULL) ? '<i class="fa fa-envelope-o fa-fw"></i> '.HTML::mailto($user->email) : ''; ?></td>
                                            <td class="text-center"><?php echo $user->groupe; ?></td>
                                            <td><?php echo $user->home_number_1; ?></td>
                                            <td><?php echo $user->home_number_2; ?></td>
                                            <td><?php echo $user->cellphone_number; ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
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
            <script language="javascript" type="text/javascript">
            function popup(url) {
            	newwindow=window.open(url,'','height=500,width=700,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes');
            	newwindow.focus()
            	return false;
            }
            </script>
        @stop
        
    @stop
