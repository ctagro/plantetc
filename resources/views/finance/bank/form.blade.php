
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$bank->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">



            <div class="form-group">

                <label for="name">Tipo de documento</label>
                <input type="text" name="name" value="{{old('name') ?? $bank->name }}" class="form-control">
                @if($errors->has('name'))
                        <h6 class="text-danger" >Digite a tipo de documento</h6> 
                @endif
            </div>

            <div class="form-group">

                <label for="note">Descrição</label>    
                    <input type="longtext" name="note" value="{{old('note') ?? $bank->note }}" rows="4" class="form-control">                            
                </div>

            @if(!Request::is('*/edit'))
                <input type="hidden" name="in_use" value="S" class="form-control py-3">
            @else
                <div class="form-group">
                    <label>Ativo (S/N): {{$bank->in_use}} </label>
                    <select name="in_use"  id="in_use" class="form-control">
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                    </select>
                    @if($errors->has('in_use'))
                        <h6 class="text-danger" >Escolha a opção</h6> 
                    @endif
                </div>
            @endif
         

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/bank') }}" class="float-right" >Voltar </a> 
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


