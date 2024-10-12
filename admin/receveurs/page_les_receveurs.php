<?php
require '../utilisateurs/ma_session.php';

require '../connexion.php';
include '../sheard/head.php';
include '../menu.php';

$requete = "SELECT r.*, COALESCE(SUM(a.nbreB), 0) AS nbr_total_de_boeux 
				FROM receveurs r LEFT JOIN avoir a ON r.id = a.id_re 
				GROUP BY r.id 
				ORDER BY r.id DESC";
$result = $pdo->query($requete);
$tous_les_receveurs = $result->fetchAll();
?>

<br><br><br><br>
<div class="container">

    <h1 class="text-center"> Liste des receveurs </h1>
    <div class="panel panel-primary">
        <div class="panel-heading">Rechecher les receveurs</div>
        <div class="panel-body">
            <form class="form-inline" method="post">
                <input type="text" name="q" id="q" class="form-control lg"
                    placeholder="Recherche par nom">

                <button type="" name="" class="btn btn-primary">
                    <span class="fa fa-search"></span>
                </button>
            </form>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">N°</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Sexe</th>
                <th class="text-center">Localité des receveurs</th>
                <th class="text-center">Total des boeux réçu</th>
                <?php if($_SESSION['user']['role']=="Administrateur"){?>
                <th class="text-center"> Action</th>
                <?php } ?>
            </tr>
        </thead>

        <tbody id="tbody" class="text-center">

            <?php foreach($tous_les_receveurs as $le_receveur){	?>
            <tr>
                <td><?= $i += 1 ?></td>
                <td><?= $le_receveur['nomRe'] ?></td>
                <td><?= $le_receveur['sexeR'] ?></td>
                <td><?= $le_receveur['localite'] ?></td>
                <td><?= $le_receveur['nbr_total_de_boeux'] ?></td>
                <?php if($_SESSION['user']['role']=="Administrateur"){?>
                <td>
                    <a href="page_edit_receveur.php?id=<?= $le_receveur['id'] ?>"
                        class="btn btn-success btn-edit-delete"><span class="fa fa-edit"></span>
                    </a>

                    <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ?')"
                        href="delete_receveur.php?id=<?= $le_receveur['id'] ?>" class="btn btn-danger btn-edit-delete"><span
                            class="fa fa-trash"></span>
                    </a>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="error"></div>
    <?php if($_SESSION['user']['role']=='Administrateur'){  ?>
    <a href="page_add_receveur.php" class="btn btn-primary">
        <span class="fa fa-plus"></span> NOUVEAU RECEVEUR
    </a>
    <?php } ?>
</div>

<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/script.js"></script>
<script>
    $(document).ready(function() {
        var champRecherche = $('#q');
        var tableBody = $('#tbody');
        var error = $('.error');

        champRecherche.on('input', function() {
            var recherche = champRecherche.val();

            $.ajax({
                url: '../page_recherche.php',
                type: 'POST',
                data: {
                    q_r: recherche
                },
                dataType: 'json',
                success: function(data) {
                    tableBody.empty();
                    error.empty();

                    if (data.length > 0) {
                        $.each(data, function(index, resultat) {
                            var row = `
									<tr>
										<td>${index + 1}</td>
										<td>${resultat.nomRe}</td>
										<td>${resultat.sexeR}</td>
										<td>${resultat.localite}</td>
										<td>${resultat.nbr_total_de_boeux}</td>
										<?php if($_SESSION['user']['role']=="Administrateur"){?>
											<td>
												<a href="page_edit_receveur.php?id=${resultat.id}"
												class="btn btn-success btn-edit-delete"> 
													<span class="fa fa-edit"></span>
												</a>
												&nbsp&nbsp
												<a onclick='return confirm("Etes-vous sûr de vouloir supprimer ?")'
														href="delete_receveur.php?id=${resultat.id}"
														class="btn btn-danger btn-edit-delete">
													<span class="fa fa-trash"></span>
												</a>
											
											</td>
										<?php } ?>
									</tr>
								`;
                            tableBody.append(row);
                        });
                    } else {
                        error.append(("<h2>Aucun résultat trouvé.</h2>"));
                    }
                }
            });
        });
    });
</script>
</body>

</html>
