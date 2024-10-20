<h1>Liste des messages</h1>
<?php
$email =  $_SESSION["admin"];
$query = $connect->prepare("SELECT * FROM messages WHERE message_to = '$email'");
$query->execute();
$num = $query->rowCount();

if ($num > 0) {
?>
  <div class="row">
    <?php

    while ($res = $query->fetch()) {
    ?>
      <div class="message">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-6 title">
              <h3>De: </h3>
              <?= $res["message_from"] ?>
            </div>
            <div class="col-lg-6 title">
              <h3>Sujet</h3>
              <?= $res["sujet"] ?>
            </div>
          </div>
          <div class="msg-contenu">
            <?= $res["message"] ?>
          </div>
        </div>
      </div>

    <?php
    }
    ?>
  </div>
<?php
} else {
  echo "<p>Pas de message jusqu'à maintenant.</p>";
}
