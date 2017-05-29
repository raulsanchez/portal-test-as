<div class="modal fade modal" id="Mroles" tabindex="-1" role="dialog" aria-labelledby="Roles">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
          <h4 class="modal-title">Roles</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" value="" id="LMroles">
            <select multiple="multiple" id="select-roles">
            @if ( isset($roles))
                @foreach ($roles as $id => $role)
                    <option value="{{ $role['id'] }}">
                        {{ $role['display_name'] }}
                    </option>
                @endforeach
            @endif
            </select>
        </div>
    </div>
  </div>
</div>