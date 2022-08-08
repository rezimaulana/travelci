<!DOCTYPE html>
<html lang="en">

<head>
    <title>About Us</title>
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

        .content {
            text-align: center;
            position: relative;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
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
			<a class="navbar-brand color-adeeva" href="<?= base_url('welcome') ?>">
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

    <div class="container-fluid" style="background: url(<?= base_url('assets/img/adeeva.jpg') ?>); height: 300px!important; background-size: cover;">
            <div class="content">
            <h1 class="text-center text-white">About Us</h1>
            </div>
        
    </div>


    <div class="container">
        <div class="row text-center p-3 mb-1 bg-white rounded">
            
            <div class="media-body">
            <blockquote class="blockquote text-center">
                <p class="mb-0">Selamat Datang di Adeeva Tour. Kami menyediakan semua informasi tentang paket wisata dan liburan. Dengan pelayanan yang nyaman, guide yang profesional, perjalanan yang menyenangkan, akan membantu Anda menemukan pengalaman tak terlupakan dalam hidup Anda.

                Adeeva Tour adalah salah satu dari sekian banyak biro perjalanan wisata. Kami mengandalkan layanan yang bersahabat dan Recomended untuk Anda. Pengalaman kami dalam dunia Travel yang lebih dari 5 tahun, membuat kami percaya jika petualangan Anda bersama kami tentunya akan terasa menakjubkan. Mimpi Anda tentang Liburan akan diwujudkan dalam cara profesional yang nyata.

                Kami mengatur semua rencana perjalanan anda, Senior tour Leader, Driver, makan , transportasi, Akomodasi dan lainnya. Klik saja program mana yang Anda inginkan dan kami akan melayani anda dengan senyum.

                Dimiliki dan dioperasikan oleh warga Bandung Asli, serta para teamwork yang juga merupakan pemuda pemudi yang lahir dan dibesarkan, tentu memiliki kemampuan dan penguasaan yang lebih tentang adat istiadat, budaya, tradisi secara keseluruhan.</p>
                <footer class="blockquote-footer">Adeeva Tour & Travel </footer>
            </blockquote>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <section class="mt-4 bg-adeeva" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                    <p class="h6">Copyright &copy; Adeeva Tour 2019</p>
                </div>
                </hr>
            </div>
        </div>
    </section>
    <!-- ./Footer -->
    <!-- javascript jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>