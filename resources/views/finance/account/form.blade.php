
 
     <!-- Inicio do Formulario de account_conta --> 

  
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3"> 

            <div class="form-group row">

                @if(!Request::is('*/edit'))
                     
                <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $account->date }}"  class="form-control py-3" placeholder="$data">
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif

            @else
                <?php $data = $account->date ?>
            <label for="date">Data : {{$data}}</label>

                <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $account->date}}"  class="form-control py-3" placeholder="$data"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            @endif
            </div>
   
<div class="form-group row">
    <input type="txt" name="description" value="{{old('description') ?? $account->description }}" class="form-control py-3" placeholder="Descrição">
    @if($errors->has('description'))
        <h6 class="text-danger" >Digite a Descrição</h6> 
    @endif
</div>

<div class="form-group row">
    <select name="type"  id="type" class="form-control">
        <option value="D">Despesa</option>
        <option value="I">Investimento</option>
      </select>
    @if($errors->has('type'))
        <h6 class="text-danger" >Digite a Tipo</h6> 
    @endif
</div>

<div class="form-group row">
    <input type="txt" name="ground" value="{{old('ground') ?? $account->ground }}" class="form-control py-3" placeholder="Área">
    @if($errors->has('ground'))
        <h6 class="text-danger" >Digite a Área</h6> 
    @endif
</div>

<div class="form-group row">
    <input type="txt" name="accounting" value="{{old('accounting') ?? $account->accounting }}" class="form-control py-3" placeholder="Conta">
    @if($errors->has('accounting'))
        <h6 class="text-danger" >Digite a Conta</h6> 
    @endif
</div>


<div class="form-group row">
  <input type="number" class="floatNumberField form-control py-3" name="amount" value="{{old('amount') ?? $account->amount }}"  placeholder="0.00" step="0.01" >
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

