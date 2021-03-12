
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$worker->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">



            <div class="form-group">

                <input type="text" name="name" value="{{old('name') ?? $worker->name }}" class="form-control" placeholder="Nome">
                @if($errors->has('name'))
                        <h6 class="text-danger" >Digite o Nome</h6> 
                @endif
            </div>

            <div class="form-group">

                @if(!Request::is('*/edit'))
                    <input type="hidden" name="date" value="{{$worker->date}}" class="form-control py-3">
                    <input type="date" name="date"  value="{{old('$date(d/m/y)') ?? $worker->date }}"  class="form-control py-3" placeholder="$data">
                    @if($errors->has('date'))
                            <h6 class="text-danger" >Digite a Admissão</h6> 
                    @endif
    
                @else
                    <?php $data = $worker->date?>
                <label for="date">Admissão : {{$data}}</label>
                    <input type="date" name="date" id ="date" value="{{old('$date(d/m/Y)') ?? $worker->date}}"  class="form-control py-3" placeholder="$data">             
                @endif
            </div>

            <div class="form-group">
                <label>Salario: </label>
                <input type="number"  name="salary" value="{{old('salary') ?? $worker->salary }}"  placeholder="0.00" step="0.01" >
                  @if($errors->has('salary'))
                      <h6 class="text-danger" >Digite o Salário</h6> 
                  @endif
              </div> 

              <div class="form-group">
                <label>Salario por hora: </label>
                <input type="number"  name="salary_hour" value="{{old('salary_hour') ?? $worker->salary_hour }}"  placeholder="0.00" step="0.01" >
                  @if($errors->has('salary_hour'))
                      <h6 class="text-danger" >Digite o Salário por hora</h6> 
                  @endif
              </div> 

        
               <!-- Para ativar o uploud de imagens -->
               <div class="form-group">
                @if ($worker->image != null)
                    <img src="{{ asset('storage/workers/'.$worker->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                @endif
                <label for="image">Imagem</label>
                <input type="file" class="form-control"  name='image' value='worker_avatar.png'>
            </div>
              
         

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/worker') }}" class="float-right" >Voltar </a> 
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


