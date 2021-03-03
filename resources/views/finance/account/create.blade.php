 

    <!-- porque nao suporta o metodo POST se store é post-->   

 <form method="POST" action="{{ route('account.store')}}">
             <div class="form-group">
             {!! csrf_field() !!}                      

             @include('finance.account.form')

                 <div class="form-group">
                      <button type="submit" class="btn btn-danger btn-block">Registrar a movimentação financeira</button>
                 </div>
             </div>
         <a href="#" id="ancora"></a>
</form>
                
     



