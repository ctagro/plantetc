 

    <!-- porque nao suporta o metodo POST se store é post-->   

 <form method="POST" action="{{ route('entry.store')}}">
             <div class="form-group">
             {!! csrf_field() !!}                      

             @include('stock.entry.form')

                 <div class="form-group">
                      <button type="submit" class="btn btn-danger btn-block">Registrar a entrada no estoque</button>
                 </div>
             </div>
         <a href="#" id="ancora"></a>
</form>
                
     



