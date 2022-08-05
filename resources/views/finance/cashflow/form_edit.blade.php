
 
     <!-- Inicio do Formulario de cashFlow_conta --> 

  
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3"> 
 

            <div class="form-group row">

                @if(!Request::is('*/edit'))
                     
                <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $cashFlow->date }}"  class="form-control py-3" placeholder="$data">
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif

            @else
                <?php $data = $cashFlow->date ?>
            <label for="date">Data : {{$data}}</label>

                <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $cashFlow->date}}"  class="form-control py-3" placeholder="$data"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            @endif
            </div>
   
            <div class="form-group row">
                <input type="txt" name="description" value="{{old('description') == $cashFlow->description ? $cashFlow->description : $cashFlow->description}}" class="form-control py-3" >
                @if($errors->has('description'))
                    <h6 class="text-danger" >Digite a Descrição</h6> 
                @endif
            </div>

            <div class="form-group row">
                <select name="bank_id"  id="bank_id" class="form-control">
            <option value="" disabled selected>Selecione o tipo de documento...</option> 
                @foreach($banks as $bank)         
                    <p>{{$bank->id}}</p>
                    <option value="{{$bank->id}}" {{ $bank->id == $cashFlow->bank_id ? 'selected' : ''}}>{{$bank->name}} </option>                
                @endforeach
            </select>
            @if($errors->has('bank_id'))
                <h6 class="text-danger" >Selecione o Banco</h6> 
            @endif
            </div>


            <div class="form-group row">
            <input type="number" class="floatNumberField form-control py-3" name="amount" value="{{old('amount') ?? $cashFlow->amount }}"  placeholder="0.00" step="0.01" >
                @if($errors->has('amount'))
                    <h6 class="text-danger" >Digite o valor</h6> 
                @endif
            </div> 

            <div class="form-group row"> 
                    <input type="longtext" name="note" value="{{old('note') ?? $cashFlow->note }}" rows="4" class="form-control">                            
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

