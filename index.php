<!DOCTYPE html>
<html>
<head>
	<title>Projeto mensagem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="index.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body class="container">


<?php
try {
	$pdo = new PDO("mysql:dbname=projeto_comentarios;host=localhost", "root", "");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

if(isset($_POST['nome']) && empty($_POST['nome']) == false) {
	$nome = $_POST['nome'];
	$mensagem = $_POST['mensagem'];

	$sql = $pdo->prepare("INSERT INTO mensagens SET nome = :nome, msg = :msg, data_msg = NOW()");
	$sql->bindValue(":nome", $nome);
	$sql->bindValue(":msg", $mensagem);
	$sql->execute();
}
?>
<div class="row" id="body">

	<div class="col-sm-8">
		<h1 class="titulo">Projeto mensagem!</h1>
		<form method="POST" class="form-control" id="form">


			<div class="input-group" id="nome">
			<span class="input-group-addon" id="basic-addon1">Nome</span><br/>
			<input  class="form-control" type="text" name="nome"  /><br/><br/>
			</div>

			<div class="input-group" id="msg">
					<span class="input-group-addon" id="basic-addon1">Mensagem</span><br/>
					<textarea class="form-control" name="mensagem"></textarea><br/><br/>
			</div>
			<input id="btn" class="btn btn-primary" type="submit" value="Enviar Mensagem" />
		</form>
	</div>
	<div class="col-sm-4" id="caixa">


<?php
$sql = "SELECT * FROM mensagens ORDER BY data_msg DESC";
$sql = $pdo->query($sql);
if($sql->rowCount() > 0){
	foreach($sql->fetchAll() as $mensagem):
		?>
		
			<h6 class="title">
				<?php echo $mensagem['nome']; ?>		
			</h6>
			<div class="msg">
				<?php echo $mensagem['msg']; ?>
			</div>
	
		<?php
	endforeach;
} else {
	echo "Não há mensagens.";
}
?>
	</div>
</div>

</body>
</html>











