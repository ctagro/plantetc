
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$active_principle->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">


            <div class="form-group">

                <input type="text" name="name" value="{{old('name') ?? $active_principle->name }}" class="form-control" placeholder="Nome">
                @if($errors->has('name'))
                        <h6 class="text-danger" >Digite o Nome</h6> 
                @endif
            </div>

            <div class="form-group col-sm-6 "> 
                <label for="category_pesticide_id">Categoria:</label>
                <select name="category_pesticide_id"  id="category_pesticide_id" class="form-control">
                  <option selected="selected" value=""></option>
                    @foreach($category_pesticides as $category_pesticide)    

                        <option value="{{$category_pesticide->id}}" {{ $category_pesticide->id == $active_principle->category_pesticide_id ? 'selected' : ''}}>{{$category_pesticide->name}} </option>                 
                    @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
                <label>Descrição: </label>
                <input type="text" name="description" value="{{old('description') ?? $active_principle->description }}" class="form-control" placeholder="Descrição">
                @if($errors->has('description'))
                        <h6 class="text-danger" >Digite a Descrição</h6> 
                @endif
            </div>

            <div class="form-group">
                <label>Principal uso: </label>
                <input type="text" name="main_uses" value="{{old('main_uses') ?? $active_principle->main_uses }}" class="form-control" placeholder="Preincipais usos">
                @if($errors->has('main_uses'))
                        <h6 class="text-danger" >Digite principal uso</h6> 
                @endif
            </div>

            <div class="form-group">
                <label>Observação: </label>
                <input type="text" name="note" value="{{old('note') ?? $active_principle->note }}" class="form-control" placeholder="Observações">
                @if($errors->has('note'))
                        <h6 class="text-danger" >Digite as observações</h6> 
                @endif
            </div>

            @if(!Request::is('*/edit'))
                    <input type="hidden" name="in_use" value="S" class="form-control py-3">
            @else
                    <div class="form-group">
                        <label>Ativo: {{$active_principle->in_use}} </label>
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
                        <a href="{{ url('/active_principle') }}" class="float-right" >Voltar </a> 
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


