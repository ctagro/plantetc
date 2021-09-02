<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fluxo de Caixa</title>
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


@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/cashFlowing_plant.png')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                  Excluir Movimentação
              </div>
          </div>
      </div>
  </div>
</div>
   


   <!-- Fim do Formulario de despesa_conta --> 
   <form action="{{ route('cashFlow.destroy',[ 'cashFlow' => $cashFlow->id ])}}" method="POST"  enctype="multipart/form-data">

    @method('DELETE')
  
         <div class="form-group">
         {!! csrf_field() !!}  


  <div class="form-group">

    <div class="container">

       

        <div class="row">
          <div class="bolder">Data:</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $cashFlow->date}}</div>
        </div>

        <div class="row">
          <div class="bolder">Descrição:</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $cashFlow->description}}</div>
        </div>

        <div class="row">
          <div class="bolder">Área:</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $cashFlow->bank->name}}</div>
        </div>
        
        <div class="row">
          <div class="bg-light">Valor:</div>
      </div>
      <div class="row">
        <div class="form-control">{{number_format($cashFlow->amount, 2 , ',', '.') }}</div>
      </div>
    
    <p></p>
  
             <div class="form-group">
                  <button type="submit" class="btn btn-outline-danger" >Confirma a exclusão dessa atividade</button>
                  <a href="{{ url('/cashFlow') }}" class="float-right" >Voltar </a> 
             </div>
         </div>
     </form>

</div>
</div>
<a href="#" id="ancora"></a>


@endsection

