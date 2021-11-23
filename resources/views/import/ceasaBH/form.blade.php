<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Ceasa</title>
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

@section('title', 'Upload de Arquivo')

    @extends('adminlte::page')

@section('content')


 <div class='table-responsive'>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/activity_plant.png')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                        Upload de arquivo CSV de origem do CeasaBH

                    </div>
                </div>
            </div>
        </div>
    </div>  
          
    <form  action="{{ route('ceasa.storeImport') }}" method="POST" enctype="multipart/form-data" class="col-12">
        @method('POST')
        @csrf
            <div class="form-group">
                        <input type="date" name="date"  value=""  class="form-control py-3" placeholder="$data">
                        @if($errors->has('date'))
                                <h6 class="text-danger" >Digite a data</h6> 
                        @endif
    
            </div>

            <div class="form-group">
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" value="{{old('file')}}">
                    @if ($errors->has('file'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif

            </div>
 
            <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Importar</button>
                        <a href="{{ url('/home') }}" class="float-right" >Voltar </a> 
                    </div>
            </div>
    </form>
</div>

@endsection
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


