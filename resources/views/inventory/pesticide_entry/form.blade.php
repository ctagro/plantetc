
 
     <!-- Inicio do Formulario de pesticide_entry_conta --> 

     <input type="hidden" name="id" value="{{$pesticide_entry->id }}" class="form-control py-3"> 
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3"> 
     <input type="hidden" name="type_product_id" value="2" class="form-control py-3"> 

            <div class="form-group row">
                <input type="date" name="date" id ="date"  value="{{old('date')}}" class="form-control py-3" placeholder="$date"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            </div>
 
            <div class="form-group row">
                <select name="pesticide_id"  id="pesticide_id" class="form-control">
                    <option value="" disabled selected> Selecione o produto...</option>
                    @foreach($pesticides as $pesticide)

                        <option value="{{$pesticide->id}}" >{{$pesticide->name." | ". $pesticide->unity }} </option>
                                      
                    @endforeach
                </select>
                @if($errors->has('pesticide_id'))
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
            <p class="font-weight-bold">----------------  Dados da Nota   -------------------</p>

           <div class="row">
                <div class="form-group col-sm-3">
                    <p>Quantidade </p>
                    <input type="number" class="form-control py-3" name="quantity" value="{{old('quantity')}}" class="form-control py-3" placeholder="0.00" step="0.01" >
                    @if($errors->has('quantity'))
                        <h6 class="text-danger"  >Digite a quantidade</h6> 
                    @endif
                </div> 
           

                <div class="form-group col-sm-3 ">
                <p>Preço por unidade: </p>
                <input type="number" class="floatNumberField form-control py-3" name="price_unit" value="{{old('price_unit')}}" class="form-control py-3" placeholder="0.00" step="0.01" >
                  @if($errors->has('price_unit'))
                      <h6 class="text-danger" >Digite o preço unitário</h6> 
                  @endif
                </div> 

                <div class="form-group col-sm-3 ">
                    <p>Valor total: </p>
                    <input type="number" class="floatNumberField form-control py-3" name="amount" value="" class="form-control py-3" placeholder="0.00" step="0.01" >
                    @if($errors->has('amount'))
                        <h6 class="text-danger" >Digite o valor total</h6> 
                    @endif
                </div> 
            </div>

            <p class="font-weight-bold">----------------  Dados para o estoque  -------------------</p>

            <div class="row">
                <div class="form-group col-sm-3 ">
                    <p>Quantidade por unid de cons </p>
                    <input type="number" class="form-control py-3" name="quantity_cons" value="{{old('quantity_cons')}}" class="form-control py-3" placeholder="0.00" step="0.01" >
                    @if($errors->has('quantity_cons'))
                        <h6 class="text-danger"  >Digite a quantidade</h6> 
                    @endif
                </div> 

                <div class="form-group col-sm-3 ">
                    <p>Preço por unid de cons </p>
                    <input type="number" name="price_unit_cons" value="" class="form-control py-3" placeholder="0.0000" step="0.0001" >
                    @if($errors->has('price_unit_cons'))
                        <h6 class="text-danger" >Digite o preço p/ unid cons</h6> 
                    @endif
                </div> 
            </div>
          </div>


            <input type="hidden" name="note" value="{{old('note)')}}" class="form-control py-3" placeholder="Observação" >

<!-- Fim do Formulario de pesticide_entry_conta -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>

