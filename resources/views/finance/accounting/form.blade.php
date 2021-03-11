
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$accounting->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">



            <div class="form-group">

                <input type="text" name="name" value="{{old('name') ?? $accounting->name }}" class="form-control" placeholder="Nome">
                @if($errors->has('name'))
                        <h6 class="text-danger" >Digite o Nome</h6> 
                @endif
            </div>

            <div class="form-group">
                <label>Descrição: </label>
                    <input type="txt" name="description" value="{{old('description') ?? $accounting->description }}" class="form-control py-3" placeholder="Descrição">
                    @if($errors->has('description'))
                      <h6 class="text-danger" >Digite o Descrição</h6> 
                    @endif
              </div> 

              <div class="form-group">
                <label>Produto de venda: </label>
                <select name="sale"  id="sale" class="form-control">
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                  </select>
                @if($errors->has('sale'))
                    <h6 class="text-danger" >Escolha a opção</h6> 
                @endif
            </div>

        
               <!-- Para ativar o uploud de imagens -->
               <div class="form-group">
                @if ($accounting->image != null)
                    <img src="{{ asset('storage/accountings/'.$accounting->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                @endif
                <label for="image">Imagem</label>
                <input type="file" class="form-control"  name='image' value='accounting_avatar.png'>
            </div>
              
         

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/accounting') }}" class="float-right" >Voltar </a> 
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


