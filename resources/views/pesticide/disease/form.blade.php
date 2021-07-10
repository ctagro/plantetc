
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$disease->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">

            <div class="form-group">
              <label>Nome vulgar: </label>
                <input type="text" name="name_vulgar" value="{{old('name_vulgar') ?? $disease->name_vulgar }}" class="form-control" placeholder="Nome vulgar">
                @if($errors->has('name_vulgar'))
                        <h6 class="text-danger" >Digite o Nome Nome vulgar</h6> 
                @endif
            </div>

            <div class="form-group">
              <label>Nome científico: </label>
              <input type="text" name="name_scientific" value="{{old('name_scientific') ?? $disease->name_scientific }}" class="form-control" placeholder="Nome científico">
              @if($errors->has('name_scientific'))
                      <h6 class="text-danger" >Digite o Nome Nome cientifico</h6> 
              @endif
            </div>

            <div class="form-group">
                  <label>Descrição: </label>
                      <input type="txt" name="description" value="{{old('description') ?? $disease->description }}" class="form-control py-3" placeholder="Descrição">
                      @if($errors->has('description'))
                        <h6 class="text-danger" >Digite as descrição</h6> 
                      @endif
            </div>

              <div class="form-group">
                <label>Sintomas: </label>
                    <input type="txt" name="symptoms" value="{{old('symptoms') ?? $disease->symptoms }}" class="form-control py-3" placeholder="Sintomas">
                    @if($errors->has('symptoms'))
                      <h6 class="text-danger" >Digite os sintomas</h6> 
                    @endif
                </div>

                <div class="form-group">
                  <label>Produtos indicados: </label>
                      <input type="txt" name="indicated_pesticide" value="{{old('indicated_pesticide') ?? $disease->indicated_pesticide }}" class="form-control py-3" placeholder="Produtos indicados">
                      @if($errors->has('indicated_pesticide'))
                        <h6 class="text-danger" >Digite os produtos indicados</h6> 
                      @endif
                </div>

                <div class="form-group">
                  <label>Controles: </label>
                      <input type="txt" name="control" value="{{old('control') ?? $disease->control }}" class="form-control py-3" placeholder="Controles">
                      @if($errors->has('control'))
                        <h6 class="text-danger" >Digite os controles</h6> 
                      @endif
                </div>
              </div>
            
        
               <!-- Para ativar o uploud de imagens -->
               <div class="form-group">
                @if ($disease->image != null)
                    <img src="{{ asset('storage/diseases/'.$disease->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                @endif
                    <label for="image">Imagem</label>
                    <input type="file" class="form-control"  name='image' value='disease_avatar.png'>
              </div>

            <div class="form-group">

              <label for="application">Observações</label>    
                  <input type="longtext" name="note" value="{{old('note') ?? $disease->note }}" rows="4" class="form-control">                            
          </div>
              

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/disease') }}" class="float-right" >Voltar </a> 
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


