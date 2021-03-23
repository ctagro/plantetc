

 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$product_apply->id }}" class="form-control py-3">
            <input type="hidden" name="type_account_id" value="1" class="form-control py-3">
            <input type="hidden" name="activity" value="N" class="form-control py-3">
            


                <div class="form-group">

                    @if(!Request::is('*/edit'))
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">
                        <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $product_apply->date }}"  class="form-control py-3" placeholder="$data">
                        @if($errors->has('date'))
                                <h6 class="text-danger" >Digite a data</h6> 
                        @endif
        
                    @else
                        <?php $data = $product_apply->date ?>
                    <label for="date">Data : {{$data}}</label>
                        <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $product_apply->date}}"  class="form-control py-3" placeholder="$data">  
                        @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
                    @endif
        
                </div>

  

                <div class="form-group">
                    <select name="product"  id="product" class="form-control">
                        <option value="" disabled selected>Selecione o produto...</option>
                        @foreach($products as $product)

                            <option value="{{$product}}" {{ $product->id == $product_apply->product_id ? 'selected' : ''}}>{{$product->name ." |  Preço: ". $product->price_unit ."  (". $product->unity.")" }} </option>
                        
                        @endforeach
                        <div class="form-group col-sm-4">
                            <label>Preço Unitário: </label>
                            <div class="form-control">{{ $product->price_unit}}</div>
                        </div> 
                    </select>
                    @if($errors->has('product'))
                        <h6 class="text-danger" >Selecione o produto</h6> 
                    @endif
                </div>
    
                
                <div class="form-group">                   
                    <select name="worker_id"  id="worker_id" class="form-control">
                        <option value="" disabled selected>Selecione o funcionário...</option> 
                            @foreach($workers as $worker)
                                
                                <p>{{$worker->id}}</p>
                                    <option value="{{$worker->id}}" {{ $worker->id == $product_apply->worker_id ? 'selected' : ''}}>{{$worker->name}} </option>
                                
                            @endforeach
                    </select>
                    @if($errors->has('worker_id'))
                        <h6 class="text-danger" >Selecione o nome do funcionário</h6> 
                    @endif
                </div>

                <div class="form-group">                   
                    <select name="accounting_id"  id="accounting_id" class="form-control">
                        <option value="" disabled selected>Selecione a conta...</option> 
                            @foreach($accountings as $accounting)
                                
                                <p>{{$accounting->id}}</p>
                                    <option value="{{$accounting->id}}" {{ $accounting->id == $product_apply->accounting_id ? 'selected' : ''}}>{{$accounting->name}} </option>
                                
                            @endforeach
                    </select>
                    @if($errors->has('accounting_id'))
                        <h6 class="text-danger" >Selecione o nome da Área de plantio</h6> 
                    @endif
                </div>

                <div class="form-group">                   
                    <select name="ground_id"  id="ground_id" class="form-control">
                        <option value="" disabled selected>Selecione a área...</option> 
                            @foreach($grounds as $ground)
                                
                                <p>{{$ground->id}}</p>
                                    <option value="{{$ground->id}}" {{ $ground->id == $product_apply->ground_id ? 'selected' : ''}}>{{$ground->name}} </option>
                                
                            @endforeach
                    </select>
                    @if($errors->has('ground_id'))
                        <h6 class="text-danger" >Selecione o nome da Área de plantio</h6> 
                    @endif
                </div>

               <!-- <div class="row"> -->
                <div class="form-group">
                    <label>Quantidade: </label>
                    <input type="number" class="floatNumberField form-control py-3"  name="amount"  value="{{old('amount') ?? $product_apply->amount}}" placeholder="0.00" step="0.01" >
                
                      @if($errors->has('amount'))
                          <h6 class="text-danger" >Digite a quantidade</h6> 
                      @endif
                  </div> 

            <!--
                  <div class="form-group col-sm-4">

                    <label for="note">Unidade</label>    
                        <input type="text" name="unity" value="{old('unity') ?? $product_apply->unity }}"  class="form-control">                            
                    </div>

                    <div class="form-group col-sm-4">
                        <label>Preço Unitário: </label>
                        <input type="number" class="floatNumberField form-control py-3"  name="price_unit"  value="{old('price_unit') ?? $product_apply->price_unit}}" placeholder="0.00" step="0.01" >
                          if($errors->has('price_unit'))
                              <h6 class="text-danger" >Digite a Preço Unitário</h6> 
                          endif
                    </div> 
                </div>

         
                -->

            <div class="form-group">

                <label for="note">Nota</label>    
                    <input type="longtext" name="note" value="{{old('note') ?? $product_apply->note }}" rows="4" class="form-control">                            
                </div>

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    
                    
                            <a href="{{ url('/product_apply') }}" class="float-right" >Voltar </a>
            
                        
                            
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


