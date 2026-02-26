<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading text-center'>Data Barang</div>
    <div class='panel-body'>      
      <div class="col-md-12">
        <div class="box box-warning box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Info Barang</h3> 
        </div>
        
        <div class="box-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td style="width: 1%">1.</td>
                <td style="width: 20%">Keterangan</td>
                <td style="width: 1%">:</td>
                <td style="width: 48%">{{ $row->keterangan }}</td>
            </tr>

            <tr>
                <td style="width: 1%">2.</td>
                <td style="width: 20%">Nilai Limit</td>
                <td style="width: 1%">:</td>
                <td style="width: 48%">Rp. {{ number_format($row->harga) }}</td>
            </tr>
            <tr>
              <td style="width: 1%">3.</td>
              <td style="width: 20%">Jaminan Penawaran</td>
              <td style="width: 1%">:</td>
              <td style="width: 48%">Rp. {{ number_format($row->jam_pena) }}</td>
          </tr>
          <tr>
            <td style="width: 1%">4.</td>
            <td style="width: 20%">No Rekening Kredit</td>
            <td style="width: 1%">:</td>
            <td style="width: 48%">{{ $row->no_rekening }}</td>
        </tr>
        <tr>
          <td style="width: 1%">5.</td>
          <td style="width: 20%">Nama Debitur</td>
          <td style="width: 1%">:</td>
          <td style="width: 48%">{{ $row->debitur }}</td>
      </tr>
      <tr>
        <td style="width: 1%">6.</td>
        <td style="width: 20%">Jenis Barang</td>
        <td style="width: 1%">:</td>
        <td style="width: 48%">{{ $row->jenis }}</td>
    </tr>
    <tr>
      <td style="width: 1%">7.</td>
      <td style="width: 20%">Tanggal Pengumuman I</td>
      <td style="width: 1%">:</td>
      <td style="width: 48%">{{ $row->tgl_mulai }}</td>
  </tr>
  <tr>
    <td style="width: 1%">8.</td>
    <td style="width: 20%">Tanggal Pengumuman II</td>
    <td style="width: 1%">:</td>
    <td style="width: 48%">{{ $row->tgl_mulai2 }}</td>
</tr>
<tr>
  <td style="width: 1%">8.</td>
  <td style="width: 20%">Tanggal Berakhir Lelang</td>
  <td style="width: 1%">:</td>
  <td style="width: 48%">{{ $row->masa_lelang }}</td>
</tr>
<tr>
  <td style="width: 1%">9.</td>
  <td style="width: 20%">PIC 1</td>
  <td style="width: 1%">:</td>
  <td style="width: 48%">{{ $row->pic1 }}</td>
</tr>
<tr>
  <td style="width: 1%">10.</td>
  <td style="width: 20%">No. HP PIC 1</td>
  <td style="width: 1%">:</td>
  <td style="width: 48%">{{ $row->no_pic1 }}</td>
</tr>
<tr>
  <td style="width: 1%">11.</td>
  <td style="width: 20%">PIC 2</td>
  <td style="width: 1%">:</td>
  <td style="width: 48%">{{ $row->pic2 }}</td>
</tr>
<tr>
  <td style="width: 1%">12.</td>
  <td style="width: 20%">No. HP Pic 2</td>
  <td style="width: 1%">:</td>
  <td style="width: 48%">{{ $row->no_rekening }}</td>
</tr>
            
            </tbody></table>
        </div>
        
        </div>
        
        </div>
        <div class="col-md-12">
          <div class="box box-warning box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Uraian Barang</h3> 
          </div>
          
          <div class="box-body">
            <table class="table table-bordered">
              <tbody>
  
              <tr>
                  <td style="width: 1%">1.</td>
                  <td style="width: 20%">Bukti Kepemilikan</td>
                  <td style="width: 1%">:</td>
                  <td style="width: 48%">{{ $row->bukti }}</td>
              </tr>
              <tr>
                <td style="width: 1%">2.</td>
                <td style="width: 20%">No. Bukti Kepemilikan</td>
                <td style="width: 1%">:</td>
                <td style="width: 48%">{{ $row->ket_bukti }}</td>
            </tr>
            <tr>
              <td style="width: 1%">3.</td>
              <td style="width: 20%">Nama Pemilik Agunan</td>
              <td style="width: 1%">:</td>
              <td style="width: 48%">{{ $row->pemilik }}</td>
          </tr>
              <tr>
                <td style="width: 1%">4.</td>
                <td style="width: 20%">Tanggal Agunan</td>
                <td style="width: 1%">:</td>
                <td style="width: 48%">{{ $row->tgl_agunan }}</td>
            </tr>
            <tr>
              <td style="width: 1%">5.</td>
              <td style="width: 20%">Alamat Agunan</td>
              <td style="width: 1%">:</td>
              <td style="width: 48%">{{ $row->alamat }}</td>
          </tr>
            
          <tr>
        <td style="width: 1%">6.</td>
        <td style="width: 20%">Kelurahan/Desa</td>
        <td style="width: 1%">:</td>
        <td style="width: 48%">{{ $des->kel_desa }}</td>
    </tr>

    <tr>
          <td style="width: 1%">7.</td>
          <td style="width: 20%">Kecamatan</td>
          <td style="width: 1%">:</td>
          <td style="width: 48%">{{ $kec->kecamatan }}</td>
      </tr>

      <tr>
            <td style="width: 1%">8.</td>
            <td style="width: 20%">Kabupaten/Kota</td>
            <td style="width: 1%">:</td>
            <td style="width: 48%">{{ $kab->kab_kota }}</td>
        </tr>

        <tr>
              <td style="width: 1%">9.</td>
              <td style="width: 20%">Provinsi</td>
              <td style="width: 1%">:</td>
              <td style="width: 48%">{{ $prov->provinsi }}</td>
          </tr>
    
    <tr>
      <td style="width: 1%">10.</td>
      <td style="width: 20%">Penyelenggara</td>
      <td style="width: 1%">:</td>
      <td style="width: 48%">{{ $pen->kpk }}</td>
  </tr>
              
              </tbody></table>
          </div>
          
          </div>
          
          </div>
          <div class="col-md-12">
            <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Foto</h3> 
            </div>
            
            <div class="box-body">
              <div class="row margin-bottom">
                @if ($fot)
                  @foreach ($fot as $fo)
                  <div class="col-sm-6">
                    <a data-lightbox="roadtrip" rel="group_{d_foto}" title="Foto: 1" href="{{ asset($fo->foto) }}"><img class="img-responsive" src="{{ asset($fo->foto) }}"></a>
                  </div> 
                  @endforeach
                @else
              <p>Tidak ada foto</p>
                    
                @endif
                
                
                </div>
            </div>
            
            </div>
            
            </div>
    </div>
  </div>
@endsection