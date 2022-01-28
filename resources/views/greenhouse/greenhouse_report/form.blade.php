
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$greenhouse_report->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">

            <div class="form-group">

                @if(!Request::is('*/edit'))
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">
                    <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $greenhouse_report->date }}"  class="form-control py-3" placeholder="$data">
                    @if($errors->has('date'))
                            <h6 class="text-danger" >Digite a data</h6> 
                    @endif
    
                @else
                    <?php $data = $greenhouse_report->date ?>
                <label for="date">Data : {{$data}}</label>
                    <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $greenhouse_report->date}}"  class="form-control py-3" placeholder="$data">  
                    @if($errors->has('date'))
                    <h6 class="text-danger" >Digite a data</h6> 
            @endif           
                @endif
    
            </div>


            <div class="form-group">                   
                <select name="worker_id"  id="worker_id" class="form-control">
                    <option value="" disabled selected>Selecione o funcionário...</option> 
                        @foreach($workers as $worker)
                            
                            <p>{{$worker->id}}</p>
                                <option value="{{$worker->id}}" {{ $worker->id == $greenhouse_report->worker_id ? 'selected' : ''}}>{{$worker->name}} </option>
                            
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
                                <option value="{{$ground->id}}" {{ $ground->id == $greenhouse_report->ground_id ? 'selected' : ''}}>{{$ground->name}} </option>
                            
                        @endforeach
                </select>
                @if($errors->has('ground_id'))
                    <h6 class="text-danger" >Selecione o nome da Área de plantio</h6> 
                @endif
            </div>


            <div class="form-group">     
                
                <label for="note">Observações</label>
         
        <!-- O Ckeditor parece que nao esta funcionando 
                 <div id="dvCenter">
                    <form method="post" name="frmArtigo">

        -->
                    <textarea  id="note" name="note"  rows="4" class="form-control text-left">                                        
                        {{$greenhouse_report->note}}
                    </textarea>
 
 <!--                   <input type="submit" value="Cadastrar" name="btnSubmit" />
			</form>	
                 </div>

                -->
        
                 
               <!-- Para ativar o uploud de imagens -->
               <div class="form-group">
                @if ($greenhouse_report->image != null)
                    <img src="{{ asset('storage/greenhouse_reports/'.$greenhouse_report->image)}}" class="img-thumbnail elevation-2"  style="max-width: 100px;"> 
                @endif
                <label for="image">Imagem</label>
                <input type="file" class="form-control"  name='image' value='greenhouse_report_avatar.png'>
            </div>
              
         

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/greenhouse_report') }}" class="float-right" >Voltar </a> 
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

<!-- cKeditor5  parece que nao esta funcionando --->
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('teste');
</script>
<!-- page script -->


