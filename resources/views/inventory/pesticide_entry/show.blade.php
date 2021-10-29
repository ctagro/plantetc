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


@section('content')

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/entry_plant.png')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                  Excluir Entrada de defensivo no estoque
              </div>
          </div>
      </div>
  </div>
</div>
   


   <!-- Fim do Formulario de despesa_conta --> 
   <form action="{{ route('pesticide_entry.destroy',[ 'pesticide_entry' => $pesticide_entry->id ])}}" method="POST"  enctype="multipart/form-data">

    @method('DELETE')
  
         <div class="form-group">
         {!! csrf_field() !!}  


  <div class="form-group">

    <div class="container">

       

        <div class="row">
          <div class="bolder">Data:</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $pesticide_entry->date}}</div>
        </div>

        <div class="row">
          <div class="bolder">Defensivo:</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $pesticide_entry->pesticide->name}}</div>
        </div>

        <div class="row">
          <div class="bolder">Produto:</div>
        </div>
        <div class="row">
          <div class="form-control">{{ $pesticide_entry->provide->name}}</div>
        </div>

        <div class="row">
          <div class="bolder">Quantidade:</div>
        </div>
      <div class="row">
        <div class="form-control">{{number_format($pesticide_entry->quantity, 2 , ',', '.') }}</div>
      </div>

      <div class="row">
        <div class="bolder">Preço unitário:</div>
      </div>
      <div class="row">
        <div class="form-control">{{number_format($pesticide_entry->price_unit, 4 , ',', '.') }}</div>
      </div>
  
      <div class="row">
        <div class="bolder">Valor:</div>
      </div>
      <div class="row">
        <div class="form-control">{{number_format($pesticide_entry->amount, 2 , ',', '.') }}</div>
      </div>
        <div class="row">
          <div class="bolder">Quantidade por und cons:</div>
        </div>
      <div class="row">
        <div class="form-control">{{number_format($pesticide_entry->quantity_cons, 2 , ',', '.') }}</div>
      </div>
  
      <div class="row">
        <div class="bolder">Preço unitário de cons:</div>
      </div>
      <div class="row">
        <div class="form-control">{{number_format($pesticide_entry->price_unit_cons, 4 , ',', '.') }}</div>
      </div>
  
  
    
    <p></p>
  
             <div class="form-group">
                  <button type="submit" class="btn btn-outline-danger" >Confirma a exclusão dessa atividade</button>
                  <a href="{{ url('/pesticide_entry') }}" class="float-right" >Voltar </a> 
             </div>
         </div>
     </form>

</div>
</div>
<a href="#" id="ancora"></a>


@endsection

