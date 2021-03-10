

 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$activity->id }}" class="form-control py-3">


                <div class="form-group">

                    @if(!Request::is('*/edit'))
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">
                        <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $activity->date }}"  class="form-control py-3" placeholder="$data">
                        @if($errors->has('date'))
                                <h6 class="text-danger" >Digite a data</h6> 
                        @endif
        
                    @else
                        <?php $data = $activity->date ?>
                    <label for="date">Data : {{$data}}</label>
                        <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $activity->date}}"  class="form-control py-3" placeholder="$data">  
                        @if($errors->has('date'))
                        <h6 class="text-danger" >Digite a data</h6> 
                @endif           
                    @endif
        
                </div>
              
                <div class="form-group">
                        <select name="type_activity_id"  id="type_activity_id" class="form-control">
                        <option value="" disabled selected>Selecione a atividade...</option>
                        @foreach($type_activitys as $type_activity)

                          <option value="{{$type_activity->id}}" {{ $type_activity->id == $activity->type_activity_id ? 'selected' : ''}}>{{$type_activity->description}} </option> 
                            
                        @endforeach
                    </select>
                    @if($errors->has('type_activity_id'))
                        <h6 class="text-danger" >Selecione a Atividade</h6> 
                    @endif
                </div>

                <div class="form-group">
                    <select name="worker_id"  id="worker_id" class="form-control">
                        <option value="" disabled selected>Selecione o funcionário...</option>
                        @foreach($workers as $worker)
                                
                            <p>{{$worker->id}}</p>
                                <option value="{{$worker->id}}" {{ $worker->id == $activity->worker_id ? 'selected' : ''}}>{{$worker->name}} </option>
                                
                        @endforeach
                    </select>
                    @if($errors->has('worker_id'))
                        <h6 class="text-danger" >Selecione o nome do funcionário</h6> 
                    @endif
                </div>                

                <div class="form-group">                   
                    <select name="ground_id"  id="ground_id" class="form-control">
                        <option value="" disabled selected>Selecione a área...</option> 
                            @foreach($grounds as $ground)
                                
                                <p>{{$ground->id}}</p>
                                    <option value="{{$ground->id}}" {{ $ground->id == $activity->ground_id ? 'selected' : ''}}>{{$ground->name}} </option>
                                
                            @endforeach
                    </select>
                    @if($errors->has('ground_id'))
                        <h6 class="text-danger" >Selecione o nome da Área de plantio</h6> 
                    @endif
                </div>
                    
                <div class="form-group">
                    <select name="product_id"  id="product_id" class="form-control">
                        <option value="" disabled selected>Selecione (os) produto(s) utilizado(s)...</option>
                            @foreach($products as $product)
                                
                                <p>{{$product->id}}</p>
                                    <option value="{{$product->id}}" {{ $product->id == $activity->product_id ? 'selected' : ''}}>{{$product->name}} </option>
                                
                            @endforeach
                        </select>
                        @if($errors->has('product_id'))
                            <h6 class="text-danger" >Selecione o nome do(s) produto(s) usados</h6> 
                        @endif
                    </div>                

                </div>


{{-- Hora de inico e fim da atividade inabilitada
     Para habilitar: remover os inputs hidden abaixo e ativar os inputs desse comentario

                    <div class="form-group">
                        <label>Hora de início da atividade: </label>
                        <input type="time"  name="start_time" value="{{old('start_time') ?? $activity->start_time }}"  >
                          @if($errors->has('valor'))
                              <h6 class="text-danger" >Digite o horario do inicio</h6> 
                          @endif
                      </div> 

                      <div class="form-group">
                        <label>Hora de término da atividade: </label>
                        <input type="time"  name="final_time" value="{{old('final_time') ?? $activity->final_time }}"  >
                          @if($errors->has('valor'))
                              <h6 class="text-danger" >Digite o horario do inicio</h6> 
                          @endif
                      </div> 
--}}


                        <input type="hidden" name="start_time" value="00:00" class="form-control py-3">
                        <input type="hidden" name="final_time" value="00:00" class="form-control py-3">        


                      <div class="form-group">
                        <label>Tempo da atividade: </label>
                        <input type="number"  name="worked_hours" value="{{old('valor') ?? $activity->worked_hours }}"  placeholder="0.00" step="0.01" >
                          @if($errors->has('worked_hours'))
                              <h6 class="text-danger" >Digite tempo de atividade</h6> 
                          @endif
                      </div> 



            <div class="form-group">

                <label for="note">Observações</label>    
                    <input type="longtext" name="note" value="{{old('note') ?? $activity->note }}" rows="4" class="form-control">                            
                </div>

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/activity') }}" class="float-right" >Voltar </a> 
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


