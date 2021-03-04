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
                                <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/activity_plant.jpeg')}}"  style="height: 50px; width: 50px;"alt="Imagem" >
                                  Atividades
                                  <a class="float-right" href="{{url('activity/create')}}">Cadastrar</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
           
                @if(Session::has('mensagem_sucesso'))
                       <div class="alert alert-success"> {{ Session::get('mensagem_sucesso')}}</div>
                @endif

                <table class="table">

                  <th class="sorting_asc" tabindex="0" aria-controls="" rowspan="0" colspan="1"  aria-label="">Data</th>
                  <th>Atividades</th>
                  <th>Funcionário</th>
                  <th>Horas trab</th>


                

                    <tbody>

                     

                      @foreach($activitys as $activity)

                        <tr>
                          <td>  
                          <a href= "{{ route('activity.edit' ,[ 'activity' => $activity->id  ])}}" >{{ $activity->date }}</a>
                          </td>
                          <td>
                            <a href= "{{ route('activity.edit' ,[ 'activity' => $activity->id ])}}" >{{ $activity->type_activity->description}}</a>
                          </td>
                          <td>
                            <a href= "{{ route('activity.edit' ,[ 'activity' => $activity->id ])}}" >{{ $activity->worker->name}}</a>
                          </td>
                          <td>  
                            <a href= "{{ route('activity.edit' ,[ 'activity' => $activity->id ])}}" >{{ number_format($activity->worked_hours, 2 , ',', '.')  }}</a>
                          </td>
                          
                           
                        </td>
                    
                        
                          <td >
            
                            <form id="delete-form"  method="POST" action="{{ route('activity.destroy' ,[ 'activity' => $activity->id ])}}", style = 'display: inline;'> 
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
