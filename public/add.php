<div class="container">
    <?php if(isset($errors) && !empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach($errors as $error): ?>
                <?= $error; ?> </br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <h1>Ajouter un évènement</h1>
    <form action="" method="post" class="form">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Titre</label>
                    <input required id="name" type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input required id="date" type="date" class="form-control" name="date">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Démarrage</label>
                    <input required id="start" type="time" class="form-control" name="start" placeholder="HH:M">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input required id="end" type="time" class="form-control" name="end" placeholder="HH:M">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l'évènement</button>
        </div>
    </form>
    <?php if(isset($formFeedback)): ?>
    <div class="alert alert-primary" role="alert">
        <?= $formFeedback; ?>
    </div>
    <?php endif; ?>
</div>