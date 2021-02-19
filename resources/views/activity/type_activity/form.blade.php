
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$type_activity->id }}" class="form-control py-3">
 
            <div class="form-group">
                <label for="code">Código</label>
                <input type="text" name="code" value="{{old('code') ?? $type_activity->code }}" class="form-control">
                @if($errors->has('code'))
                        <h6 class="text-danger" >Digite o código</h6> 
                @endif
            </div>


            <div class="form-group">

                <label for="description">Descricao</label>
                <input type="text" name="description" value="{{old('description') ?? $type_activity->description }}" class="form-control">
                @if($errors->has('description'))
                        <h6 class="text-danger" >Digite a Descrição</h6> 
                @endif
            </div>

            <div class="form-group">
                <label for="in_uso" >Em uso (S / N)</label>
                <input type="text" name="in_uso" value="{{old('in_uso') ?? $type_activity->in_uso }}" class="form-control">
                @if($errors->has('in_uso'))
                        <h6 class="text-danger" >Escolha a opção S ou N</h6> 
                @endif
                </div>

            <div class="form-group">

                <label for="note">Observações</label>
                <textarea class="form-control" rows="3" placeholder="Observação..." name="note" > {{old('note') ?? $type_activity->note }} </textarea>
                   
            </div>


            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/home') }}" class="float-right" >Voltar </a> 
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


