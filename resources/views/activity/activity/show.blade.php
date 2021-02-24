<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atividades</title>
     <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
    
</body>
</html>

@section('title', 'Apresentar')

    @extends('adminlte::page')

@section('content')

@extends('adminlte::page')

@section('title', 'Atividades')

@section('content_header')  
<div class="row">     
  
    <h1 class="ml-2  text-center">Excluir Atividade</h1>
</div>
@stop

@section('content')
   


   <!-- Fim do Formulario de despesa_conta --> 
   <form action="{{ route('activity.destroy',[ 'activity' => $activity->id ])}}" method="POST"  enctype="multipart/form-data">

    @method('DELETE')
  
         <div class="form-group">
         {!! csrf_field() !!}  


  <div class="form-group">

    <div class="container">

        <div class="row">
          <div class="bolder">Atividade:</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $activity->type_activity->description}}</div>
        </div>

        <div class="row">
          <div class="bolder">Data:</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $activity->date}}</div>
        </div>

        <div class="row">
          <div class="bolder">Área</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $activity->crop}}</div>
        </div>
        
        <div class="row">
          <div class="bolder">Funcionário</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $activity->worker_id}}</div>
        </div>

        <div class="row">
          <div class="bolder">Tempo de atividade</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $activity->worked_hours}}</div>
        </div>


        <div class="bg-light">Observação</div>
        <div class="row">
            <textarea class="form-control" rows="3" >{{$activity->note }} </textarea>
        </div>
        <br>

    
    <p></p>
  
             <div class="form-group">
                  <button type="submit" class="btn btn-outline-danger" >Confirma a exclusão dessa atividade</button>
                  <a href="{{ url('/activity') }}" class="float-right" >Voltar </a> 
             </div>
         </div>
     </form>

</div>
</div>
<a href="#" id="ancora"></a>


@endsection

