<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-folder"></i> Modulo de Categorias</h2>
        </div>
        
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="categories"@if(kvfj($u->permissions,'categories'))
                checked @endif> <label for="categories"> Puede ver la lista de categorias.
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="categories_add"@if(kvfj($u->permissions,'categories_add'))
                checked @endif> <label for="categories_add"> Puede crear nuevas categorías .
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="categories_edit"@if(kvfj($u->permissions,'categories_edit'))
                checked @endif> <label for="categories_edit"> Puede editar categorías .
                </label>
            </div>

            {{-- <div class="form-check">
                <input type="checkbox" value="true" name="categories_delete"@if(kvfj($u->permissions,'categories_delete'))
                checked @endif> <label for="categories_delete"> Puede eliminar categorías .
                </label>
            </div> --}}
        </div>
    </div>
</div>
