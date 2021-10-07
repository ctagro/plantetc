
 
     <!-- Inicio do Formulario de pesticide_entry_conta --> 

  
     <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3"> 
     <input type="hidden" name="type_product_id" value="2" class="form-control py-3"> 
 
            <div class="form-group row">

                @if(!Request::is('*/edit'))
                     
                <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $pesticide_entry->date }}"  class="form-control py-3" placeholder="$data">
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif

            @else
                <?php $data = $pesticide_entry->date ?>
            <label for="date">Data : {{$data}}</label>

                <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $pesticide_entry->date}}"  class="form-control py-3" placeholder="$data"> 
                @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
            @endif
            </div>
   

            <div class="form-group row">
                <label for="pesticide_id" name="pesticide_id">Defensivo </label>
                <select name="pesticide_id"  id="pesticide_id" class="form-control">
                    <option value="" disabled selected>Selecione o tipo de conta...</option> 
                        @foreach($pesticides as $pesticide)
                            
                            <p>{{$pesticide->id}}</p>
                            <option value="{{$pesticide->id}}" {{ $pesticide->id == $pesticide_entry->pesticide_id ? 'selected' : ''}}>{{$pesticide->name}} </option>
                            
                        @endforeach
                    </select>
                    @if($errors->has('pesticide_id'))
                        <h6 class="text-danger" >Selecione o tipo de conta</h6> 
                    @endif
                </div>

                <div class="form-group row">
                    <label for="provide_id" name="provide_id">Fornecedor </label>
                    <select name="provide_id"  id="provide_id" class="form-control">
                        <option value="" disabled selected>Selecione o tipo de conta...</option> 
                            @foreach($provides as $provide)
                                
                                <p>{{$provide->id}}</p>
                                <option value="{{$provide->id}}" {{ $provide->id == $pesticide_entry->provide_id ? 'selected' : ''}}>{{$provide->name}} </option>
                                
                            @endforeach
                        </select>
                        @if($errors->has('provide_id'))
                            <h6 class="text-danger" >Selecione o tipo de conta</h6> 
                        @endif
                    </div>

           
            <div class="row">
                <div class="form-group col-sm-3 ">
                    <label for="quanty" name="quanty">Quantidade </label>
                    <input type="number" class="floatNumberField form-control py-3" name="quantity" value="{{old('quantity') ?? $pesticide_entry->quantity }}"  placeholder="0.00" step="0.01" >
                    @if($errors->has('quantity'))
                        <h6 class="text-danger" >Digite a quantidade</h6> 
                    @endif
                </div> 

                <div class="form-group col-sm-3 ">
                <label for="price_unit" name="price_unit">Preço unitário </label>
                <input type="number" class="floatNumberField form-control py-3" name="price_unit" value="{{old('price_unit') ?? $pesticide_entry->price_unit }}"  placeholder="0.00" step="0.01" >
                  @if($errors->has('price_unit'))
                      <h6 class="text-danger" >Digite o preço unitário</h6> 
                  @endif
                </div> 

                <div class="form-group col-sm-3 ">
                    <label for="amount" name="amount">Valor total </label>
                    <input type="number" class="floatNumberField form-control py-3" name="amount" value="{{old('amount') ?? $pesticide_entry->amount }}"  placeholder="0.00" step="0.01" >
                      @if($errors->has('amount'))
                          <h6 class="text-danger" >Digite o valor</h6> 
                      @endif
                </div> 

                <div class="form-group col-sm-3 ">
                    <label>Preço por und cons: </label>
                    <input type="number" class="floatNumberField form-control py-3" name="price_unit_cons" value="" class="form-control py-3" placeholder="0.000" step="0.001" >
                    @if($errors->has('price_unit'))
                        <h6 class="text-danger" >Digite o preço p/ unid cons</h6> 
                    @endif
                </div> 
            </div>


            <input type="hidden" name="note" value="{{old('note)') ? $pesticide_entry->note : "Observação"  }}" class="form-control py-3">

<!-- Fim do Formulario de pesticide_entry_conta -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>

