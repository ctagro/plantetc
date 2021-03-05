
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$ground->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">



            <div class="form-group">

                <input type="text" name="name" value="{{old('name') ?? $ground->name }}" class="form-control" placeholder="Nome">
                @if($errors->has('name'))
                        <h6 class="text-danger" >Digite o Nome</h6> 
                @endif
            </div>

            <div class="form-group">
                <label>Área (ha): </label>
                <input type="number"  name="area" value="{{old('area') ?? $ground->area }}"  placeholder="0.00" step="0.01" >
                  @if($errors->has('area'))
                      <h6 class="text-danger" >Digite a Área</h6> 
                  @endif
              </div> 


            <div class="form-group">

                <input type="text" name="location" value="{{old('location') ?? $ground->location }}" class="form-control" placeholder="Localização">
                @if($errors->has('location'))
                        <h6 class="text-danger" >Digite a Localização</h6> 
                @endif
            </div>

                 
               <!-- Para ativar o uploud de imagens -->
               <div class="form-group">
                @if ($ground->image != null)
                    <img src="{{ asset('storage/grounds/'.$ground->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                @endif
                <label for="image">Imagem</label>
                <input type="file" class="form-control"  name='image' value='ground_avatar.png'>
            </div>
              
         

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/ground') }}" class="float-right" >Voltar </a> 
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


