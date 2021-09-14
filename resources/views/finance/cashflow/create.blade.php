 

    <!-- porque nao suporta o metodo POST se store é post-->   

 <form method="POST" action="{{ route('cashFlow.store')}}">
             <div class="form-group">
             {!! csrf_field() !!}                      

             @include('finance.cashflow.form')

                 <div class="form-group">
                      <button type="submit" class="btn btn-danger btn-block">Registrar fluxo de caixa</button>
                 </div>
             </div>
         <a href="#" id="ancora"></a>
</form>
                
     



