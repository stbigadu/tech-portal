@extends('layout.master') 

    @section('head')
        
        @parent
        
        {{-- HTML Header Section --}}
        @section('title')
            Équipe
        @stop
        
        @section('stylesheets')
            @parent
            <style type="text/css">
                body {
                    padding: 10px;
                }
            </style>
        @stop
        
        @section('scripts_header')
            @parent
        @stop
        
    @stop

    {{-- HTML Body Section --}}
    @section('body')
        
        <div class="row">
            <div class="col-lg-12">
                <p class="lead">Élèves</p>
                <table class="table table-condensed table-bordered small">
                    <thead>
                        <tr>
                            <th style="width: 200px">Nom</th>
                            <th style="width: 200px">Prénom</th>
                            <th style="width: 300px">Courriel</th>
                            <th style="width: 100px" class="text-center">Groupe</th>
                            <th></th>
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
                            <td></td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="lead">Mentors et apprentis mentors</p>
                <table class="table table-condensed table-bordered small">
                    <thead>
                        <tr>
                            <th style="width: 200px">Nom</th>
                            <th style="width: 200px">Prénom</th>
                            <th style="width: 300px">Courriel</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                        <?php if ($user->is_mentor || $user->is_junior_mentor) : ?>
                        <tr>
                            <td><?php echo $user->last_name; ?></td>
                            <td><?php echo $user->first_name; ?></td>
                            <td><?php echo ($user->email != NULL) ? '<i class="fa fa-envelope-o fa-fw"></i> '.HTML::mailto($user->email) : ''; ?></td>
                            <td></td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    @stop
    
    @section('footer')
        
        @parent 
        
        @section('footer-content')
        @stop
    
        @section('scripts_eof')
            @parent
        @stop
        
    @stop
