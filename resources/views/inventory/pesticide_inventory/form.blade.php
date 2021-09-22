

 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$pesticide_inventory->id }}" class="form-control py-3">         


                <div class="form-group">
                    <label for="date" name="date">Data: </label>
                    @if(!Request::is('*/edit'))
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">
                        <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $pesticide_inventory->date }}"  class="form-control py-3" placeholder="$data">
                        @if($errors->has('date'))
                                <h6 class="text-danger" >Digite a data</h6> 
                        @endif
        
                    @else
                        <?php $data = $pesticide_inventory->date ?>
                    <label for="date">Data : {{$data}}</label>
                        <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $pesticide_inventory->date}}"  class="form-control py-3" placeholder="$data">  
                        @if($errors->has('date'))
                            <h6 class="text-danger" >Digite a data</h6> 
                        @endif           
                    @endif
        
                </div>


                <div class="form-group">
                    <label for="pesticide_id" name="pesticide_id">Defensivo </label>
                    <select name="pesticide_id"  id="pesticide_id" class="form-control">
                        <option value=""  disabled selected>Selecione o produto...</option>
                        @foreach($pesticides as $pesticide)

                            <option value="{{$pesticide->id}}" {{ $pesticide->id == $pesticide_inventory->pesticide_id ? 'selected' : ''}}>{{$pesticide->name." | ". $pesticide->unity }} </option>
                                                
                        @endforeach
                    </select>
                    @if($errors->has('pesticide_id'))
                        <h6 class="text-danger" >Selecione o produto</h6> 
                    @endif
                </div>  

              

                <div class="form-group">
                    <label for="provide_id" name="provide_id">Fornecedor </label>
                    <select name="provide_id"  id="provide_id" class="form-control">
                        <option value="" disabled selected>Selecione o fornecedor...</option>
                        @foreach($provides as $provide)

                            <option value="{{$provide->id}}" {{ $provide->id == $pesticide_inventory->provide_id ? 'selected' : ''}}>{{$provide->name}} </option>
                              
                        @endforeach
                    </select>
                    @if($errors->has('provide'))
                        <h6 class="text-danger" >Selecione o fornecedor</h6> 
                    @endif
                </div>  
            

                <div class="row">
                <div class="form-group col-sm-3 ">
                    <label>Entrada: </label>
                    <input type="number" class="floatNumberField form-control py-3"  name="entry"  value="{{old('entry') ?? $pesticide_inventory->entry}}" placeholder="0.00" step="0.01" >
                
                      @if($errors->has('entry'))
                          <h6 class="text-danger" >Digite a entrada</h6> 
                      @endif
                  </div> 

                    <div class="form-group col-sm-3 ">
                        <label>Saidas: </label>
                        <input type="number" class="floatNumberField form-control py-3"  name="exit"  value="{{old('exit') ?? $pesticide_inventory->exit}}" placeholder="0.00" step="0.01" >
                    
                          @if($errors->has('exit'))
                              <h6 class="text-danger" >Digite a entrada</h6> 
                          @endif
                      </div> 

                        <div class="form-group col-sm-3 ">
                            <label>Estoque: </label>
                            <input type="number" class="floatNumberField form-control py-3"  name="balance"  value="{{old('balance') ?? $pesticide_inventory->balance}}" placeholder="0.00" step="0.01" >
                        
                              @if($errors->has('balance'))
                                  <h6 class="text-danger" >Digite a entrada</h6> 
                              @endif
                          </div> 
               

                  <div class="form-group col-sm-3">
                        <label>Mínimo: </label>
                        <input type="number" class="floatNumberField form-control py-3"  name="minimum_stock"  value="{{old('minimum_stock') ?? $pesticide_inventory->minimum_stock}}" placeholder="0.00" step="0.01" >
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

                           
                     <option value="{{$status->id}}" {{ $status->id == $pesticide_inventory->status ? 'selected' : ''}}>{{$status->name }} </option>
                                
                       @endforeach
                    </select>
                   @if($errors->has('status'))
                        <h6 class="text-danger" >Selecione o status</h6> 
                   @endif
                </div>  
            
                    <div class="form-group">
                        <label for="note">Observações</label>    
                            <input type="longtext" name="note" value="{{old('note') ?? $pesticide_inventory->note }}" rows="4" class="form-control">                            
                    </div>

                @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    
                        @if(!Request::is('*/pesticide_inventory/index'))
                            <a href="{{ url('/pesticide_inventory') }}" class="float-right" >Voltar </a>
                        @else
                            <a href="{{ url('/pesticide_inventory') }}" class="float-right" >Voltar </a>
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


