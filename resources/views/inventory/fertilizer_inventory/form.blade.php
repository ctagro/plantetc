

 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$fertilizer_inventory->id }}" class="form-control py-3">         


                <div class="form-group">
                    <label for="date" name="date">Data: </label>
                    @if(!Request::is('*/edit'))
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">
                        <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $fertilizer_inventory->date }}"  class="form-control py-3" placeholder="$data">
                        @if($errors->has('date'))
                                <h6 class="text-danger" >Digite a data</h6> 
                        @endif
        
                    @else
                        <?php $data = $fertilizer_inventory->date ?>
                    <label for="date">Data : {{$data}}</label>
                        <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $fertilizer_inventory->date}}"  class="form-control py-3" placeholder="$data">  
                        @if($errors->has('date'))
                            <h6 class="text-danger" >Digite a data</h6> 
                        @endif           
                    @endif
        
                </div>


                <div class="form-group">
                    <label for="product_id" name="product_id">Fertilizante </label>
                    <select name="product_id"  id="product_id" class="form-control">
                        <option value=""  disabled selected>Selecione o produto...</option>
                        @foreach($products as $product)

                            <option value="{{$product->id}}" {{ $product->id == $fertilizer_inventory->product_id ? 'selected' : ''}}>{{$product->name." | ". $product->unity }} </option>
                                                
                        @endforeach
                    </select>
                    @if($errors->has('product_id'))
                        <h6 class="text-danger" >Selecione o produto</h6> 
                    @endif
                </div>  

              

                <div class="form-group">
                    <label for="provide_id" name="provide_id">Fornecedor </label>
                    <select name="provide_id"  id="provide_id" class="form-control">
                        <option value="" disabled selected>Selecione o fornecedor...</option>
                        @foreach($provides as $provide)

                            <option value="{{$provide->id}}" {{ $provide->id == $fertilizer_inventory->provide_id ? 'selected' : ''}}>{{$provide->name}} </option>
                              
                        @endforeach
                    </select>
                    @if($errors->has('provide'))
                        <h6 class="text-danger" >Selecione o fornecedor</h6> 
                    @endif
                </div>  
            

                <div class="row">
                <div class="form-group col-sm-3 ">
                    <label>Entrada: </label>
                    <input type="number" class="floatNumberField form-control py-3"  name="entry"  value="{{old('entry') ?? $fertilizer_inventory->entry}}" placeholder="0.00" step="0.01" >
                
                      @if($errors->has('entry'))
                          <h6 class="text-danger" >Digite a entrada</h6> 
                      @endif
                  </div> 

                    <div class="form-group col-sm-3 ">
                        <label>Saidas: </label>
                        <input type="number" class="floatNumberField form-control py-3"  name="exit"  value="{{old('exit') ?? $fertilizer_inventory->exit}}" placeholder="0.00" step="0.01" >
                    
                          @if($errors->has('exit'))
                              <h6 class="text-danger" >Digite a entrada</h6> 
                          @endif
                      </div> 

                        <div class="form-group col-sm-3 ">
                            <label>Estoque: </label>
                            <input type="number" class="floatNumberField form-control py-3"  name="balance"  value="{{old('balance') ?? $fertilizer_inventory->balance}}" placeholder="0.00" step="0.01" >
                        
                              @if($errors->has('balance'))
                                  <h6 class="text-danger" >Digite a entrada</h6> 
                              @endif
                          </div> 
               

                  <div class="form-group col-sm-3">
                        <label>Mínimo: </label>
                        <input type="number" class="floatNumberField form-control py-3"  name="minimum_stock"  value="{{old('minimum_stock') ?? $fertilizer_inventory->minimum_stock}}" placeholder="0.00" step="0.01" >
                          @if($errors->has('minimum_stock'))
                              <h6 class="text-danger" >Digite a Preço Unitário</h6> 
                          @endif
                    </div> 

                </div>

     
                <div class="form-group">
                    <label for="status" name="status">Status</label>
                    <select name="status"  id="status" class="form-control">
                        <option value="" disabled selected>Selecione o status..</option>
                     @foreach($statuss as $status)

                           
                     <option value="{{$status->id}}" {{ $status->id == $fertilizer_inventory->status ? 'selected' : ''}}>{{$status->name }} </option>
                                
                       @endforeach
                    </select>
                   @if($errors->has('status'))
                        <h6 class="text-danger" >Selecione o status</h6> 
                   @endif
                </div>  
            
                    <div class="form-group">
                        <label for="note">Observações</label>    
                            <input type="longtext" name="note" value="{{old('note') ?? $fertilizer_inventory->note }}" rows="4" class="form-control">                            
                    </div>

                @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    
                        @if(!Request::is('*/fertilizer_inventory/index'))
                            <a href="{{ url('/fertilizer_inventory') }}" class="float-right" >Voltar </a>
                        @else
                            <a href="{{ url('/fertilizer_inventory') }}" class="float-right" >Voltar </a>
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


