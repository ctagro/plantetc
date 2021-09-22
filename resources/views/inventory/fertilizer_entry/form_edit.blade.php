
 
     <!-- Inicio do Formulario de fertilizer_entry_conta --> 

  
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3"> 
     <input type="hidden" name="type_product_id" value="1" class="form-control py-3"> 
 
            <div class="form-group row">

                @if(!Request::is('*/edit'))
                     
                <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $fertilizer_entry->date }}"  class="form-control py-3" placeholder="$data">
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif

            @else
                <?php $data = $fertilizer_entry->date ?>
            <label for="date">Data : {{$data}}</label>

                <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $fertilizer_entry->date}}"  class="form-control py-3" placeholder="$data"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            @endif
            </div>
   

            <div class="form-group row">
                <label for="product_id" name="product_id">Fertilizante </label>
                <select name="product_id"  id="product_id" class="form-control">
                    <option value="" disabled selected>Selecione o tipo de conta...</option> 
                        @foreach($products as $product)
                            
                            <p>{{$product->id}}</p>
                            <option value="{{$product->id}}" {{ $product->id == $fertilizer_entry->product_id ? 'selected' : ''}}>{{$product->name}} </option>
                            
                        @endforeach
                    </select>
                    @if($errors->has('product_id'))
                        <h6 class="text-danger" >Selecione o tipo de conta</h6> 
                    @endif
                </div>

                <div class="form-group row">
                    <label for="provide_id" name="provide_id">Fornecedor </label>
                    <select name="provide_id"  id="provide_id" class="form-control">
                        <option value="" disabled selected>Selecione o tipo de conta...</option> 
                            @foreach($provides as $provide)
                                
                                <p>{{$provide->id}}</p>
                                <option value="{{$provide->id}}" {{ $provide->id == $fertilizer_entry->provide_id ? 'selected' : ''}}>{{$provide->name}} </option>
                                
                            @endforeach
                        </select>
                        @if($errors->has('provide_id'))
                            <h6 class="text-danger" >Selecione o tipo de conta</h6> 
                        @endif
                    </div>

            <div class="form-group row">
                <label for="quanty" name="quanty">Quantidade </label>
                <input type="number" class="floatNumberField form-control py-3" name="quantity" value="{{old('quantity') ?? $fertilizer_entry->quantity }}"  placeholder="0.00" step="0.01" >
                  @if($errors->has('quantity'))
                      <h6 class="text-danger" >Digite a quantidade</h6> 
                  @endif
              </div> 

              <div class="row">
                <div class="form-group col-sm-6 ">
                <label for="price_unit" name="price_unit">Preço unitário </label>
                <input type="number" class="floatNumberField form-control py-3" name="price_unit" value="{{old('price_unit') ?? $fertilizer_entry->price_unit }}"  placeholder="0.00" step="0.01" >
                  @if($errors->has('price_unit'))
                      <h6 class="text-danger" >Digite o preço unitário</h6> 
                  @endif
                </div> 

                <div class="form-group col-sm-6 ">
                    <label>Preço por und cons: </label>
                    <input type="number" class="floatNumberField form-control py-3" name="price_unit_cons" value="" class="form-control py-3" placeholder="0.000" step="0.001" >
                    @if($errors->has('price_unit'))
                        <h6 class="text-danger" >Digite o preço p/ unid cons</h6> 
                    @endif
                </div> 
            </div>

              <div class="form-group row">
                <label for="amount" name="amount">Valor total </label>
                <input type="number" class="floatNumberField form-control py-3" name="amount" value="{{old('amount') ?? $fertilizer_entry->amount }}"  placeholder="0.00" step="0.01" >
                  @if($errors->has('amount'))
                      <h6 class="text-danger" >Digite o valor</h6> 
                  @endif
              </div> 


            <input type="hidden" name="note" value="{{old('note)') ? $fertilizer_entry->note : "Observação"  }}" class="form-control py-3">

<!-- Fim do Formulario de fertilizer_entry_conta -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>

