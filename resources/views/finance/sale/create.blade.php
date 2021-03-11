 

    <!-- porque nao suporta o metodo POST se store é post-->   

 <form method="POST" action="{{ route('sale.store')}}">
             <div class="form-group">
             {!! csrf_field() !!}                      

             @include('finance.sale.form')

                 <div class="form-group">
                      <button type="submit" class="btn btn-danger btn-block">Registrar a venda efetuada</button>
                 </div>
             </div>
         <a href="#" id="ancora"></a>
</form>
                
     



