<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventário</title>
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

@extends('adminlte::page')

@section('title', 'Inventário')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/inventory_plant.png')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                     Consulta ao inventário de fertilizantes
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inicio da Tabela dos registros -->
<p></p>
<p class="font-weight-bold">----------------  Entradas   -------------------</p>
<p></p>

<div class='table-responsive'>

  <table id="example1" class="table table-sm table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
      <thead>
          <tr>
      
              <th class="sorting_asc" tabindex="0" aria-controls="" rowspan="0" colspan="1"  aria-label="">Data</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Produto</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Fornecedor</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Quantidade</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Preço Unitário</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Valor</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Qtd cons</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Preço cons</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="display: none;">CSS grade</th>
          </tr>
      </thead>
  
     <?php $total_qdt_cons = 0 ?>
      <tbody>
          @forelse($fertilizer_entrys as $fertilizer_entry)
                  <tr>
                      <td>
                         <a href= "{{ route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])}}" >{{ $fertilizer_entry->date }}</a>
                      </td>
                      <td>
                          <a href= "{{ route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])}}" >{{ $fertilizer_entry->product->name }}</a>
                      </td>
                      <td>
                          <a href= "{{ route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])}}" >{{ $fertilizer_entry->provide->name}}</a>
                      </td>
                      <td>
                          <a href= "{{ route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])}}" >{{ number_format($fertilizer_entry->quantity, 2 , ',', '.')  }}</a>
                      </td>
                      <td>
                          <a href= "{{ route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])}}" >{{ number_format($fertilizer_entry->price_unit, 2 , ',', '.')  }}</a>
                      </td>                                    
                      <td>
                          <a href= "{{ route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])}}" >{{ number_format($fertilizer_entry->amount, 2 , ',', '.')  }}</a>
                      </td>
                      <td>
                          <a href= "{{ route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])}}" >{{ number_format($fertilizer_entry->quantity_cons, 2 , ',', '.')  }}</a>
                         <?php $total_qdt_cons = $total_qdt_cons + $fertilizer_entry->quantity_cons ?>
                      </td>                                    
                      <td>
                          <a href= "{{ route('fertilizer_entry.edit' ,[ 'fertilizer_entry' => $fertilizer_entry->id ])}}" >{{ number_format($fertilizer_entry->price_unit_cons, 4 , ',', '.')  }}</a>
                      </td>
                  </tr>
              @empty
          @endforelse  
          
          <tr>
            <td>  
              <a>{{ " " }}</a>
            </td>
            <td>
              <a>{{ " "}}</a>
            </td>
            <td>
              <a>{{ " "}}</a>
            </td>
            <td>
              <a>{{ " "}}</a>
            </td>
            <td>
              <a>{{ " "}}</a>
            </td>
            <td>  
              <a>{{"Total : "}}</a>
            </td>
            <td>
              <a>{{ number_format($total_qdt_cons, 2 , ',', '.')  }}</a>     
            </td>
      </tbody>

  </table>
</div>


<!-- Inicio da Tabela dos aplicações -->
<p></p>
<p class="font-weight-bold">----------------  Aplicações   -------------------</p>
<p></p>

<?php $total_product = 0 ?>
<?php $total_amount = 0 ?>

                <div class='table-responsive'>

                  <table id="example1" class="table table-sm table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr>
                    
                            <th class="sorting_asc" tabindex="0" aria-controls="" rowspan="0" colspan="1"  aria-label="">Data</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Produto</th>
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
                          <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ $product_apply->ground->name}}</a>
                        </td>
                        <td>
                          <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ number_format($product_apply->amount, 2 , ',', '.')  }}</a>
                          <?php $total_product = $total_product + $product_apply->amount ?>
                        </td>
                        <td>
                          <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ number_format($product_apply->product->price_unit, 2 , ',', '.')  }}</a>
                        </td>
                        <td>
                          <a href= "{{ route('product_apply.edit' ,[ 'product_apply' => $product_apply->id ])}}" >{{ number_format($product_apply->account->amount, 2 , ',', '.')  }}</a>
                          <?php $total_amount = $total_amount + $product_apply->account->amount ?>
                        </td>          
                      </tr>
                         
                        @endforeach

                        <tr>
                          <td>  
                            <a>{{ " " }}</a>
                          </td>
                          <td>
                            <a>{{ " "}}</a>
                          </td>
                          <td>  
                            <a>{{"Totais : "}}</a>
                          </td>
                          <td>
                            <a>{{ number_format($total_product, 2 , ',', '.')  }}</a>     
                          </td>
                          <td>
                            <a>{{ " " }}</a>
                          </td>
                          <td>
                            <a>{{ number_format($total_amount, 2 , ',', '.')  }}</a>  
                          </td>          
                        </tr>
                      </tbody>
                    </table>                  
            </div>

<!------ Inicio da tabela de inventario -------->

<p></p>
<p class="font-weight-bold">----------------  Estoque atual   -------------------</p>
<p></p>

<div class='table-responsive'>

  <table id="example1" class="table table-sm  table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
    
    <thead>
        <tr>
    
            <th class="sorting_asc" tabindex="0" aria-controls="" rowspan="0" colspan="1"  aria-label="">Data</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Produto</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Fornecedor</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Entradas</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Saidas</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Estoque</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Unit</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="">Est. mín.</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="" style="display: none;">CSS grade</th>
        </tr>
    </thead>
  

      <tbody>

       
      
      @foreach($fertilizer_inventorys as $fertilizer_inventory)
       
      <tr>
        <td>  
          <a href= "{{ route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id  ])}}" >{{ $fertilizer_inventory->date }}</a>
        </td>
        <td>
          <a href= "{{ route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id ])}}" >{{ $fertilizer_inventory->product->name}}</a>
        </td>
        <td>
          <a href= "{{ route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id ])}}" >{{ $fertilizer_inventory->provide->name}}</a>
        </td>
        <td>  
          <a href= "{{ route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id ])}}" >{{ number_format($fertilizer_inventory->entry, 2 , ',', '.') }}</a>
        </td>
        <td>
          <a href= "{{ route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id ])}}" >{{ number_format($fertilizer_inventory->exit, 2 , ',', '.') }}</a>
        </td>
        <td>
          <a href= "{{ route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id ])}}" >{{ number_format($fertilizer_inventory->balance, 2 , ',', '.') }}</a>
        </td>
        <td>
          <a href= "{{ route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id ])}}" >{{ $fertilizer_inventory->product->unity }}</a>
        </td>
        <td>  
          <a href= "{{ route('fertilizer_inventory.edit' ,[ 'fertilizer_inventory' => $fertilizer_inventory->id ])}}" >{{ number_format($fertilizer_inventory->minimum_stock, 2 , ',', '.')  }}</a>              
        </td>

      </tr>
        
        @endforeach
      </tbody>
    </table>                  
  </div>

<!-- Fim da Tabela dos registros -->

 
<p class="text-right"> <a href="{{ url('/fertilizer_inventory_research') }}" class="text-right">Voltar </a> </p>

</body>

<!-- ./wrapper -->
<!-- jQuery -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
    window.location.href='#ancora';
</script>
<!-- page script -->

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

@stop

 