<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nuevo usuario</title>
		<link href="<?= base_url('css/style.css');?>" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-grid-only@1.0.0/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
	</head>
	<body>
		<div class="container ">
			<div class="navbar navbar-inverse navbar "></div>
		hola
		
		<!-- <div class="row"> -->
				<!-- <div class="col-lg-10">
					  form_open('usuario/save');?

					 
						function validate(string $key) {
							if (session('_ci_validation_errors')) {
								$value = unserialize(session('_ci_validation_errors'));
								if (isset($value[$key])){
									return $value[$key];
								}
							}
						} 
					

					<div class="card">
						<div class="head">
							<h1>Nuevo usuario</h1>
							<a class="back" href="= base_url('usuarios');">volver</a>
						</div>
						<div class="col-lg-6">
							<div class="f-group">
								<label>Nombre</label>
								<input class="= validate("name") ? 'is-invalid' : null;" type="text" name="name" placeholder="p.ej. Mateo" value="<?= old('name');?>">
								<div class="invalid">= validate("name")></div>
							</div>
							<div class="f-group">
								<label>Email</label>
								<input class="?= validate("email") ? 'is-invalid' : null;?" type="text" name="email" placeholder="p.ej. mateo@gmail.com" value="<?= old('email');?>">
								<div class="invalid">= validate("email");</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="f-group">
								<label>Biografía</label>
								<textarea class="?= validate("biography") ? 'is-invalid' : null;?>" name="biography" placeholder="Di algunas palabras sobre quién eres."><?= old('biography');?></textarea>
								<div class="invalid">?= validate("biography");?></div>
							</div>
							<div class="text-end">
								<button type="submit">guardar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</body>
</html>