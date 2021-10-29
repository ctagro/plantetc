<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insumo</title>
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
                Confirmar exclusão do fertilizante
              </div>
          </div>
      </div>
  </div>
</div>   

   
<form action="{{ route('product.destroy',[ 'product' => $product->id ])}}" method="POST"  enctype="multipart/form-data">

    @method('DELETE')
  
  <div class="form-group">
         {!! csrf_field() !!}  

    <div class="form-group">

      <div class="container">

            <div class="row">
              <div class="bolder">Nome:</div>
            </div>
            <div class="row">
              <div class="form-control">{{ $product->name}}</div>
            </div>
            <div class="row">
              <div class="bolder">Descrição:</div>
            </div>
            <div class="row">
              <div class="form-control">{{ $product->description}}</div>
            </div>
            <div class="row">
              <div class="form-group col-sm-4 ">
                <div class="row">
                  <div class="bolder">Embalagem:</div>
                </div>
                <div class="row">
                  <div class="form-control">{{ $product->packing}}</div>
                </div> 
                <div class="row">
                  <div class="bolder">Unidade:</div>        
                </div>
                <div class="row">  
                  <div class="form-control">{{ $product->unity}}</div>
                </div> 
                <div class="row">
                  <div class="bolder">Preço:</div>
                </div>       
                <div class="row">
                  <div class="form-control">{{number_format($product->price, 2 , ',', '.') }}</div>
                </div>
                <div class="row">
                  <div class="bolder">Preço por unidade:</div>
                </div>
                <div class="row">
                  <div class="form-control">{{number_format($product->price_unit, 4 , ',', '.') }}</div>
                </div> 
              </div>
              <div class="form-group col-sm-2 ">          
                <p></p>          
              </div>
              <div class="form-group col-sm-6 ">
                <br>          
                <img src="{{ asset('storage/products/'.$product->image)}}" class="img-thumbnail elevation-2"  style="max-width: 300px;">         
              </div>
            </div>
      </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline-danger" >Confirma a exclusão do funcionário</button>
              <a href="{{ url('/product') }}" class="float-right" >Voltar </a> 
            </div>
          </div>
      </form>
      
    </div>
  </div>
     
  <a href="#" id="ancora"></a>

@endsection

