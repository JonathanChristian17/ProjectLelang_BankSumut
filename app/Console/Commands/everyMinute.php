<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Posting Barang Lelang';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
       $barang = DB::table('d_barang')->get();
       $tgl = Carbon::now();
       $waktu = $tgl->toDateTimeString();

       foreach($barang as $bar)
       {
        DB::table('d_barang')->where('tgl_mulai', $waktu)->update(['status' => 'Posting']);
       }
    }
}
