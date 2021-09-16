
 
     <!-- Inicio do Formulario de entry_conta --> 

  
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3"> 

            <div class="form-group row">
                <input type="date" name="date" id ="date"  value="{{old('date')}}" class="form-control py-3" placeholder="$date"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            </div>
 
            <div class="form-group row">
                <input type="number" name="type_product_id" value="{{old('type_product_id')}}"" class="form-control py-3" placeholder="Tipo de produto" >
                @if($errors->has('type_product_id'))
                    <h6 class="text-danger" >Digite a Tipo de produto</h6> 
                @endif
            </div>

            <div class="form-group row">
                <input type="number" name="product_id" value="{{old('product_id')}}"" class="form-control py-3" placeholder="Produto" >
                @if($errors->has('product_id'))
                    <h6 class="text-danger" >Digite o produto</h6> 
                @endif
            </div>

            <div class="form-group row">
                <input type="number" class="floatNumberField form-control py-3" name="quantity" value="{{old('quantity')}}" class="form-control py-3" placeholder="Quantidade" >
                  @if($errors->has('quantity'))
                      <h6 class="text-danger" >Digite a quantidade</h6> 
                  @endif
              </div> 

              <div class="form-group row">
                <input type="number" class="floatNumberField form-control py-3" name="price_unit" value="{{old('price_unit')}}" class="form-control py-3" placeholder="Preço unitário" >
                  @if($errors->has('price_unit'))
                      <h6 class="text-danger" >Digite o preço unitário</h6> 
                  @endif
              </div> 

              <div class="form-group row">
                <input type="number" class="floatNumberField form-control py-3" name="amount" value="{{old('amount')}}" class="form-control py-3" placeholder="Valor total" >
                  @if($errors->has('amount'))
                      <h6 class="text-danger" >Digite o valor</h6> 
                  @endif
              </div> 


            <input type="hidden" name="note" value="{{old('note)')}}" class="form-control py-3" placeholder="Observação" >

<!-- Fim do Formulario de entry_conta -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>

