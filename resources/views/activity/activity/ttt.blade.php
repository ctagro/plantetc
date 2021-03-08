Accounting (conta) :
- incluir accounting_id na migrate da tabela activities
$table->unsignedBigInteger('accounting_id')->nullable();

- No Model: Account.php

use App\Models\Accounting;

- no fillable:

'accounting_id'             ,    

- no storeAccount

'accounting_id'             => $data['accounting_id'],

- No final

public function accounting()
   {
       return $this->belongsTo(accounting::class);
   }

-- no Controller, AccountController:

use App\Models\Accounting;

no create e edit: 
$accountings = auth()->user()->accounting()->get();

return view('account.account.create',compact('account','accounts','type_accounts','workers','accountings'));

no update:

$data['accounting_id']             = $dataRequest['accounting_id'];

no validateRequest()

'accounting_id'              =>   'required',


- Na view form: Account

<div class="form-group">
                       <label for="accounting_id">Funcionário</label>  
                       <select name="accounting_id"  id="accounting_id" class="form-control">
                       <option value="" disabled selected>Selecione a conta...</option> 
                               @foreach($accountings as $accounting)
                                   
                                   <p>{{$accounting->id}}</p>
                                       <option value="{{$accounting->id}}" {{ $accounting->id == $account->accounting_id ? 'selected' : ''}}>{{$accounting->name}} </option>
                                   
                               @endforeach
                           </select>
                           @if($errors->has('accounting_id'))
                               <h6 class="text-danger" >Digite o nome da Área de plantio</h6> 
                           @endif
                       </div>

- Na view index incluir:

<th>Área</th>


<td>
                           <a href= "{{ route('account.edit' ,[ 'account' => $account->id ])}}" >{{ $account->accounting->name}}</a>
                         </td>

Na view show, incluir:

<div class="row">
         <div class="form-control">{{ $account->accounting->name}</div>
       </div>

- Ajustar a seed com 1 e 2 para accounting

'accounting_id'                 => 1,
