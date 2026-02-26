<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminDBarang20Controller extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "d_barang";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nama Debitur","name"=>"debitur"];
			$this->col[] = ["label"=>"Jenis Barang","name"=>"j_kategori_id","join"=>"j_kategori,jenis"];
			$this->col[] = ["label"=>"Harga","name"=>"harga","callback_php"=>'"Rp. ".number_format([harga])'];
			$this->col[] = ["label"=>"Tanggal Pengumuman I","name"=>"tgl_mulai","callback"=>function($row) {
				return date( "d-m-Y H:i:s", strtotime($row->tgl_mulai));
			}];
			$this->col[] = ["label"=>"Tanggal Pengumuman II","name"=>"tgl_mulai2","callback"=>function($row) {
				return date( "d-m-Y H:i:s", strtotime($row->tgl_mulai2));
			}];
			$this->col[] = ["label"=>"Tanggal Lelang","name"=>"masa_lelang","callback"=>function($row) {
				return date( "d-m-Y H:i:s", strtotime($row->masa_lelang));
			}];
			$this->col[] = ["label"=>"Provinsi","name"=>"d_provinsi_id","join"=>"d_provinsi,provinsi"];
			$this->col[] = ["label"=>"Kabupaten/Kota","name"=>"d_kab_kota_id","join"=>"d_kab_kota,kab_kota"];
			$this->col[] = ["label"=>"Kecamatan","name"=>"d_kecamatan_id","join"=>"d_kecamatan,kecamatan"];
			$this->col[] = ["label"=>"Status","name"=>"status"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Harga Limit','name'=>'harga','type'=>'money','validation'=>'required|min:0|integer','width'=>'col-sm-10','decimals'=>'2','dec_point'=>','];
			$this->form[] = ['label'=>'No Rekening','name'=>'no_rekening','type'=>'text','validation'=>'required|min:1|max:14','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Debitur','name'=>'debitur','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jenis Barang','name'=>'j_kategori_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'j_kategori,jenis'];
			$this->form[] = ['label'=>'Tanggal Mulai','name'=>'tgl_mulai','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Berakhir','name'=>'masa_lelang','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'PIC 1','name'=>'pic1','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'No. HP PIC 1','name'=>'no_pic1','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'PIC 2','name'=>'pic2','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'No. HP PIC 2','name'=>'no_pic2','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Bukti Kepemilikan','name'=>'bukti','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Alamat','name'=>'alamat','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Provinsi','name'=>'d_provinsi_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'d_provinsi,provinsi'];
			$this->form[] = ['label'=>'Kabupaten/Kota','name'=>'d_kab_kota_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'d_kab_kota,kab_kota','parent_select'=>'d_provinsi_id'];
			$this->form[] = ['label'=>'Kecamatan','name'=>'d_kecamatan_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'d_kecamatan,kecamatan','parent_select'=>'d_kab_kota_id'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Harga','name'=>'harga','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'No Rekening','name'=>'no_rekening','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Nama Debitur','name'=>'debitur','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Jenis Barang','name'=>'j_kategori_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'j_kategori,jenis'];
			//$this->form[] = ['label'=>'Tanggal Mulai','name'=>'tgl_mulai','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tanggal Berakhir','name'=>'masa_lelang','type'=>'datetime','validation'=>'required|date_format:Y-m-d H:i:s','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'PIC 1','name'=>'pic1','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'No. HP PIC 1','name'=>'no_pic1','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'PIC 2','name'=>'pic2','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'No. HP PIC 2','name'=>'no_pic2','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Bukti Kepemilikan','name'=>'bukti','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Alamat','name'=>'alamat','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Provinsi','name'=>'d_provinsi_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'d_provinsi,provinsi'];
			//$this->form[] = ['label'=>'Kabupaten/Kota','name'=>'d_kab_kota_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'d_kab_kota,kab_kota','parent_select'=>'d_provinsi_id'];
			//$this->form[] = ['label'=>'Kecamatan','name'=>'d_kecamatan_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'d_kecamatan,kecamatan','parent_select'=>'d_kab_kota_id'];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();
			


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();
			$this->addaction[] = ['label'=>'Posting','url'=>CRUDBooster::mainpath('set-status/Posting/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[status] == 'Pending'"];
			$this->addaction[] = ['label'=>'Posting','url'=>CRUDBooster::mainpath('set-status/Posting/[id]'),'icon'=>'fa fa-check','color'=>'success','showIf'=>"[status] == 'Take Down'"];
			$this->addaction[] = ['label'=>'Take Down','url'=>CRUDBooster::mainpath('set-status/Take Down/[id]'),'icon'=>'fa fa-ban','color'=>'warning','showIf'=>"[status] == 'Posting'", 'confirmation' => true];
			


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }
		public function getSetStatus($status,$id) {
			DB::table('d_barang')->where('id',$id)->update(['status'=>$status]);
			
			//This will redirect back and gives a message
			CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Status barang sudah di-update !","info");
		 }
		public function getDetail($id) {
			//Create an Auth
			if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {    
			  CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
			}
			
			$data = [];
			$data['page_title'] = 'Detail Data';
			$data['row'] = DB::table('d_barang')->where('id',$id)->first();
			$data['foto'] = DB::table('d_foto')->where('d_barang_id',$id)->get();
			$prov = $data['row']->d_provinsi_id;
			$kab = $data['row']->d_kab_kota_id;
			$kec = $data['row']->d_kecamatan_id;
			$data['prov'] = DB::table('d_provinsi')->select('provinsi')->where('id',$prov)->first();
			$data['kab'] = DB::table('d_kab_kota')->select('kab_kota')->where('id',$kab)->first();
			$data['kec'] = DB::table('d_kecamatan')->select('kecamatan')->where('id',$kec)->first();
			$jen = $data['row']->j_kategori_id;
			$data['kat'] = DB::table('j_kategori')->select('jenis')->where('id',$jen)->first();
			$data['fot'] = DB::table('d_foto')->where('d_barang_id',$id)->get();
			//dd($data['fot']);
			
			//Please use view method instead view method from laravel
			return $this->cbView('detail_barang',$data);
		  }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}