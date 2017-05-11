<div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formulaire d'ajout d'un sujet</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="ajoutS-name">Ajouter un nom :</label>
            <input type="text" id="ajoutS-name">
        </div>
        <?php 
          echo "<div class='form-group'>
            <label for='ajoutS-tag'>Ajouter un tag :</label>
            <select id='ajoutS-tag'>
              <option value=''>----</option>";
              if(!isset($tags))
                $tags = allTags();
              if($tags != false){
                foreach ($tags as $tag) {
                  echo "<option value='$tag->tag_id'>$tag->name</option>";
                }
              }
          echo "</select></div>";
        ?>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" id='ajoutS-btn'>Ajouter</button>
      </div>
    </div>
  </div>
</div>

<input type="text" id="user_id_modal" value="<?php if(isset($_SESSION['connected'])) echo $_SESSION['id_user']; ?>" hidden>