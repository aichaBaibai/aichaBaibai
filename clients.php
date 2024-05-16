<!--?php require('session.php');
 confirm_logged_in();-->
 <?php
// Connexion à la base de données
$conn = mysqli_connect('localhost', 'pfe', 'HajarAichaMonsif', 'glogistique');
if (!$conn) {
    die(mysqli_error($conn));
}

//******* Recuperation des donnees de la table
$sql = "SELECT * FROM clients";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die(mysqli_error($conn));
}
//****** Desactiver les bouttons *********************
/*if (isset($_SESSION['UtiType'])) {
  $util=$_SESSION['UtiType'];
  
  if($util=="Enseignant")
  {
     $cursorAdd='default';
     $pointer_eventsAdd='none';
     $text_decorationAdd='none';
  } 
}*/

//--------------------------------DELETE------------------------------------------------------------------


// Suppression d'une ligne si l'ID est spécifié dans l'URL

if (isset($_GET['delete_id'])) 
{
    $id = $_GET['delete_id'];

    $sql = "DELETE FROM clients WHERE ID_client=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('La ligne a été supprimée avec succès.')</script>";
    } else {
        echo "<script>alert('Erreur lors de la suppression de la ligne : " . $conn->error . "')</script>";
    }
}

// Récupération des données de la table
$sql = "SELECT * FROM clients";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die(mysqli_error($conn));
}
/*******

$conn = new mysqli('localhost', 'pfe', 'HajarAichaMonsif', 'gstck');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);


    
}
*/
//------------------------Ajouter à la base de données--------------------------------------------------

if (isset($_POST['valider'])) {
 
  $ID_client = $_POST['ID_client'];
  $Nom = $_POST['Nom'];
  $Adresse = $_POST['Adresse'];
  $Contact=$_POST['Contact'];
 
  $sql = "INSERT INTO clients (ID_client,Nom,Adresse,Contact) 
          VALUES ('$ID_client','$Nom', '$Adresse', '$Contact')";
 
  if ($conn->query($sql) === TRUE) {
      $affected_rows = $conn->affected_rows;
      echo "<script>alert('Ligne inséré avec succé. Rows affected: $affected_rows')</script>";
      header("location: clients.php");
  } else {
      echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "')</script>";}
      
  }
  
/*******/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Clients</title>
    <link rel="stylesheet" href="bootstrap11.css">
    <link rel="icon" href="" type="image/x-icon">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>





    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-0zSxftwnNTfMwYc0b+hGrDT4xmQq3sFOlQKcJQu9l+Ogo99z1My+b/aYClCpO7JGtH+pw/pMIv1CKg5fBg7X/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/7e5a5bb997.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-0zSxftwnNTfMwYc0b+hGrDT4xmQq3sFOlQKcJQu9l+Ogo99z1My+b/aYClCpO7JGtH+pw/pMIv1CKg5fBg7X/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
    
<style>
#add_button{
    pointer-events:<?php echo $pointer_eventsAdd; ?>;
    text-decoration:<?php echo $text_decorationAdd; ?>;
}
</style>
</head>
<body>


<!-- Modal aad-->
<div class="modal" id="add_button" tabindex="-1" aria-labelledby="addbuttonLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form method="post" action="clients.php">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addbuttonLabel">Ajouter un Client</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <div class="modal-body">
        <div class="form-group">
        <label>Code Produit</label>
          <input type="text"  placeholder="Code Produit" id="CodeProduit" name="code_produit" class="form-control input-xs parsley-error" required="required">
        </div>
        
          
        </div>     

        <div class="form-group">
          <label>Nom</label>
          <input type="text" pattern="[A-Za-zàâçéèêëîïìôöùûüÿĀāĒēĪīŌōŪūǖŶŷ]+" placeholder="Nom" id="Nom" name="Nom" class="form-control input-xs parsley-error" required="required">
        </div>
        <div class="form-group">
          <label>Adresse</label>
          <input type="text"  placeholder="Description" id="Description" name="Description" class="form-control input-xs parsley-error" >
        </div>
        <div class="form-group">
          <label>Contact</label>
          <input type="number"  placeholder="Contact" id="Contact" name="Contact" class="form-control input-xs parsley-error" required="required">
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary" name="valider">Enregistrer</button>
      </div>
     
    </div>
    </form>
  </div>
</div>
<!-- Modal aadd -->


<div class="container" style="margin-top:30px">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-9">Liste des Clients</div>
        <div class="col-md-3" align="right">

        
			<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_button" >
  Ajouter
</button>
        </div>
      </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="client_table">
                <thead>
                    <tr>
                        <th> ID Client</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Contact </th>
                        <th name="edit">Modifier</th>
                        <th>Spprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['ID_client']; ?></td>
                            <td><?php echo $row['Nom']; ?></td>
                            <td><?php echo $row['Adresse']; ?></td>
                             <td><?php echo $row['Contact']; ?></td>
                             
                            <td align="center"> <button id="add_button" class="btn btn-primary" name="modifier">
                                <a href="updateclie.php?id=<?php echo $row['ID_client'];?>" class="text-light">Modifier</a></button></td>
							<td align="center"><button id="add_button"  class="btn btn-danger" >
                            <a href="?delete_id=<?php echo $row['ID_client']; ?>" class="text-light" id="<?php echo $row['ID_client']; ?>" 
                             onclick="return confirm('Êtes vous sûr de vouloir supprimer cette client ?')">Supprimer</a></button></td>
                        </tr>  
                    <?php } ?>
                </tbody>
            </table><br>
        
        </div>
    </div>
  </div>
  <button type="button" id="report_button" class="btn btn-danger btn-sm"><a href="dashboard.php" style="text-decoration:none; color:white; font-weight:bold; " > Retour à l'acceuil</a></button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
  $('#client_table').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/9dcb"}})})
</script>

