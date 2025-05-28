<div class="card container col-md-10 mt-5 mb-5">
  <div class="card-body">
    <div class="row mb-3">

        <h5 class="card-title col-md-8">Formulaire d'<?= isset($c) ? "edition" : "ajout" ?> Participant</h5>
        <div class="col-md-4 text-end">
            <a href="?page=challenge&type=edit&id=<?= $_GET["id"] ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i> Retour</a>
        </div>
    </div>
    <?php require_once("views/includes/getmessage.php"); ?>
    <form class="" method="post">
        <div class="row">
            
            <div class="col-md-8">
           
                <div data-mdb-input-init class="form-group mb-4">
                    <label  for="inlineFormSelectPref">Apprenant</label>
                    <select data-mdb-select-init name="apprenant_id" class="form-control select">
                        <option value="">Veuillez choisir l'apprenant</option>    
                        <?php foreach($apprenants as $a): ?>
                            <option value="<?= $a->id ?>"><?= $a->prenom ?> <?= $a->nom ?> (<?= $a->nomcohorte ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <?php if(isset($p)): ?>
                    <button data-mdb-ripple-init name="modifier" type="submit" class="btn btn-warning mt-4">Modifier</button>
                <?php else: ?>
                    <button data-mdb-ripple-init name="ajouterParticipant" type="submit" class="btn btn-success mt-4">Ajouter</button>
                <?php endif; ?>
            </div>
        </div>
    </form>
  </div>
</div>

