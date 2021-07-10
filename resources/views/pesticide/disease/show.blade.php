<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Praga / Doença</title>
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

@section('title', 'Editar')

    @extends('adminlte::page')

@section('content')
   
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/ground_plant.png')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                Confirmar exclusão
              </div>
          </div>
      </div>
  </div>
</div>   

   
<form action="{{ route('disease.destroy',[ 'disease' => $disease->id ])}}" method="POST"  enctype="multipart/form-data">

    @method('DELETE')
  
  <div class="form-group">
         {!! csrf_field() !!}  

    <div class="form-group">

      <div class="container">

            <div class="row">
              <div class="bolder">Nome vulgar:</div>
            </div>
              <div class="form-control">{{ $disease->name_vulgar}}</div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6 ">
                <div class="row">
                  <div class="bolder">Nome científico:</div>
                </div>
                <div class="row">
                  <div class="form-control">{{ $disease->name_scientific}}</div>
                </div> 
                <div class="row">
                  <div class="bolder">Descrição:</div>        
                </div>
                <div class="row">  
                  <div class="form-control" readonly>{{ $disease->description}}</div>
                </div> 
                <div class="row">
                  <div class="bolder">Sintomas::</div>
                </div>       
                <div class="row">
                  <div class="form-control" readonly>{{$disease->symptoms}}</div>
                </div>
                <div class="row">
                  <div class="bolder" >Defencivos indicados:</div>
                </div>
                <div class="row">
                  <div class="form-control" readonly>{{$disease->indicated_pesticide}}</div>
                </div> 
                <div class="row">
                  <div class="bolder">Controles:</div>
                </div>
                <div class="row">
                  <div class="form-control" readonly>{{$disease->control}}</div>
                </div>
                <div class="row">
                  <div class="bolder">Observação:</div>
                </div>
                <div class="row">
                  <textarea class="form-control" readonly>{{ $disease->note}}</textarea>
                </div> 
              </div>
    
              <div class="form-group col-sm-2">          
                <p></p>          
              </div>
              <div class="form-group col-sm-4 ">
                <br>          
                <img src="{{ asset('storage/diseases/'.$disease->image)}}" class="img-thumbnail elevation-2"  alt='Imagem da praga / doença' style="max-width: 300px;">         
              </div>
            </div>
      </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline-danger" >Confirma a exclusão do funcionário</button>
              <a href="{{ url('/disease') }}" class="float-right" >Voltar </a> 
            </div>
          </div>
      </form>
      
    </div>
  </div>
     
  <a href="#" id="ancora"></a>

@endsection

