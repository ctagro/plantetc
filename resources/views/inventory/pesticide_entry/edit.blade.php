
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movimentações</title>
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

@section('title', 'Contas')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/pesticide_entrying_plant.png')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                    Editar entrada do estoque
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('sucess'))
<div class="alert alert-warning">
    {{ session('sucess') }}
</div>
@endif

@if(Session::has('mensagem_sucesso'))
     <div class="alert alert-success"> {{ Session::get('mensagem_sucesso')}}</div>
@endif
   

    <form action="{{ route('pesticide_entry.update' ,[ 'pesticide_entry' => $pesticide_entry->id ])}}" method="POST"  enctype="multipart/form-data">

        @method('PATCH')

             <div class="form-group">
             {!! csrf_field() !!}                      

             @include('inventory.pesticide_entry.form_edit')

                 <div class="form-group">
                      <button type="submit" class="btn btn-danger btn-block">Atualizar a entrada no estoque</button>
                 </div>
             </div>

  <!-- Link para deletar inativo -->
    
             <div class="row justify-content-between" >

              <a href= "{{ route('pesticide_entry.show' ,[ 'pesticide_entry' => $pesticide_entry->id ])}}" class="btn btn-outline-danger" >Deletar</a>
   
              <div class="text-right"> <a href="{{ url('/pesticide_entry') }}" class="text-right">Voltar </a> </div>
             </div>
         <a href="#" id="ancora"></a>
</form>
                


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

 

