
 
     <!-- Inicio do Formulario de cashFlow_conta --> 

  
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">

            <div class="form-group row">
                <input type="date" name="date" id ="date"  value="{{old('date')}}" class="form-control py-3" placeholder="$date"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            </div>
   
            <div class="form-group row">
                <input type="txt" name="description" value="{{old('description')}}" class="form-control py-3" placeholder="Descrição da transação" >
                @if($errors->has('description'))
                    <h6 class="text-danger" >Digite a Descrição da transação<object data="" type=""></object></h6> 
                @endif
            </div>


            <div class="form-group row">
                <select name="bank_id"  id="bank_id" class="form-control">
            <option value="" disabled selected>Selecione o tipo de documento..</option> 
                @foreach($banks as $bank)         
                    <p>{{$bank->id}}</p>
                    <option value="{{$bank->id}}">{{$bank->name}} </option>                
                @endforeach
            </select>
            @if($errors->has('bank_id'))
                <h6 class="text-danger" >Selecione o tipo de documento</h6> 
            @endif
            </div>

            <div class="form-group row">
                <h6 class="text-blue" >Crédito use (+), Débito use (-)</h6> 
            <input type="number" class="floatNumberField form-control py-3"  name="amount"  value="{{old('amount')}}" placeholder="0.00" step="0.01" >
                @if($errors->has('amount'))
                    <h6 class="text-danger" >Digite o valor</h6> 
                @endif
            </div> 

            <div class="form-group row">
                    <input type="longtext" name="note" value="{{old('note') }}" rows="4" class="form-control py-3" placeholder="Observação">                            
            </div>

<!-- Fim do Formulario de cashFlow_conta -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>

