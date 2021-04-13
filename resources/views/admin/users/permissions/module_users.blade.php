<div class="col-md-4">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-user-friends"></i> Modulos de Usuarios</h2>
        </div>

        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="user_list"@if(kvfj($u->permissions,'user_list'))
                checked @endif> <label for="user_list"> Puede ver la lista de usuarios registrados.
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="user_edit"@if(kvfj($u->permissions,'user_edit'))
                checked @endif> <label for="user_edit"> Puede editar usuario.
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="user_banned"@if(kvfj($u->permissions,'user_banned'))
                checked @endif> <label for="user_banned"> Puede banear usuario.
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="user_permissions"@if(kvfj($u->permissions,'user_permissions'))
                checked @endif> <label for="user_permissions"> Puede administrar permisos de usuario.
                </label>
            </div>
        </div>
    </div>
</div>
