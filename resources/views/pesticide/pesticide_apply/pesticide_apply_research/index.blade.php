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

@extends('adminlte::page')

@section('title', 'Aplicação')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/pesticide_apply_plant.png')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                     Aplicação de defensivos
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inicio da Tabela dos registros -->

<?php $total_pesticide = 0 ?>
<?php $total_amount = 0 ?>

                <div class='table-responsive'>

                  <table id="example1" class="table table-sm table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr>
                    
                            <th class="sorting_asc" tabindex="0" aria-controls="" rowspan="0" colspan="1"  aria-label="">Data</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Defensivo</th>
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
  
                       
                      
                      @foreach($pesticide_applys as $pesticide_apply)
                       
                      <tr>
                        <td>  
                          <a href= "{{ route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id  ])}}" >{{ $pesticide_apply->date }}</a>
                        </td>
                        <td>
                          <a href= "{{ route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id ])}}" >{{ $pesticide_apply->pesticide->name}}</a>
                        </td>
                        <td>
                          <a href= "{{ route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id ])}}" >{{ $pesticide_apply->worker->name}}</a>
                        </td>
                        <td>  
                          <a href= "{{ route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id ])}}" >{{ $pesticide_apply->accounting->name}}</a>
                        </td>
                        <td>  
                          <a href= "{{ route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id ])}}" >{{ $pesticide_apply->ground->name}}</a>
                        </td>
                        <td>
                          <a href= "{{ route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id ])}}" >{{ number_format($pesticide_apply->amount, 2 , ',', '.')  }}</a>
                          <?php $total_pesticide = $total_pesticide + $pesticide_apply->amount ?>
                        </td>
                        <td>
                          <a href= "{{ route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id ])}}" >{{ number_format($pesticide_apply->pesticide->price_unit, 2 , ',', '.')  }}</a>
                        </td>
                        <td>
                          <a href= "{{ route('pesticide_apply.edit' ,[ 'pesticide_apply' => $pesticide_apply->id ])}}" >{{ number_format($pesticide_apply->account->amount, 2 , ',', '.')  }}</a>
                          <?php $total_amount = $total_amount + $pesticide_apply->account->amount ?>
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
                            <a>{{ " "}}</a>
                          </td>
                          <td>  
                            <a>{{ " "}}</a>
                          </td>
                          <td>  
                            <a>{{"Totais : "}}</a>
                          </td>
                          <td>
                            <a>{{ number_format($total_pesticide, 2 , ',', '.')  }}</a>     
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

<!-- Fim da Tabela dos registros -->

 
<p class="text-right"> <a href="{{ url('/pesticide_apply/pesticide_apply_research') }}" class="text-right">Voltar </a> </p>

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

 