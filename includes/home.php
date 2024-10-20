<?php

echo "<h1>Dashboard</h1>";
$query1 = $connect->prepare("SELECT * FROM users WHERE priority = 0");
$query1->execute();
$query2 = $connect->prepare("SELECT * FROM commande WHERE commande_payed = 1");
$query2->execute();
$res = $query2->fetch();
$rowCount = $query2->rowCount();
$sum = 0;
if ($rowCount > 0) {
  $foodid = json_decode($res["food_id"], true);
  foreach ($foodid as $id) {
    $query = $connect->prepare("SELECT food_price FROM food WHERE food_id = $id");
    $query->execute();
    $sum += $query->fetch()[0];
    // $query3 = $connect->prepare("SELECT * FROM food WHERE food_id = $tab[2]");
    // $query3->execute();
    // $sum += $query3->fetch()[2];
  }
} else {
  $sum = 0;
}

?>
<div class="statics">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-4">
        <div class="static-item">
          <h1><?php echo $sum; ?> TND</h1>
          <span>Gains Totales</span>
          <i class="fi fi-tr-usd-circle"></i>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="static-item">
          <h1><?php echo $query2->rowCount(); ?></h1>
          <span>Commande Totales</span>
          <i class="fi fi-tr-cart-shopping-fast"></i>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="static-item">
          <h1><?php echo $query1->rowCount(); ?></h1>
          <span>Utilisateurs Totales</span>
          <i class="fi fi-tr-circle-user"></i>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div id="main1" style="width: 100%;height:400px;"></div>
      </div>
      <div class="col-lg-4">
        <div id="main2" style="width: 100%;height:400px;"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div id="wrapper1"></div>
      </div>
      <div class="col-lg-6">
        <div id="wrapper2"></div>
      </div>
    </div>

  </div>
</div>