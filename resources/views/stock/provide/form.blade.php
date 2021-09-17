
 
 
 <div class='table-responsive'>

            <input type="hidden" name="id" value="{{$provide->id }}" class="form-control py-3">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" class="form-control py-3">

            <div class="form-group">

                <label for="name">Nome</label>
                <input type="text" name="name" value="{{old('name') ?? $provide->name }}" class="form-control">
                @if($errors->has('name'))
                        <h6 class="text-danger" >Digite a Nome</h6> 
                @endif
            </div>

            <div class="form-group">

                <label for="adress">Endereço</label>
                <input type="text" name="adress" value="{{old('adress') ?? $provide->adress }}" class="form-control">
                @if($errors->has('adress'))
                        <h6 class="text-danger" >Digite a endereço</h6> 
                @endif
            </div>


            <div class="form-group">

                <label for="adress">Cidade</label>
                <input type="text" name="city" value="{{old('city') ?? $provide->city }}" class="form-control">
                @if($errors->has('city'))
                        <h6 class="text-danger" >Digite a cidade</h6> 
                @endif
            </div>

            <div class="form-group">

                <label for="adress">Estado</label>
                <input type="text" name="province" value="{{old('province') ?? $provide->province }}" class="form-control">
                @if($errors->has('province'))
                        <h6 class="text-danger" >Digite a estado</h6> 
                @endif
            </div>

            <div class="form-group">

                <label for="adress">Telefone</label>
                <input type="text" name="phone" value="{{old('phone') ?? $provide->phone }}" class="form-control">
                @if($errors->has('phone'))
                        <h6 class="text-danger" >Digite a telefone</h6> 
                @endif
            </div>


            <div class="form-group">

                <label for="adress">Vendedor(es)</label>
                <input type="text" name="salesman" value="{{old('salesman') ?? $provide->salesman }}" class="form-control">
                @if($errors->has('salesman'))
                        <h6 class="text-danger" >Digite os vendedor(es)</h6> 
                @endif
            </div>

            <div class="form-group">

                <label for="note">Observações</label>    
                    <input type="longtext" name="note" value="{{old('note') ?? $provide->note }}" rows="4" class="form-control">                            
                </div>

            @if(!Request::is('*/edit'))
                <input type="hidden" name="in_use" value="S" class="form-control py-3">
            @else
                <div class="form-group">
                    <label>Ativo (S/N): {{$provide->in_use}} </label>
                    <select name="in_use"  id="in_use" class="form-control">
                        <option value="S">Sim</option>
                        <option value="N">Não</option>
                    </select>
                    @if($errors->has('in_use'))
                        <h6 class="text-danger" >Escolha a opção</h6> 
                    @endif
                </div>
            @endif


               <!-- Para ativar o uploud de imagens -->

               <div class="form-group">
                @if ($provide->image != null)
                    <img src="{{ asset('storage/provides/'.$provide->image)}}" class="img-thumbnail elevation-2"  style="max-width: 50px;"> 
                @endif
                <label for="image">Imagem</label>
                <input type="file" class="form-control"  name='image' value='provide_avatar.png'>
            </div>

         

            @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                        <a href="{{ url('/provide') }}" class="float-right" >Voltar </a> 
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


