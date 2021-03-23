

 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$sale->id }}" class="form-control py-3">
            <input type="hidden" name="type_account_id" value="3" class="form-control py-3">
            <input type="hidden" name="accounting_id" value="1" class="form-control py-3">
            <input type="hidden" name="data_pay" value="2021-01-01" class="form-control py-3">
            


                <div class="form-group">

                    @if(!Request::is('*/edit'))
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">
                        <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $sale->date }}"  class="form-control py-3" placeholder="$data">
                        @if($errors->has('date'))
                                <h6 class="text-danger" >Digite a data</h6> 
                        @endif
        
                    @else
                        <?php $data = $sale->date ?>
                    <label for="date">Data : {{$data}}</label>
                        <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $sale->date}}"  class="form-control py-3" placeholder="$data">  
                        @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
                    @endif
        
                </div>

  

                <div class="form-group">
                    <select name="crop"  id="crop" class="form-control">
                        <option value="" disabled selected>Selecione o produto...</option>
                        @foreach($crops as $crop)

                            <option value="{{$crop}}" {{ $crop->id == $sale->crop_id ? 'selected' : ''}}>{{$crop->name}} </option>
                                
                        @endforeach
                    </select>
                    @if($errors->has('crop'))
                        <h6 class="text-danger" >Selecione o produto</h6> 
                    @endif
                </div>   
                
    

                <div class="form-group">                   
                    <select name="ground_id"  id="ground_id" class="form-control">
                        <option value="" disabled selected>Selecione a área...</option> 
                            @foreach($grounds as $ground)
                                
                                <p>{{$ground->id}}</p>
                                    <option value="{{$ground->id}}" {{ $ground->id == $sale->ground_id ? 'selected' : ''}}>{{$ground->name}} </option>
                                
                            @endforeach
                    </select>
                    @if($errors->has('ground_id'))
                        <h6 class="text-danger" >Selecione o nome da Área de plantio</h6> 
                    @endif
                </div>

                <div class="row">
                <div class="form-group col-sm-4 ">
                    <label>Quantidade: </label>
                    <input type="number" class="floatNumberField form-control py-3"  name="amount"  value="{{old('amount') ?? $sale->amount}}" placeholder="0.00" step="0.01" >
                
                      @if($errors->has('amount'))
                          <h6 class="text-danger" >Digite a quantidade</h6> 
                      @endif
                  </div> 

                  <div class="form-group col-sm-4">

                    <label for="note">Unidade</label>    
                        <input type="text" name="unity" value="{{old('unity') ?? $sale->unity }}"  class="form-control">                            
                    </div>

                    <div class="form-group col-sm-4">
                        <label>Preço Unitário: </label>
                        <input type="number" class="floatNumberField form-control py-3"  name="price_unit"  value="{{old('price_unit') ?? $sale->price_unit}}" placeholder="0.00" step="0.01" >
                          @if($errors->has('price_unit'))
                              <h6 class="text-danger" >Digite a Preço Unitário</h6> 
                          @endif
                    </div> 
                </div>


                      <div class="form-group">
                        <select name="bayer_id"  id="bayer_id" class="form-control">
                            <option value="" disabled selected>Selecione (os) produto(s) utilizado(s)...</option>
                                @foreach($bayers as $bayer)
                                    
                                    <p>{{$bayer->id}}</p>
                                        <option value="{{$bayer->id}}" {{ $bayer->id == $sale->bayer_id ? 'selected' : ''}}>{{$bayer->name}} </option>
                                    
                                @endforeach
                            </select>
                            @if($errors->has('bayer_id'))
                                <h6 class="text-danger" >Selecione o nome do(s) produto(s) usados</h6> 
                            @endif
                    </div>                


            <div class="form-group">

                <label for="note">Observações</label>    
                    <input type="longtext" name="note" value="{{old('note') ?? $sale->note }}" rows="4" class="form-control">                            
                </div>

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    
                        @if(!Request::is('*/sale_research/index'))
                            <a href="{{ url('/sale_research/index') }}" class="float-right" >Voltar </a>
                        @else
                            <a href="{{ url('/sale') }}" class="float-right" >Voltar </a>
                        @endif
                        
                            
                    </div>
                </div>
</div>


<!-- ./wrapper -->
<!-- jQuery -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
    window.location.href='#ancora';
</script>
<!-- page script -->


