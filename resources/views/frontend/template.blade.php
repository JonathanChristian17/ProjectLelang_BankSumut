<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ $page_title }} | Lelang Bank Sumut</title>
    <link href="{{ asset('eshopper/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('eshopper/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('eshopper/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('eshopper/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('eshopper/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('eshopper/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('eshopper/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('eshopper/css/jquery-ui.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('eshopper/js/html5shiv.js') }}"></script>
    <script src="{{ asset('eshopper/js/respond.min.js') }}"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('uploads/2023-02/logo-1.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('eshopper/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('eshopper/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('eshopper/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('eshopper/images/ico/apple-touch-icon-57-precomposed.png') }}">
    <script src="{{ asset('eshopper/js/jquery.js') }}"></script>
	<script src="{{ asset('eshopper/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('eshopper/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('eshopper/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('eshopper/js/jquery-1.12.4.js') }}"></script>
    <script src="{{ asset('eshopper/js/jquery-ui.js') }}"></script>
   
   
    <script>
        $(document).ready(function () {
    
            /*------------------------------------------
            --------------------------------------------
            Provinsi Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            
                $('#provinsi').on('change', function() {
                var provinsiID = $(this).val();
                if(provinsiID) {
                    $.ajax({
                        url: "{{url('getKab')}}/"+provinsiID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#kab_kota').empty();
                                $('#kab_kota').append('<option hidden>-- Pilih Kab/Kota --</option>'); 
                                $.each(data, function(key, kabkota){
                                    $('select[name="kab_kota"]').append('<option value="'+ kabkota.id +'">' + kabkota.kab_kota+ '</option>');
                                });
                                
                            }else{
                                $('#kab_kota').empty();
                            }
                            
                        }
                    });
                }else{
                    $('#kab_kota').empty();
                }
                });
        
    
            /*------------------------------------------
            --------------------------------------------
            Kab Kota Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#kab_kota').on('change', function() {
    
                var kabkotaID = $(this).val();
                if(kabkotaID) {
                    $.ajax({
                        url: "{{url('getKec')}}/"+kabkotaID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                                $('#kec').empty();
                                $('#kec').append('<option hidden>-- Pilih Kecamatan --</option>'); 
                                $.each(data, function(key, keca){
                                    $('select[name="kec"]').append('<option value="'+ keca.id +'">' + keca.kecamatan+ '</option>');
                                });
                            }else{
                                $('#kec').empty();
                            }
                        }
                    });
                }else{
                    $('#kec').empty();
                }
                });
                /*------------------------------------------
            --------------------------------------------
            Kecamatan Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#kec').on('change', function() {
    
            var kecID = $(this).val();
            if(kecID) {
                $.ajax({
                    url: "{{url('getKelDesa')}}/"+kecID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data)
                    {
                        if(data){
                            $('#kel_desa').empty();
                            $('#kel_desa').append('<option hidden>-- Pilih Kel/Desa --</option>'); 
                            $.each(data, function(key, keldes){
                                $('select[name="kel_desa"]').append('<option id="desas" value="'+ keldes.id +'">' + keldes.kel_desa+ '</option>');
                            });
                        }else{
                            $('#kel_desa').empty();
                        }
                    }
                });
            }else{
                $('#kel_desa').empty();
            }
            });
            
    
        });
    </script>
    
<script>

    $(function () {
        <?php $max = DB::table('d_barang')->max('harga'); ?>
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: <?php echo $max/1000000;?>,
            values: [0, <?php echo $max;?>],
            step: 50,
            slide: function (event, ui) {

                $("#amount_start").val(ui.values[ 0 ]);
                $("#amount_end").val(ui.values[ 1 ]);
                var start = $('#amount_start').val();
                var end = $('#amount_end').val();
            }
        });

        $('.try').click(function(){

            //alert('hardeep');
            
            var brand = [];
            $('.try').each(function(){
                if($(this).is(":checked")){

                    brand.push($(this).val());
                }
            });
            Finalbrand  = brand.toString();

            

            });
           

            $('#kel_desa').on('change', function() {
    
                var kecdesaID = $(this).val();
                if(kecdesaID) {
                    document.getElementById("kelde").value = kecdesaID;
                }
               
               
               
            });

            $('#filter').click(function(){
                var start = $('#amount_start').val();
                
                var end = $('#amount_end').val();
                var des = $('#kelde').val();
               
                
                var brand = [];
                $('.try').each(function(){
                    if($(this).is(":checked")){

                        brand.push($(this).val());
                    }
                });
                Finalbrand  = brand.toString();
               
                
                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '',
                    data: "start=" + start + "& end=" + end + "&brand=" + Finalbrand+ "&village=" + des,
                    
                    success: function (response) {
                        console.log(response);
                        $('#updateDiv').html(response);
                    }
                });
                

            });      
       });

      
</script>
</head><!--/head-->

<body>
	<header id="header" class="navbar-modern">
		<div class="header-bottom">
			<div class="container">
				<div class="row align-items-center">
					<!-- Kiri: Logo -->
					<div class="col-sm-3 navbar-left">
						<a href="{{ url('/') }}">
							<img src="{{ asset('assets/img/logobanksumut.jpg') }}" alt="Logo Bank Sumut" class="nav-logo">
						</a>
					</div>
					
					<!-- Tengah: Menu -->
					<div class="col-sm-6 navbar-center">
						<div class="mainmenu">
							<ul class="nav navbar-nav">
								<li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
								<li><a href="#" class="{{ Request::is('kontak') ? 'active' : '' }}">Kontak</a></li>
							</ul>
						</div>
					</div>

					<!-- Kanan: Login Button -->
					<div class="col-sm-3 navbar-right text-right">
						<a href="http://localhost/lelangapp/public/admin/login" class="btn btn-login">Login / Daftar</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<script>
		$(window).scroll(function() {
			if ($(this).scrollTop() > 50) {
				$('.navbar-modern').addClass('sticky');
			} else {
				$('.navbar-modern').removeClass('sticky');
			}
		});
	</script>
		
	
		@yield('content')
	<footer id="footer"><!--Footer-->
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
                    <div class="col-sm-6">
                        <p style="margin-top: 10px; font-weight: bold;">{{ $visitorCount ?? 0 }} Pengunjung</p>
                    </div>
				</div>
                <div class="row">
					<center> Copyright@<a href="#">Bank Sumut</a></span></p> </center>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
	

  
   

    
        
        
</body>
</html> 
        
</body>
</html>