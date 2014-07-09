@extends('layout.master') 

    {{-- HTML Header Section --}}
    @section('title')
        Connexion
    @stop
    
    @section('stylesheets')
       @parent
    @stop
    
    @section('scripts_header')
       @parent
    @stop

    {{-- HTML Body Section --}}
    @section('body')
    
        @parent
        
        
        
    @stop
    
    @section('scripts_eof')
        @parent
    @stop
