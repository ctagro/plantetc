


@extends('adminlte::page')




@section('title', 'Home')

@section('content_header')
    <h3 class="text-dark text-center p-1">Fazenda Santa Luiza</h3>
    <h6 class="card-subtitle text-center">Conta:  {{ auth()->user()->name }}</h6>
@stop

@section('content')

  
    <div class="row justify-content-sm-center">

        <div class="col-md-4 col-sm-12">
        <a href="{{ route('activity.index') }}" class="">
            <div class="card">
                <h5 class="mt-2 text-center">Registrar Atividade</h5>
                 <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/activity_plant.png')}}"  style="height: 200px;"alt="Espaço reservado para exibição de imagens" >
                <div class="card-body">
           
                </div>
            </div>
        </a>
            
        </div>

        <div class="col-md-4 col-sm-12">
            <a href="{{ route('account.index') }}" class="">
                <div class="card">
                    <h5 class="mt-2 text-center">Registrar Despesas</h5>           
                        <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/accounting_plant.png')}}"  style="height: 200px;" alt="Espaço reservado para exibição de imagem" >              
                    <div class="card-body">

                    </div>
                </div>
             </a>
        </div>

        <div class="col-md-4 col-sm-12">
            <a href="{{ route('sale.index') }}" class="">
            <div class="card">
                <h5 class="mt-2 text-center">Registrar Vendas</h5>
    
                    <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/sale_plant.png')}}"  style="height: 200px;" alt="Espaço reservado para exibição de imagem" >
                  
                <div class="card-body">
    
                </div>
            </div>
        </a>
        </div>
        
        <div class="col-md-4 col-sm-12">
            <a href="{{ route('product_apply.index') }}" class="">
                <div class="card">
                    <h5 class="mt-2 text-center">Aplicação de Insumos</h5>
                     <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/product_apply_plant.png')}}"  style="height: 200px;"alt="Espaço reservado para exibição de imagens" >
                    <div class="card-body">
               
                    </div>
                </div>
            </a>
        </div>

            <div class="col-md-4 col-sm-12">
                <a href="{{ route('cash_flow.consult') }}" class="">
                <div class="card">
                    <h5 class="mt-2 text-center">Fluxo de Caixa</h5>
        
                        <img class="card-img-top img-responsive img-thumbnail" src="{{ asset('img/cards/fluxo_de_caixa.jpeg')}}"  style="height: 200px;" alt="Espaço reservado para exibição de imagem" >
                      
                    <div class="card-body">
        
                    </div>
                </div>
            </a>
            </div>

    </div>



@stop
