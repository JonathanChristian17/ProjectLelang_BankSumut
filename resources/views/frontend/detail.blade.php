@extends('frontend.template')
@section('content')

<section>
  <div class="container">
      <div class="row">
          <div class="col-sm-3">
              <div class="left-sidebar">

              <div class="brands_products"><!--brands_products-->
                      <h2><font color="#00008B">Waktu Server </h2></font>
                      <div class="brands-name">
                          <div class="panel-group">
                            <div class="panel">
                              <div class="panel-body text-center">
                              <script type="text/javascript">

function date_time(id)
{
date = new Date;
year = date.getFullYear();
month = date.getMonth();
months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'OKtober', 'November', 'Desember');
d = date.getDate();
day = date.getDay();
days = new Array('Hari minggu,', 'Hari Senin,', 'Hari Selasa,', 'Hari Rabu,', 'Hari Kamis,', 'Hari Jumat,', 'Hari Sabtu,');
h = date.getHours();
if(h<10)
{
h = "0"+h;
}
m = date.getMinutes();
if(m<10)
{
m = "0"+m;
}
s = date.getSeconds();
if(s<10)
{
s = "0"+s;
}
result = ''+days[day]+' '+d+' '+months[month]+' '+year+' '+h+':'+m+':'+s;
document.getElementById(id).innerHTML = result;
setTimeout('date_time("'+id+'");','1000');
return true;
}
</script>

<span id="date_time"></span>
<script type="text/javascript">window.onload = date_time('date_time');</script>
                              </div>

                            </div>
                          </div>
                      </div>
                  </div><!--/brands_products-->     
              </div>
          </div>
          
          <div class="col-sm-9 padding-right border">
            <div class="product-details">
              
              <div class="col-sm-5">
                <div class="view-product">
                  <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      
                      <?php
                          $i = 1; //Counter
                          foreach ($fot as $r): //Foreach
                          $ol_class = ($i == 1) ? 'active' : ''; //Set class active for only indicator which belongs to respective Image
                      ?>
                     
                      <li data-target="#slider-carousel" data-slide-to="<?php echo $i;?>"  class="<?php echo $ol_class; ?>"></li>
                      <?php $i++; ?>
                      <?php endforeach; ?> 
                     
                    </ol>
                    
                    <div class="carousel-inner">
                      <?php
                        $i = 1; //Counter
                        foreach ($fot as $r): //Foreach
                        $item_class = ($i == 1) ? 'item active' : 'item'; //Set class active for image which is showing
                        ?>              
                        <div class="<?php echo $item_class; ?>"> 
                            <img src="{{ asset($r->foto) }}" >
                        </div>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                    
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                      <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </div>
              </div>
              
              <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                  <?php
                  $kate = DB::table('j_kategori')->select('jenis')->where('id',$row->j_kategori_id)->first();
                  $penye = DB::table('d_penyelenggara')->where('id',$row->d_penyelenggara_id)->first();
                  $provi = DB::table('d_provinsi')->select('provinsi')->where('id',$row->d_provinsi_id)->first();
                        $kabu = DB::table('d_kab_kota')->select('kab_kota')->where('id',$row->d_kab_kota_id)->first();
                        $keca = DB::table('d_kecamatan')->select('kecamatan')->where('id',$row->d_kecamatan_id)->first();
                        $desa = DB::table('d_kel_desa')->select('kel_desa')->where('id',$row->d_kel_desa_id)->first();
                  ?>
                  <span>
                  <span>{{ $kate->jenis }}</span>
                  <br>
                    <span>Nilai Limit : Rp. {{ number_format($row->harga) }}</span>       
                  </span>
                  <p><b><font size="4", color="#000000">Setoran Jaminan :Rp. {{ number_format($row->jam_pena) }}</b></p></font>
                  <br>
                  <p><b>Alamat :</b> {{ $row->alamat }}</p>
                  <p><b>Kelurahan/Desa :</b> {{ $desa->kel_desa }}</p>
                  <p><b>Kecamatan :</b> {{ $keca->kecamatan }} </p>
                  <p><b>Kabupaten/Kota :</b> {{ $kabu->kab_kota }}</p>
                  <p><b>Provinsi :</b> {{ $provi->provinsi }}</p>
                </div><!--/product-information-->
              </div>
            </div>
            <div class="category-tab shop-details-tab"><!--category-tab-->
              <div class="col-sm-12">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#details" data-toggle="tab">Uraian</a></li>
                  <li><a href="#companyprofile" data-toggle="tab">Informasi</a></li>
                  <li><a href="#tag" data-toggle="tab">Penyelenggara</a></li>
                </ul>
              

              <div class="tab-content">
                <div class="tab-pane fade active in" id="details" >
                  <div class="col-sm-12">
                  <table border="3" width="1000px">
        <tr>
            <td><b><center>Jenis</td></b><center>
            <td><b><center>Bukti Kepemilikan</td></b><center>
            <td><b><center>No. Bukti Kepemilikan</td></b><center>
        </tr>
        <tr>
            <td><center>{{ $kate->jenis }}</td><center>
            <td><center>{{ $row->bukti }}</td><center>
            <td><center>{{ $row->ket_bukti }}</td><center>
        </tr>
    </table>
                        </div>
                        </div>
                
                <div class="tab-pane fade" id="companyprofile" >
                  <div class="col-sm-12">
                    <table class="table">
                        
                      <tbody>
                        <tr>
                          <td colspan="3">
                            <p><b>Untuk informasi lebih lanjut dapat menghubungi :<p></b>
                            <br>
                              <b>{{ $row->pic1 }} - {{ $row->no_pic1 }}<br/>
                              {{ $row->pic2 }} - {{ $row->no_pic2 }}<br/><br/><br/></b>
                              <p><strong>Divisi Penyelamatan Kredit</strong><br/>
                                <b>PT. Bank Sumut<br/></b>
                                Jln. Imam Bonjol No. 18 Medan, Sumatera Utara
                                </p>                      

                          </td>
                          
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                  
                 
                </div>
                
                <div class="tab-pane fade" id="tag" >
                  
                  <div class="col-sm-12">
                    <p><b>Penyelenggara : </b>{{ $penye->kpk }}</p>
                    <p><b>Alamat : </b> {{ $penye->alamat }}</p>
                  </div>
                </div>
                
                
                
              </div>
            </div><!--/category-tab-->
          </div>
</section>

     
@endsection

       