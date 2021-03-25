<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicação de Insumos</title>
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

@section('title', 'Listar')

    @extends('adminlte::page')

@section('content')

<div class='table-responsive'>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          
                <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header">
                                <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/product_apply_plant.png')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                                  Aplicação de Produtos
                                  <a class="float-right" href="{{url('product_apply/create')}}">Cadastrar</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
           
                @if(Session::has('mensagem_sucesso'))
                       <div class="alert alert-success"> {{ Session::get('mensagem_sucesso')}}</div>
                @endif

                <table id="example1" class="table table-sm table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                  <thead>
                      <tr>
                  
                          <th class="sorting_asc" tabindex="0" aria-controls="" rowspan="0" colspan="1"  aria-label="">Data</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Produto</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Funcionário</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Conta</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Área</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Qtde</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Pr Unit</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Custo</th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="display: none;">CSS grade</th>
                      </tr>
                  </thead>
                

                    <tbody>

                     
                    
                    @foreach($product_applys as $product_apply)
                     
                    <tr>
                      <td>  
                        <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id  ])}}" >{{ $product_apply->date }}</a>
                      </td>
                      <td>
                        <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ $product_apply->product->name}}</a>
                      </td>
                      <td>
                        <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ $product_apply->worker->name}}</a>
                      </td>
                      <td>  
                        <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ $product_apply->accounting->name}}</a>
                      </td>
                      <td>  
                        <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ $product_apply->ground->name}}</a>
                      </td>
                      <td>
                        <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ number_format($product_apply->amount, 2 , ',', '.')  }}</a>
                      </td>
                      <td>
                        <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ number_format($product_apply->product->price_unit, 2 , ',', '.')  }}</a>
                      </td>
                      <td>
                        <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ number_format($product_apply->account->amount, 2 , ',', '.')  }}</a>
                      </td>          
                    </tr>
                       
                      @endforeach
                    </tbody>
                  </table>                  
       
        </div>
    </div>
    <div class="card">
      <div class="card-header">
          <a href="{{ url('/home') }}" class="float-right" >Voltar </a> 
      </div>
    </div>
</div>

</div>
@endsection
