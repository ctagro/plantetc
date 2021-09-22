
 
     <!-- Inicio do Formulario de fertilizer_entry_conta --> 

     <input type="hidden" name="id" value="{{$fertilizer_entry->id }}" class="form-control py-3"> 
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3"> 
     <input type="hidden" name="type_product_id" value="1" class="form-control py-3"> 

            <div class="form-group row">
                <input type="date" name="date" id ="date"  value="{{old('date')}}" class="form-control py-3" placeholder="$date"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            </div>
 
            <div class="form-group row">
                <select name="product_id"  id="product_id" class="form-control">
                    <option value="" disabled selected> Selecione o produto...</option>
                    @foreach($products as $product)

                        <option value="{{$product->id}}" >{{$product->name." | ". $product->unity }} </option>
                                      
                    @endforeach
                </select>
                @if($errors->has('product_id'))
                    <h6 class="text-danger" >Selecione o produto</h6> 
                @endif
            </div>  

            <div class="form-group row">
                <select name="provide_id"  id="provide_id" class="form-control">
                    <option value="" disabled selected>Selecione o fornecedor...</option>
                    @foreach($provides as $provide)

                        <option value="{{$provide->id}}" >{{$provide->name}} </option>
                
                            
                    @endforeach
                </select>
                @if($errors->has('provide'))
                    <h6 class="text-danger" >Selecione o fornecedor</h6> 
                @endif
            </div>  
        

            <div class="form-group row">
                <input type="number" class="floatNumberField form-control py-3" name="quantity" value="{{old('quantity')}}" class="form-control py-3" placeholder="Quantidade" >
                  @if($errors->has('quantity'))
                      <h6 class="text-danger" >Digite a quantidade</h6> 
                  @endif
              </div> 

              <div class="row">
                <div class="form-group col-sm-6 ">
                <label>Preço por unidade: </label>
                <input type="number" class="floatNumberField form-control py-3" name="price_unit" value="{{old('price_unit')}}" class="form-control py-3" placeholder="0.00" step="0.01" >
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
                <input type="number" class="floatNumberField form-control py-3" name="amount" value="{{old('amount')}}" class="form-control py-3" placeholder="Valor total" >
                  @if($errors->has('amount'))
                      <h6 class="text-danger" >Digite o valor</h6> 
                  @endif
              </div> 


            <input type="hidden" name="note" value="{{old('note)')}}" class="form-control py-3" placeholder="Observação" >

<!-- Fim do Formulario de fertilizer_entry_conta -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>

