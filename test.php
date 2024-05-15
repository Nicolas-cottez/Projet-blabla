<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script><!--inclu tailwind-->
	<link rel="stylesheet" href="test.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /><!--inclu les fonts-->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
	<title>BlaBLA Omnes</title>
	<style>@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

body {
	font-family: 'Poppins', sans-serif;
	font-weight: 300;
	line-height: 1.7;
	color: #F5D742;
	/* background-color: #1f2029; */
	background-image: url("image/fondsign2.jpg");
	background-position: center;
	background-repeat: none;
}

a:hover {
	text-decoration: none;
}

.link {
	color: #F5D742;
}

.link:hover {
	color: #F5D742;
}

p {
	font-weight: 500;
	font-size: 14px;
}

h4 {
	font-weight: 600;
}

h6 span {
	padding: 0 20px;
	font-weight: 700;
}

.section {
	position: relative;
	width: 100%;
	display: block;
	
}

.full-height {
	min-height: 100vh;
}

[type="checkbox"]:checked,
[type="checkbox"]:not(:checked) {
	display: none;
}

.checkbox:checked+label,
.checkbox:not(:checked)+label {
	position: relative;
	display: block;
	text-align: center;
	width: 60px;
	height: 16px;
	border-radius: 8px;
	padding: 0;
	margin: 10px auto;
	cursor: pointer;
	background-color: #F5D742;
}

.checkbox:checked+label:before,
.checkbox:not(:checked)+label:before {
	position: absolute;
	display: block;
	width: 36px;
	height: 36px;
	border-radius: 50%;
	color: #F5D742;
	background-color: #020305;
	font-family: 'unicons';
	content: '\eb4f';
	z-index: 20;
	top: -10px;
	left: -10px;
	line-height: 36px;
	text-align: center;
	font-size: 24px;
	transition: all 0.5s ease;
}

.checkbox:checked+label:before {
	transform: translateX(44px) rotate(-270deg);
}

.card-3d-wrap {
	position: relative;
	width: 440px;
	max-width: 100%;
	height: 400px;
	perspective: 800px;
	margin-top: 60px;
}

.card-3d-wrapper {
	width: 100%;
	height: 100%;
	position: absolute;
	-webkit-transform-style: preserve-3d;
	transform-style: preserve-3d;
	transition: all 600ms ease-out;
}

.card-front,
.card-back {
	width: 100%;
	height: 120%;
	background-color: #F5D742;
	background-image: url('image/fond_patern_green.jpg');
	position: absolute;
	border-radius: 6px;
	-webkit-transform-style: preserve-3d;
}

.card-back {
	transform: rotateY(180deg);
}

.checkbox:checked~.card-3d-wrap .card-3d-wrapper {
	transform: rotateY(180deg);
}

.center-wrap {
	position: absolute;
	width: 100%;
	padding: 0 35px;
	top: 50%;
	left: 0;
	transform: translate3d(0, -50%, 35px);
	z-index: 20;
	display: block;
}
.form-group-row {
    display: flex;
    justify-content: space-between;
}
.form-group {
	position: relative;
	display: block;
	margin: 0 10px;
	padding: 0;
	flex: 1;
}

.form-style {
	padding: 13px 20px;
	padding-left: 55px;
	height: 48px;
	width: 100%;
	font-weight: 500;
	border-radius: 4px;
	font-size: 14px;
	line-height: 22px;
	letter-spacing: 0.5px;
	outline: none;
	color: #c4c3ca;
	background-color: #1f2029;
	border: none;
	box-shadow: 0 4px 8px 0 rgba(21, 21, 21, 0.2);
}

.form-style:focus,
.form-style:active {
	border: none;
	outline: none;
	box-shadow: 0 4px 8px 0 rgba(21, 21, 21, 0.2);
}

.input-icon {
	position: absolute;
	top: 0;
	left: 18px;
	height: 48px;
	font-size: 24px;
	line-height: 48px;
	text-align: left;
	transition: all 200ms linear;
}

.btn {
	border-radius: 4px;
	height: 44px;
	font-size: 13px;
	font-weight: 600;
	text-transform: uppercase;
	-webkit-transition: all 200ms linear;
	transition: all 200ms linear;
	padding: 0 30px;
	letter-spacing: 1px;
	display: -webkit-inline-flex;
	display: -ms-inline-flexbox;
	display: inline-flex;
	align-items: center;
	background-color: #F5D742;
	color: #000000;
}

.btn:hover {
	background-color: #000000;
	color: #F5D742;
	box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
}</style>
</head>

<body>
	<div class="section">
		<div class="mx-auto">
			<div class="full-height flex justify-center">
				<div class="text-center self-center">
					<div class="section pb-5 pt-5 pt-2 sm:pt-0 text-center">
						<h6 class="mb-0 pb-3"><span>Se Connecter</span><span>S'inscrire</span></h6>
						<input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
						<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-6 pb-4 font-medium text-3xl">Se Connecter</h4>
											<div class="form-group">
												<input type="email" class="form-style" placeholder="Email">
												<i class="input-icon uil uil-at"></i>
											</div>
											<div class="form-group mt-2">
												<input type="password" class="form-style" placeholder="Mot De Passe">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<a href="#" class="btn mt-4">Se Connecter</a>
											<p class="mb-0 mt-4 text-center"><a href="#" class="link">Mot de passe oublié?</a></p>
										</div>
									</div>
								</div>
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-3 pb-3 font-medium text-3xl">S'inscrire</h4>
											<div class="form-group-row">
												<div class="form-group">
													<input type="text" class="form-style" placeholder="Nom">
													<i class="input-icon uil uil-user"></i>
												</div>
												<div class="form-group">
													<input type="text" class="form-style" placeholder="Prénom">
													<i class="input-icon uil uil-user"></i>
												</div>
											</div>
											<div class="form-group mt-2">
												<input type="tel" class="form-style" placeholder="Numéro de Téléphone">
												<i class="input-icon uil uil-phone"></i>
											</div>
											<div class="form-group mt-2">
												<input type="email" class="form-style" placeholder="Email">
												<i class="input-icon uil uil-at"></i>
											</div>
											<div class="form-group mt-2">
												<input type="password" class="form-style" placeholder="Mot De Passe">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<div class="form-group mt-2">
												<input type="file" class="form-style" placeholder="Ajouter Une Photo">
												<i class="input-icon uil uil-upload"></i>
											</div>
											<a href="#" class="btn mt-4">S'inscrire</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>

</html>