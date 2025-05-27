<div class="card container col-md-10 mt-5 mb-5" style="margin-top: 90px!important;">
  <div class="card-body">
    <div class="row mb-3">

        <h5 class="card-title col-md-8">Formulaire d'<?= isset($c) ? "edition" : "ajout" ?> cohorte</h5>
        <div class="col-md-4 text-end">
            <a href="?page=cohorte" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Retour</a>
        </div>
    </div>
    <?php require_once("views/includes/getmessage.php"); ?>
    <form class="" method="post">
        <div class="row">
            <div class="col-md-12">
 <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" value="<?= getInputData('nom', isset($c) ? $c : '') ?>" name="nom" id="form1Example1" class="form-control" />
                    <label class="form-label" for="form1Example1">Nom</label>
                </div>
            </div>
            
        </div>
        <?php if(isset($c)): ?>
            <button data-mdb-ripple-init name="modifier" type="submit" class="btn btn-warning">Modifier</button>
        <?php else: ?>
            <button data-mdb-ripple-init name="ajouter" type="submit" class="btn btn-success">Ajouter</button>
        <?php endif; ?>
    </form>
  </div>
</div>

<div class="card container col-md-10 mt-5 mb-5">
    <div class="card-body">
        <div class="row mb-3">

            <h5 class="card-title col-md-8">La liste des apprenants</h5>
            <div class="col-md-4 text-end">
                <button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#exampleModal">
                    Ajouter
                </button>
            </div>
        </div>

        <table class="table table-bordered align-middle mb-0 bg-white">
            <thead class="bg-light text-center">
                <tr>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Telephone</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php if(count($apprenants) > 0):?>
                    <?php foreach($apprenants as $apprenant):?>
                        <tr>
                            <td><?= $apprenant->prenom ?></td>
                            <td><?= $apprenant->nom ?></td>
                            <td><?= $apprenant->tel ?></td>
                            <td>
                                <a href="?page=cohorte&type=edit&id=<?= $_GET['id']?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="?page=cohorte&type=edit&id=<?= $_GET['id']?>&deleteAp=<?= $apprenant->id ?>" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#deleteModal<?= $apprenant->id ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>

                            <div class="modal fade" id="deleteModal<?= $apprenant->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                        <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer cet apprenant?	
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-mdb-ripple-init data-mdb-dismiss="modal">Non</button>
                                        <a href="?page=cohorte&type=edit&id=<?= $_GET['id']?>&deleteAp=<?= $apprenant->id ?>" class="btn btn-success" data-mdb-ripple-init>Oui</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td colspan="4">Aucun apprenant enregistré</td>
                    </tr>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once("views/cohorte/addapprenant.php"); ?>


