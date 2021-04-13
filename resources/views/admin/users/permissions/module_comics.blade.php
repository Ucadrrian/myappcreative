<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-book-open"></i> Modulo de Comics</h2>
        </div>
        <div class="inside">
            <div class="form-check">
                <input type="checkbox" value="true" name="comics"@if(kvfj($u->permissions,'comics'))
                checked @endif> <label for="comics"> Puede ver el listado de Comics.
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="comic_add"@if(kvfj($u->permissions,'comic_add'))
                checked @endif> <label for="comic_add"> Puede agregar nuevos Comics.
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="comic_edit"@if(kvfj($u->permissions,'comic_edit'))
                checked @endif> <label for="comic_edit"> Puede editar Comics.
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="comic_delete"@if(kvfj($u->permissions,'comic_delete'))
                checked @endif> <label for="comic_delete">Puede eliminar Comics
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="comic_gallery_add"@if(kvfj($u->permissions,'comic_gallery_add'))
                checked @endif> <label for="comic_gallery_add">Puede agregar galeria de imagenes
                </label>
            </div>

            <div class="form-check">
                <input type="checkbox" value="true" name="comic_gallery_delete"@if(kvfj($u->permissions,'comic_gallery_delete'))
                checked @endif> <label for="comic_gallery_delete">Puede eliminar galeria de imagenes
                </label>
            </div>

        </div>
    </div>

</div>
