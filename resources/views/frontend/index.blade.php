@extends('frontend.template')
@section('content')

<section id="slider"><!--slider-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      
                      <?php
                        $i = 0; //Counter
                        foreach ($slider as $sl): //Foreach
                          $ol_class = ($i == 0) ? 'active' : ''; //Set class active for only indicator which belongs to respective Image
                      ?>
                     
                        <li data-target="#slider-carousel" data-slide-to="<?php echo $i;?>"  class="<?php echo $ol_class; ?>"></li>
                        <?php $i++; ?>
                        <?php endforeach; ?> 
                     
                    </ol>
                    
                    <div class="carousel-inner">
                      <?php
                        $i = 0; //Counter
                        foreach ($slider as $sl): //Foreach
                        $item_class = ($i == 0) ? 'item active' : 'item'; //Set class active for image which is showing
                        ?>              
                        <div class="<?php echo $item_class; ?>"> 
                           
                            
                                <img src="{{ asset($sl->foto) }}" class="d-block w-100" style="max-height: 250px !important; width:100% !important" alt="" />
                               
                            
                            
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
    </div>
</section><!--/slider-->
<section>
<div class="container">
    <div class="row mb-3" >
        <div class="col-sm-3">
            <div class="left-sidebar">
                <div class="brands_products"><!--brands_products-->
                    <h2 class="text-center" style="border-bottom:none; margin-top:0;">Pencarian Berdasarkan:</h2>
                    <h2>Jenis Barang</h2>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">

                            <?php $cats = DB::table('j_kategori')->orderby('jenis', 'CSA')->get();?>

                            @foreach($cats as $cat)
                            <li class="brandLi">
                                <label style="font-weight: normal; margin:0; cursor:pointer;">
                                    <input type="checkbox" id="brandId" value="{{$cat->id}}" class="try"/>
                                    {{ucwords($cat->jenis)}}
                                </label>
                            </li>
                           @endforeach
                         <?php /*   <li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                            <li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
                            <li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
                            <li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
                            <li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
                            <li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                          * */?>

                       </ul>
                    </div>
                </div><!--/brands_products-->
                
                <div class="price-range"><!--price-range-->
                    <h2>Harga</h2>
                    <div class="well text-center" style="padding-top: 25px;">
                                    <?php $tinggi = DB::table('d_barang')->max('harga'); ?>
                                    
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                        <div style="text-align: center;">
                                            <span style="display:block; font-size:12px; color:#999;">Min (Juta)</span>
                                            <input type="text" id="amount_start" name="start_price" value="0" class="price-input" readonly="readonly" />
                                        </div>
                                        <span style="font-weight:bold; color:#ccc;">-</span>
                                        <div style="text-align: center;">
                                            <span style="display:block; font-size:12px; color:#999;">Max (Juta)</span>
                                            <input type="text" id="amount_end" name="end_price" value="{{ $tinggi/1000000 }}" class="price-input" readonly="readonly"/>
                                        </div>
                                    </div>
                                    
                                    <div id="slider-range"></div>
                    </div>
                </div><!--/price-range-->
                
                    <div class="price-range" ><!--shipping-->
                    <h2><font color="#00008B">Wilayah</font></h2>
                    <div class="form-group">
                        <label class="forlabel" for="provinsi">Provinsi</label>
                        <select  id="provinsi" name="provinsi" class="form-control modern-select">
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($prov as $pro)
                            <option value="{{$pro->id}}">
                                {{$pro->provinsi}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="forlabel" for="kab_kota">Kab/Kota</label>
                        <select class="form-control modern-select" name="kab_kota" id="kab_kota" disabled>
                            <option value="">-- Pilih Provinsi Dahulu --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="forlabel" for="kec">Kecamatan</label>
                        <select class="form-control modern-select" name="kec" id="kec" disabled>
                            <option value="">-- Pilih Kab/Kota Dahulu --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="forlabel" for="kel_desa">Kel/Desa</label>
                        <select class="form-control modern-select" name="kel_desa" id="kel_desa" disabled>
                            <option value="">-- Pilih Kecamatan Dahulu --</option>
                        </select>
                    </div>


                </div><!--/shipping-->
                <input type="hidden" id="kelde" name="kelde" value=""/>
                <div class="price-range" ><!--shipping-->
                    <div class="text-center">
                    <button type="button" id="filter" class="btn btn-default get custom-btn-anim">Filter <span></span></button>
                    <button type="button" id="reset" class="btn btn-default get custom-btn-anim" onclick="window.location.href='http://localhost/lelangapp/public'">Reset <span></span></button>
                    </div>
                </div><!--/shipping-->
            
            </div>
        </div>
        
        <div class="col-sm-9 padding-right" id="updateDiv">
            <div class="features_items" ><!--features_items-->
                <h2 class="title text-center">Galeri</h2>
                <?php if ($row->isEmpty()) { ?>
                    <div class="content-404">
                       
                        <h1><b>OPPS!</b> Kami tidak menemukan data yang Anda inginkan</h1>
   
                    </div>
                <?php } else { ?>
                <div class="row flex-row">
                @foreach ($row as $barang)
                
                    <div class="col-sm-3 d-flex">
                        <?php 
                            $thumb = DB::table('d_foto')->where('d_barang_id',$barang->id)->first();
                            //$thumb1 = DB::table('d_foto')->where('d_barang_id',$barang->id)->count();
                            //dd($thumb1);
                        
                            $provi = DB::table('d_provinsi')->select('provinsi')->where('id',$barang->d_provinsi_id)->first();
                            $kabu = DB::table('d_kab_kota')->select('kab_kota')->where('id',$barang->d_kab_kota_id)->first();
                            $keca = DB::table('d_kecamatan')->select('kecamatan')->where('id',$barang->d_kecamatan_id)->first();
                
                            $kate = DB::table('j_kategori')->select('jenis')->where('id',$barang->j_kategori_id)->first();
                            
                        ?>
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <span class="category-badge">{{ $kate->jenis }}</span>
                                    @if (empty($thumb))
                                        <img style="min-height: 150px !important; max-height: 150px; object-fit: cover; width: 100%;"  src="{{ asset('uploads/public/noimage.png') }}" class="card-img-top" alt="...">
                                    @else
                                        <img style="min-height: 150px !important; max-height: 150px; object-fit: cover; width: 100%;"  src="{{ asset($thumb->foto) }}" class="card-img-top" alt="...">
                                    @endif
                                    
                                    <h2 class="product-title">{{ $kate->jenis }}</h2>
                                    <p class="product-price">Nilai Limit : <span>Rp. {{ number_format($barang->harga) }}</span></p>
                                    
                                    <div class="product-meta">
                                        <p><i class="fa fa-map-marker" style="color: #FE980F;"></i> {{ $keca->kecamatan }}, {{ $provi->provinsi }}</p>
                                        <p><i class="fa fa-clock-o" style="color: #00008B;"></i> {{ $barang->masa_lelang }} WIB</p>
                                    </div>
                                    
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>{{ $kate->jenis }}</h2>
                                        <p>Nilai Limit : Rp. {{ number_format($barang->harga) }}</p>
                                        <a href="{{ url('lelang/detail/')}}/{{ $barang->id }}" class="btn btn-default add-to-cart"><i class="fa fa-search-plus"></i> Detail</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>

                    @endforeach
                    </div>
                    <?php }  ?>
                
                
            </div><!--features_items-->
            @if ($row->isNotEmpty())
                <ul class="pagination">

                        
                        {{ $row->links()}}
                
                </ul>
            @endif
            
            
        </div>
    </div>
</div>
</section>
<style>
    .forlabel{
        font-family: 'Roboto', sans-serif !important;
    }
</style>
@endsection
