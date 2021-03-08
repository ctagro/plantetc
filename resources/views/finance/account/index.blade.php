<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movimentacao</title>
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

@section('title', 'Movimentações')



@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/expense.jpeg')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                    Registrar movimentação financeira
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inicio da Tabela dos registros -->

                <div class='table-responsive'>

                <table id="example1" class="table table-sm table-bordered table-striped dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr>
                    
                            <th class="sorting_asc" tabindex="0" aria-controls="" rowspan="0" colspan="1"  aria-label="">Data</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Descrição</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Tipo</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Área</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Conta</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Valor</th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="display: none;">CSS grade</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @forelse($accounts as $account)
                                <tr>
                                    <td>
                                       <a href= "{{ route('account.edit' ,[ 'account' => $account->id ])}}" >{{ $account->date }}</a>
                                    </td>
                                    <td>
                                        <a href= "{{ route('account.edit' ,[ 'account' => $account->id ])}}" >{{ $account->description }}</a>
                                    </td>
                                    <td>
                                        <a href= "{{ route('account.edit' ,[ 'account' => $account->id ])}}" >{{ $account->type}}</a>
                                    </td>
                                    <td>
                                        <a href= "{{ route('account.edit' ,[ 'account' => $account->id ])}}" >{{ $account->ground }}</a>
                                    </td>
                                    <td>
                                        <a href= "{{ route('account.edit' ,[ 'account' => $account->id ])}}" >{{ $account->accounting }}</a>
                                    </td>  
                                    <td>
                                        <a href= "{{ route('account.edit' ,[ 'account' => $account->id ])}}" >{{ number_format($account->amount, 2 , ',', '.')  }}</a>
                                    </td>
                                </tr>
                            @empty
                        @endforelse                  
                    </tbody>
        
                </table>

           @if(isset($account->date))
                    <?php $account->date = Null ?>
                    <?php $account->description = Null ?>
                    <?php $account->type = Null ?>
                    <?php $account->accounting = Null ?>
                    <?php $account->ground = Null ?>
                    <?php $account->amount = Null ?>
                    <?php $account->note = Null ?>
                @endif
             
            </div>

<!-- Fim da Tabela dos registros -->

             
    <!-- Inicio do Formulario de account --> 

       @include('finance.account.create') 
           
<!-- Fim do Formulario de account_conta --> 

<p class="text-right"> <a href="{{ url('/home') }}" class="text-right">Voltar </a> </p>

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

 