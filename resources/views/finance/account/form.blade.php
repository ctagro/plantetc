
 
     <!-- Inicio do Formulario de account_conta --> 

  
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3"> 
     <input type="hidden" name="origin" value={{"C"}} class="form-control py-3">

            <div class="form-group row">
                <input type="date" name="date" id ="date"  value="{{old('date')}}" class="form-control py-3" placeholder="$date"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            </div>
   
            <div class="form-group row">
                <input type="txt" name="description" value="{{old('description')}}" class="form-control py-3" placeholder="Descrição" >
                @if($errors->has('description'))
                    <h6 class="text-danger" >Digite a Descrição</h6> 
                @endif
            </div>

<div class="form-group">
    <select name="type_account_id"  id="type_account_id" value="{{old('typeaccount')}}" class="form-control">
        <option value="" disabled selected>Selecione o tipo de conta...</option> 
            @foreach($type_accounts as $type_account)
                    <option value="{{$type_account->id}}">{{$type_account->name}} </option>       
            @endforeach
        </select>
        @if($errors->has('type_account_id'))
            <h6 class="text-danger" >Selecione o tipo de conta</h6> 
        @endif
    </div>

<div class="form-group">
    <select name="accounting_id"  id="accounting_id" class="form-control">
            <option value="" disabled selected>Selecione a conta...</option> 
            @foreach($accountings as $accounting)
                                
                <option value="{{$accounting->id}}">{{$accounting->name}} </option>
                
            @endforeach
    </select>
        @if($errors->has('accounting_id'))
            <h6 class="text-danger" >Selecione a Conta</h6> 
        @endif
</div>

<div class="form-group">
    <select name="ground_id"  id="ground_id" class="form-control">
   <option value="" disabled selected>Selecione a área...</option> 
       @foreach($grounds as $ground)         
           <p>{{$ground->id}}</p>
           <option value="{{$ground->id}}">{{$ground->name}} </option>                
       @endforeach
   </select>
   @if($errors->has('ground_id'))
       <h6 class="text-danger" >Selecione a Área de plantio</h6> 
   @endif
</div>



<div class="form-group row">
  <input type="number" class="floatNumberField form-control py-3"  name="amount"  value="{{old('amount')}}" placeholder="0.00" step="0.01" >
    @if($errors->has('amount'))
        <h6 class="text-danger" >Digite o valor</h6> 
    @endif
</div> 

<input type="hidden" name="note" value="{{old('note)') ? $account->note : "Observação"  }}" class="form-control py-3">

<!-- Fim do Formulario de account_conta -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>

