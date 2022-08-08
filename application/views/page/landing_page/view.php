<!DOCTYPE html>
<html lang="en">

<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- bootstrap 4 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- favicon -->
	<link rel="icon" href="<?php echo base_url('assets/img/adeeva-circle.png') ?>" type="image/gif" sizes="16x16">

	<style>
		/* Make the image fully responsive */
		.carousel-inner img {
			width: 100%;
			height: 500px;
		}

		.carousel-inner {
			width: 100%;
			object-fit: cover;
			background-position: center center;
			height: 500px;
			margin-bottom: 30px;
		}

		img.img-responsive {
			background-size: cover;
		}

		.lead {
			font-size: 1.25rem;
			font-weight: 500 !important;
			color: #fff;
		}

		.bg-adeeva {
			background-color: #fff !important;
		}

		.color-adeeva {
			color: #3e909b !important;
		}

		.nav-link{
			color: #3e909b !important;
		}

		.navbar-toggler {
			background-color: rgba(51,116,125,.5)!important;
		}

		@media (min-width: 376px) and (max-width: 425px) {
			.carousel-inner img {
				height: 330px;
				
			}

			.carousel-inner {
				height: 100%;
			}
		}

		@media (min-width: 320px) and (max-width: 375px) {
			.carousel-inner img {
				height: 200px;
			}

			.carousel-inner {
				height: 100%;
			}
		}



		/* Footer */
		@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

		section {
			padding: 5px 0;
		}

		section .section-title {
			text-align: center;
			color: #007b5e;
			margin-bottom: 50px;
			text-transform: uppercase;
		}

		#footer {
			background: #3E909B !important;
		}

		#footer h5 {
			padding-left: 10px;
			border-left: 3px solid #eeeeee;
			padding-bottom: 6px;
			margin-bottom: 20px;
			color: #ffffff;
		}

		#footer a {
			color: #ffffff;
			text-decoration: none !important;
			background-color: transparent;
			-webkit-text-decoration-skip: objects;
		}

		#footer ul.social li {
			padding: 3px 0;
		}

		#footer ul.social li a i {
			margin-right: 5px;
			font-size: 25px;
			-webkit-transition: .5s all ease;
			-moz-transition: .5s all ease;
			transition: .5s all ease;
		}

		#footer ul.social li:hover a i {
			font-size: 30px;
			margin-top: -10px;
		}

		#footer ul.social li a,
		#footer ul.quick-links li a {
			color: #ffffff;
		}

		#footer ul.social li a:hover {
			color: #eeeeee;
		}

		#footer ul.quick-links li {
			padding: 3px 0;
			-webkit-transition: .5s all ease;
			-moz-transition: .5s all ease;
			transition: .5s all ease;
		}

		#footer ul.quick-links li:hover {
			padding: 3px 0;
			margin-left: 5px;
			font-weight: 700;
		}

		#footer ul.quick-links li a i {
			margin-right: 5px;
		}

		#footer ul.quick-links li:hover a i {
			font-weight: 700;
		}

		@media (max-width:767px) {
			#footer h5 {
				padding-left: 0;
				border-left: transparent;
				padding-bottom: 0px;
				margin-bottom: 10px;
			}
		}
	</style>
</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-adeeva fixed-top" style="position: relative;">
		<div class="container text-black">
			<a class="navbar-brand  color-adeeva" href="<?= base_url('welcome') ?>">
				<img src="<?= base_url('assets/img/logo.png') ?>" alt="" width="50">
				Adeeva Tour
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="<?= base_url('welcome') ?>">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('about') ?>">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('login-pelanggan'); ?>">Login</a>
					</li>

				</ul>
			</div>
		</div>
	</nav>

	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php $h = 0;
			foreach ($paket_wisata as $getData) : ?>
				<li data-target="#carouselExampleIndicators" data-slide-to="<?= $h; ?>" <?php if ($h == 0) { echo 'class="active"'; } ?>></li>
				<?php $h++;
			endforeach; ?>

		</ol>
		<div class="carousel-inner">
			<?php $i = 1;
			foreach ($paket_wisata as $getData) : 
			
			$fasilitas = $this->db->select('nama_fasilitas')->from('item_fasilitas')->join('fasilitas', 'fasilitas_id = fasilitas.id')->where(['paket_wisata_id' => $getData->id])->get()->result(); ?>
				<div class="carousel-item <?php if ($i == 1) { echo 'active'; } ?>">
					<img src="<?= base_url('assets/img/') . $getData->thumbnail ?>" class="d-block w-100" alt="...">
					<div class="carousel-caption d-none d-md-block">
						<h3 style="background-color: rgba(0,0,0,0.5);"><?= $getData->nama_paket ?></h3>
							<ul style="background-color: rgba(0,0,0,0.5); text-align: center;">
							<h5>Fasilitas :</h5>

								<?php foreach($fasilitas as $getFasilitas): ?>
								<li>- <?= $getFasilitas->nama_fasilitas ?></li>
								<?php endforeach ?>
							</ul>
						<a href="<?= base_url('login-pelanggan') ?>" class="btn btn-primary">Pesan Sekarang</a>
					</div>
				</div>
				<?php $i++;
			endforeach; ?>



		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<!-- Akhir Slide -->

	<div class="container">
		<div class="row text-center p-3 mb-1 bg-white rounded">
			<img src="<?= base_url('assets/img/testimoni1.jpg') ?>" width="400" class="img-fluid" alt="Responsive image">
			<div class="media-body">
				<h4 class="mt-0">Irma Lia, Pegawai Swasta</h4>
				<p class="konten ml-3"><i>Makasih Adeeva Tour buat pelayanannya selama di lombok..puas banget.. liburan menarik, guidenya+supirnya ramah.. mau di repotin sama cewe2 rempong..hahaha..
						harganya murah tapi pelayanannya juara.. orangnya ramah2 banget..pokoknya bikin pengen ke lombok lagi..dan pake adeeva tour lagi tentunya..</i></p>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row text-center p-3 mb-1 bg-white rounded">
			<div class="media-body">
				<h4 class="mt-0">Rizal Ahmad Zaki</h4>
				<p class="konten px-3"><i>Gk cuma lombok yg exotic,,, ni travel punya service yg oks bangget,,,, guide nd drivernya?? gk perlu tanya salutt bangett baik, ramah, sabar, gokil… gk sia2 jauh2 ke lombok pake tur travel ini….
						Baru x ini ikut tur travel sampe terharu dan kangen saat pisahaan,,saat tur berakhir…thx so much,,, ingat lombok ingat adeeva tour</i></p>
			</div>
			<img src="<?= base_url('assets/img/testimoni2.jpg') ?>" width="400" class="img-fluid" alt="Responsive image">
		</div>
	</div>

	<div class="container">
		<div class="row text-center p-3 mb-1 bg-white rounded">
			<img src="<?= base_url('assets/img/testimoni3.jpg') ?>" width="400" class="img-fluid" alt="Responsive image">
			<div class="media-body">
				<h3 class="mt-0">Dwi Nur Octaviani</h3>
				<p class="konten ml-3"><i>Thank you Adeeva Tour sudah mewarnai holiday aku dan kawan2 dengan sangat menarik
						Masih belom bisa move on ni dari kota yg penuh dengan budaya ini
						Tempatnya asyik plus tour guidenya asyiiik beud lah..
						semoga next bisa kejogja lagi bersama pasangan hihi
					</i></p>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<div class="card text-center bg-light">
		<div class="card-header">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.6862110139887!2d111.46251131477693!3d-7.609083994513365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMzYnMzIuNyJTIDExMcKwMjcnNTIuOSJF!5e0!3m2!1sid!2sid!4v1562253785327!5m2!1sid!2sid" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
	
	<div class="card text-center bg-light">
        <div class="card-body" style="background-color: #3E909B!important">
            <h2 class="card-title text-white">Kantor Kami</h2>
            <p class="card-text text-white">Adeeva Tour & Travel <br>jl. Bromo 12B Magetan, Jawa Timur <br>Telepon : 081312028427 <br> Email : adeevatour@gmail.com
            </p>
            <ul class="list-inline medsos">
                <li><a href="#" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="https://www.instagram.com/cimahitherapycenter" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Adeeva Tour 2019</span>
                </div>
            </div>
        </footer>
    </div>


	<!-- ./Footer -->
	<!-- javascript jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>