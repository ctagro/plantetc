<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tipo de atividades</title>
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
                            <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/type_activity_plant.jpeg')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                            Tipo de atividades
                           <a class="float-right" href="{{url('type_activity/create')}}">Cadastrar</a>
                        </div>
                    </div>
                </div>
            </div>
          </div>  
          
          
    
           
                @if(Session::has('mensagem_sucesso'))
                       <div class="alert alert-success"> {{ Session::get('mensagem_sucesso')}}</div>
                @endif

                <table class="table">
                  <th> </th>
                  <th>Descrição</th>
                  <th>Observações<optgroup></optgroup></th>

                    <tbody>

                      @foreach($type_activities as $type_activity)

                        <tr>

                          <td>
                              @if (auth()->user()->image != null)
                              <img src="{{ asset('storage/type_activities/'.$type_activity->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                              @endif
                          </div>
                          </td>
                          <td>  
                          <a href= "{{ route('type_activity.edit' ,[ 'type_activity' => $type_activity->id  ])}}" >{{ $type_activity -> description}}</a>
                          </td>
                          <td>
                            <textarea class="form-control" rows="1" cols= "33" > {{$type_activity->note }} </textarea>
                          </td>
                          <td>  
                            <a href= "{{ route('type_activity.edit' ,[ 'type_activity' => $type_activity->id  ])}}" >{{ $type_activity -> in_use}}</a>
                          </td>
        
                          <td >
            
                            <form id="delete-form"  method="POST" action="{{ route('type_activity.destroy' ,[ 'type_activity' => $type_activity->id ])}}", style = 'display: inline;'> 
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}                 
                            </form>
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
