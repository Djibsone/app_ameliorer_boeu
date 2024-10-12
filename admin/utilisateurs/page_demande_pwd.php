<?php include '../sheard/head.php'; ?>
<div class="container col-md-6 col-md-offset-3">
    <br><br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <a href="javascript:history.back()" style="text-decoration: none; color: inherit;">
                <i class="fa fa-arrow-left" style="cursor: pointer; margin-right: 10px;"></i>
            </a>
            Initiliser votre mot de passe
        </div>
        <div class="panel-body">

            <form method="post" action="initialise_pwd.php" class="form">

                <div class="form-group">
                    <label for="email" class="control-label">
                        Veuillez saisir votre Email de récuperation
                    </label>

                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Initialiser le mot de passe
                </button>

            </form>
        </div>
    </div>
</div>
</body>

</html>
