<div class="features_items" ><!--features_items-->
    <h2 class="title text-center">Galeri</h2>
    <?php if ($row->isEmpty()) { ?>
        <div class="content-404 text-center">
                       
            <h3><b><font color="#00008B">OPPS!</b> Kami tidak menemukan data yang Anda inginkan</h3></font>
            
        </div>
    <?php } else { ?>
    <div class="row flex-row">
    @foreach ($row as $barang)
        <div class="col-sm-3 d-flex">
            <?php 
                $thumb = DB::table('d_foto')->where('d_barang_id',$barang->id)->first();
            
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
                            
                            <!-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> -->
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
<?php if ($row->isNotEmpty()) { ?>
<ul class="pagination">
                
    {{ $row->links()}}

</ul>
<?php } ?>