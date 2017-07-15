<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Model\M_pengguna;
use App\Model\M_kelas_kamar;
use App\Model\M_kamar;
use App\Model\M_relasi_fasilitas;
use App\Model\M_fasilitas;
use App\Model\M_promo;
use App\Model\M_order;
use App\Model\M_pengunjung;
use App\Model\M_detail_reservasi;
use App\Model\M_roles;
use View;
use Mail;
use Carbon\Carbon;
use App\Http\Controllers\Auth\ActionController;

class HomeController extends Controller
{

    use ActionController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('LayoutType');
        // $this->middleware('AuthPrivilege');
    }

    protected $layout = 'layouts.MasterAdm';
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['MainTitle'] = "Halaman Dashboard";
        $data['FormTitle'] = " System GrahaWisata";
        $data['LayoutType'] = $request->get('layout');
        $data['Theme'] = $request->get('theme');
        $data['data_chart_pemasukan'] = $this->chart_tahunan($parameter=date("Y"),$keyword=null);
        $data['data_chart_pengeluaran'] = null;
        $data['PluginJS'] = null;
        $data['SupportJS'] = View::make('function_js.custom_chart_dash')->with($data);
        $data['ContentSupport'] = null;
        $data['chart_pemasukan_js'] = null;
       // $data['MainJS'] = View::make('header_footer.FooterAdm')->with($data);
        return View::make('content.VContentDash')->with($data);
    }

    protected function tes1(Request $request){
        if (Gate::allows('pesan_kamar', $request)) {
            return redirect('/home');
        }else{
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }
    }
    protected function tes2(){
        echo "tes2";
    }
    protected function tes3(){
        echo "tes3";
    }


////////////////////////////////////////////////// PROFILE USER ////////////////////////////////////////////////////////
    public function profile(Request $request){
         $data['MainTitle'] = "Grahawisata - Profile Pengguna Sistem";
         $data['FormTitle'] = "Profile Pengguna Sistem";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = M_pengguna::with('role')->where('id',Auth::user()->id)->get();
         $data['data_roles'] = M_roles::get();
         $data['keyword'] = null;
         $data['PluginJS'] = null;
         $data['SupportJS'] = null;
         $data['ContentSupport'] = View::make('modal.modal_foto_pengguna')->with($data);
         return View::make('content.VContentMyProfile')->with($data);   
         // echo json_encode($data['maindata']);
    }  

    public function ganti_password(Request $request){
         $data['MainTitle'] = "Grahawisata - Account Pengguna Sistem";
         $data['FormTitle'] = "Ubah Password";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = M_pengguna::where('id',Auth::user()->id)->get();
         $data['keyword'] = null;
         $data['PluginJS'] = null;
         $data['SupportJS'] = null;
         $data['ContentSupport'] = null;
         return View::make('content.VContentMyPassword')->with($data);   
    }

    public function setting_tampilan(Request $request){
         $data['MainTitle'] = "Grahawisata - Tampilan Sistem";
         $data['FormTitle'] = "Setting Tampilan Sistem";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = M_pengguna::with('setting')->where('id',Auth::user()->id)->get()->toArray();
         $data['keyword'] = null;
         $data['PluginJS'] = null;
         $data['SupportJS'] = null;
         $data['ContentSupport'] = null;
         return View::make('content.VContentSettingTampilan')->with($data);   
    }

////////////////////////////////////////////////// PROFILE USER ////////////////////////////////////////////////////////










////////////////////////////////////////////////// KEPEGAWAIAN /////////////////////////////////////////////////////////
    public function daftar_pengguna(Request $request){
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }

        $key_pegawai = $request->key_pegawai;
        if(empty($key_pegawai) || $key_pegawai == null){
            $maindata = M_pengguna::with('role')->paginate(5);
        }else{
            $maindata =M_pengguna::with('role')->where('username','LIKE',"%{$key_pegawai}%")
             ->orWhere('name','LIKE',"%{$key_pegawai}%")
             ->orWhere('email','LIKE',"%{$key_pegawai}%")
             ->orWhere('telepon','LIKE',"%{$key_pegawai}%")
             ->paginate(5);
        }    
         $data['MainTitle'] = "Grahawisata - Pengguna Sistem";
         $data['FormTitle'] = "Daftar Pengguna Sistem";
         $data['jumlah_pengguna'] =  M_pengguna::count();
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = $maindata;
         $data['data_roles'] = M_roles::get();
         $data['keyword'] = $key_pegawai;
         $data['PluginJS'] = null;
         $data['SupportJS'] = View::make('function_js.custom_list_pengguna')->with($data);
         $data['ContentSupport'] = View::make('modal.modal_pengguna')->with($data);
         return View::make('content.VContentListPengguna')->with($data);        
    }

    public function tambah_pengguna(Request $request){
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }  
         $data['MainTitle'] = "Grahawisata - Tambah Pengguna Sistem";
         $data['FormTitle'] = "Edit Pengguna Sistem";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = null;
         $data['data_roles'] = M_roles::get();
         $data['keyword'] = null;
         $data['PluginJS'] = null;
         $data['SupportJS'] = null;
         $data['ContentSupport'] = null;
         return View::make('content.VContentAddPengguna')->with($data);        
    }

    public function edit_pengguna(Request $request){
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }  
         $data['MainTitle'] = "Grahawisata - Tambah Pengguna Sistem";
         $data['FormTitle'] = "Edit Pengguna Sistem";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = M_pengguna::where('id',Auth::user()->id)->get();
         // $data['data_roles'] = M_roles::get();
         $data['keyword'] = null;
         $data['PluginJS'] = null;
         $data['SupportJS'] = null;
         $data['ContentSupport'] = null;
         return View::make('content.VContentEditPengguna')->with($data);        
    }
////////////////////////////////////////////////// KEPEGAWAIAN /////////////////////////////////////////////////////////




////////////////////////////////////////////////// FASILITAS /////////////////////////////////////////////////////////

    public function daftar_fasilitas(Request $request)
    {   

        // $tes = Route::getCurrentRoute()->action;
        // echo json_encode($tes);
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }

        $key_fasilitas = $request->search_fasilitas;
        // $maindata = M_fasilitas::where('is_delete', 'no');
        if(empty($key_fasilitas) || $key_fasilitas == null){
            $maindata = M_fasilitas::paginate(5);
        }else{
            $maindata =M_fasilitas::where('nama_fasilitas','LIKE',"%{$key_fasilitas}%")->paginate(5);
        }
         $data['MainTitle'] = "Grahawisata - Fasilitas Hotel";
         $data['FormTitle'] = "Daftar Fasilitas";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         // $data['maindata'] = M_fasilitas::get()->where('is_delete', 'no');
         $data['maindata'] = $maindata;
         $data['keyword'] = $key_fasilitas;
         $data['PluginJS'] = null;
         $data['SupportJS'] = View::make('function_js.custom_list_fasilitas')->with($data);
         $data['ContentSupport'] = View::make('modal.modal_fasilitas')->with($data);
         return View::make('content.VContentListFasilitas')->with($data);
    }


    public function data_fasilitas($id){
        $all_fasilitas = M_fasilitas::all();
        $maindata = M_kelas_kamar::where('id_kelas',$id)->get();

        foreach ($maindata as $hasil) {

            foreach($all_fasilitas as $fasilitas){
                $data_fasilitas[] = array('id_fasilitas'=>$fasilitas->id_fasilitas,
                                'nama_fasilitas'=>$fasilitas->nama_fasilitas,
                                'hasil'=>false);
            }

        for($i=0; $i<count($data_fasilitas); $i++){    
                foreach($hasil->fasilitas as $fasilitas_pilihan){
                    if($fasilitas_pilihan->id_fasilitas == $data_fasilitas[$i]['id_fasilitas']){
                        $data_fasilitas[$i]['hasil'] = true;
                    }
                }  
        }


        }
   
        return $data_fasilitas;
    } 
////////////////////////////////////////////////// FASILITAS /////////////////////////////////////////////////////////




////////////////////////////////////////////////// KELAS KAMAR /////////////////////////////////////////////////////////

    protected function daftar_kelas(Request $request){
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }

        $key_kelas = $request->search_kelas;
        if(empty($key_kelas) || $key_kelas == null){
            $maindata = M_kelas_kamar::paginate(5);
        }else{
            $maindata =M_kelas_kamar::where('nama','LIKE',"%{$key_kelas}%")->paginate(5);
        }
         $data['jumlah_kamar'] =  M_kamar::count();
         $data['kamar_kosong'] =  M_kamar::where('status','kosong');
         $data['kamar_dipakai'] =  M_kamar::where('status','dipakai');
         $data['MainTitle'] = "Grahawisata - Kelas Kamar Hotel";
         $data['FormTitle'] = "Daftar Kelas Kamar";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = $maindata;
         $data['keyword'] = $key_kelas;
         $data['PluginJS'] = null;
         $data['SupportJS'] = View::make('function_js.custom_list_kamar')->with($data);
         $data['ContentSupport'] = View::make('modal.modal_kamar')->with($data);
         return View::make('content.VContentListKelasKamar')->with($data);

    }  

    public function tambah_kelas(Request $request)
    {
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }

         $data['MainTitle'] = "Grahawisata - Kelas Kamar";
         $data['FormTitle'] = "Tambah Kelas Kamar";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['fasilitas'] =  M_fasilitas::all();
         $data['PluginJS'] = null;
         $data['SupportJS'] = View::make('function_js.custom_list_kelaskamar')->with($data);
         $data['ContentSupport'] = null;
         return View::make('content.VContentAddKelasKamar')->with($data);
    }


    public function edit_kelas(Request $request,$id_kelas)
    {
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }

         $maindata = M_kelas_kamar::where('id_kelas',$request->id_kelas);
         $data['MainTitle'] = "Grahawisata - Kelas Kamar";
         $data['FormTitle'] = "Edit Kelas Kamar";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = $maindata->get();
         $data['key'] = $request->id_kelas;
         $data['fasilitas'] =  $this->data_fasilitas($id_kelas);
         $data['PluginJS'] = null;
         $data['SupportJS'] = View::make('function_js.custom_list_kelaskamar')->with($data);
         $data['ContentSupport'] = null;

         if( $maindata->count() == 1) {
            return View::make('content.VContentEditKelasKamar')->with($data);
         }else{
            return redirect('/home/daftar_kelas')->with('error_notif', "Data Yang Akan di Edit Tidak Ditemukan");
         }
    }      

////////////////////////////////////////////////// KELAS KAMAR /////////////////////////////////////////////////////////



 
//////////////////////////////////////////////////////// PROMO /////////////////////////////////////////////////////////
    public function daftar_promo(Request $request){
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }

        $key_promo = $request->search_promo;
        if(empty($key_promo) || $key_promo == null){
            $maindata = M_promo::paginate(5);
        }else{
            // $maindata = M_promo::paginate(5);
            $maindata = M_promo::where('kode_promo','LIKE',"%{$key_promo}%")->paginate(5);
        }
         $data['MainTitle'] = "Grahawisata - Promo Hotel";
         $data['FormTitle'] = "Daftar Promo";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = $maindata;
         $data['keyword'] = $key_promo;
         $data['PluginJS'] = null;
         $data['SupportJS'] = View::make('function_js.custom_list_promo')->with($data);
         $data['ContentSupport'] = View::make('modal.modal_promo')->with($data);
         return View::make('content.VContentListPromo')->with($data);

    }  

//////////////////////////////////////////////////////// PROMO /////////////////////////////////////////////////////////





//////////////////////////////////////////////////////// KEUANGAN ///////////////////////////////////////////////////////// 

    public function pemasukan(Request $request,$parameter){
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }
        
        $keyword = $request->key_pemasukan;
         if($parameter=="tahunan"){
            $param_tahun = $request->tahun;
            if(!empty($param_tahun)){
               $param_tahun = $param_tahun;
            }else{
               $param_tahun = date("Y");
            }
            $maindata = $this->pemasukan_tahunan($keyword,$param_tahun);
         }else if($parameter=="bulanan"){
            $param_bulan = $request->bulan;
            $param_tahun = $request->tahun;
            if(!empty($param_tahun) and !empty($param_bulan)){
               $param_bulan = $param_tahun."-".$param_bulan;
            }else{
               $param_bulan = date("Y-m");
            }
            $maindata = $this->pemasukan_bulanan($keyword,$param_bulan);
         }else if($parameter=="harian"){
            $param_hari = $request->hari;
            if(!empty($param_hari)){
               $param_hari = $param_hari;
            }else{
               $param_hari = date("Y-m-d");
            }
            $maindata = $this->pemasukan_harian($keyword,$param_hari);
         }else{
            $param_date_between = $request->tanggal_between;
            if(!empty($param_date_between[0]) and !empty($param_date_between[1])){
               $param_date_between = $param_date_between;
            }else{
               $param_date_between ="";
            }
            $maindata = $this->pemasukan_all($keyword,$param_date_between);
         }

         $data['MainTitle'] = "Grahawisata - Pemasukan Hotel";
         $data['FormTitle'] = "Data Pemasukan Hotel";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = $maindata;
         $data['PluginJS'] = View::make('function_js.custom_plugin_export');
         $data['SupportJS'] = $maindata['chart_pemasukan_js'];
         $data['ContentSupport'] = null;
         return View::make('content.VContentPemasukan')->with($data);
        
    }

    public function pemasukan_all($keyword, $parameter){
        if(empty($keyword) and !empty($parameter)){
            $maindata = M_order::whereHas('detail_reservasi', function($query)  use ($parameter) {
                return $query->whereBetween('tanggal',array($parameter[0],$parameter[1]));});
             // return $maindata;
        }else if(!empty($keyword) and empty($parameter)){
             $maindata = M_order::where('id_pengunjung','LIKE',"%{$keyword}%")
             ->orWhere('day_start','LIKE',"%{$keyword}%")
             ->orWhere('day_end','LIKE',"%{$keyword}%")
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('id_pengunjung','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('nama','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('alamat','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('telepon','LIKE',"%{$keyword}%");});
             // return $maindata;

        }else if(!empty($keyword) and !empty($parameter)){
            $maindata = M_order::whereHas('detail_reservasi', function($query)  use ($parameter) {
                return $query->whereBetween('tanggal',array($parameter[0],$parameter[1]));})
             ->orWhere('id_pengunjung','LIKE',"%{$keyword}%")
             ->orWhere('day_start','LIKE',"%{$keyword}%")
             ->orWhere('day_end','LIKE',"%{$keyword}%")
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('id_pengunjung','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('nama','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('alamat','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('telepon','LIKE',"%{$keyword}%");});
             // return $maindata;
        }else{
             $maindata =M_order::with('detail_reservasi','pengunjung','kamar');
             // return $maindata;
        }

         $data_chart = $this->chart_semua($maindata);
         $data['title_widget'] = "Total Pemasukan";
         $data['total_pemasukan'] = array_sum($maindata->pluck('total_harga')->toArray());
         $data['total_transaksi'] = count($maindata->pluck('id_pesanan')->toArray());
         $data['maindata'] = $maindata->orderBy('day_start', 'desc')->paginate(10);
         $data['data_chart_pemasukan'] = $data_chart;
         $data['chart_pemasukan_js'] = View::make('function_js.custom_chart_pemasukan')->with($data);
         // echo json_encode($data['data_chart_pemasukan']);
         return View::make('content.keuangan.VContentPemasukanAll')->with($data);
    }

    public function pemasukan_tahunan($keyword, $parameter){
        if(empty($keyword) and !empty($parameter)){
            $maindata = M_order::whereHas('detail_reservasi', function($query)  use ($parameter) {
             return $query->where('tanggal','LIKE',"%{$parameter}%");});
             // ->paginate(5);
             // return $maindata;
        }else if(!empty($keyword) and empty($parameter)){
             $maindata = M_order::where('id_pengunjung','LIKE',"%{$keyword}%")
             ->orWhere('day_start','LIKE',"%{$keyword}%")
             ->orWhere('day_end','LIKE',"%{$keyword}%")
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('id_pengunjung','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('nama','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('alamat','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('telepon','LIKE',"%{$keyword}%");});
             // ->paginate(5);
             // return $maindata;
        }else if(!empty($keyword) and !empty($parameter)){
            $maindata = M_order::whereHas('detail_reservasi', function($query)  use ($parameter) {
                return $query->where('tanggal','LIKE',"%{$parameter}%");})
             ->where('id_pengunjung','LIKE',"%{$keyword}%")
             ->orWhere('day_start','LIKE',"%{$keyword}%")
             ->orWhere('day_end','LIKE',"%{$keyword}%")
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('id_pengunjung','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('nama','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('alamat','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('telepon','LIKE',"%{$keyword}%");});
             // ->paginate(5);
             // return $maindata;
        }else{
             $maindata =M_order::with('detail_reservasi','pengunjung')
             ->where('day_start','LIKE',"%{$keyword}%");
             // ->paginate(5);
             // return $maindata;
        }

        if(empty($parameter)){
            $title_total_pemasukan = "Total Pemasukan tahun ".date("Y");
        }else{
            $title_total_pemasukan = "Total Pemasukan tahun ".$parameter;
        }

         $data_chart = $this->chart_tahunan($parameter,$keyword);
         $data['title_widget'] = $title_total_pemasukan;
         $data['total_pemasukan'] = array_sum($maindata->pluck('total_harga')->toArray());
         $data['total_transaksi'] = count($maindata->pluck('id_pesanan')->toArray());
         $data['maindata'] = $maindata->paginate(10);
         $data['data_chart_pemasukan'] = $data_chart;
         $data['chart_pemasukan_js'] = View::make('function_js.custom_chart_pemasukan')->with($data);
         return View::make('content.keuangan.VContentPemasukanAll')->with($data);
    }

    public function pemasukan_bulanan($keyword, $parameter){
        if(empty($keyword) and !empty($parameter)){
            $maindata = M_order::whereHas('detail_reservasi', function($query)  use ($parameter) {
             return $query->where('tanggal','LIKE',"%{$parameter}%");});
             // ->paginate(5);
             // return $maindata;
        }else if(!empty($keyword) and empty($parameter)){
             $maindata = M_order::where('id_pengunjung','LIKE',"%{$keyword}%")
             ->orWhere('day_start','LIKE',"%{$keyword}%")
             ->orWhere('day_end','LIKE',"%{$keyword}%")
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('id_pengunjung','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('nama','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('alamat','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('telepon','LIKE',"%{$keyword}%");});
             // ->paginate(5);
             // return $maindata;

        }else if(!empty($keyword) and !empty($parameter)){
            $maindata = M_order::whereHas('detail_reservasi', function($query)  use ($parameter) {
                return $query->where('tanggal','LIKE',"%{$parameter}%");})
             ->where('id_pengunjung','LIKE',"%{$keyword}%")
             ->orWhere('day_start','LIKE',"%{$keyword}%")
             ->orWhere('day_end','LIKE',"%{$keyword}%")
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('id_pengunjung','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('nama','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('alamat','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('telepon','LIKE',"%{$keyword}%");});
             // ->paginate(5);
             // return $maindata;
        }else{
             $maindata =M_order::with('detail_reservasi','pengunjung')
             ->where('day_start','LIKE',"%{$keyword}%");
             // ->paginate(5);
             // return $maindata;
        }

        if(empty($parameter)){
            $title_total_pemasukan = "";
        }else{
            $title_total_pemasukan = "Total Pemasukan ".$this->generate_number_to_month($parameter);
        }

         $data_chart = $this->chart_bulanan($parameter,$keyword);
         $data['title_widget'] = $title_total_pemasukan;
         $data['total_pemasukan'] = array_sum($maindata->pluck('total_harga')->toArray());
         $data['total_transaksi'] = count($maindata->pluck('id_pesanan')->toArray());
         $data['maindata'] = $maindata->paginate(2);
         $data['data_chart_pemasukan'] = $data_chart;
         $data['chart_pemasukan_js'] = View::make('function_js.custom_chart_pemasukan')->with($data);
         return View::make('content.keuangan.VContentPemasukanAll')->with($data);

            
    }

    public function pemasukan_harian($keyword, $parameter){
        if(empty($keyword) and !empty($parameter)){
            $maindata = M_order::whereHas('detail_reservasi', function($query)  use ($parameter) {
             return $query->where('tanggal','LIKE',"%{$parameter}%");})
             ->paginate(5);
             return $maindata;
        }else if(!empty($keyword) and empty($parameter)){
             $maindata = M_order::where('id_pengunjung','LIKE',"%{$keyword}%")
             ->orWhere('day_start','LIKE',"%{$keyword}%")
             ->orWhere('day_end','LIKE',"%{$keyword}%")
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('id_pengunjung','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('nama','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('alamat','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('telepon','LIKE',"%{$keyword}%");})
             ->paginate(5);
             return $maindata;

        }else if(!empty($keyword) and !empty($parameter)){
            $maindata = M_order::whereHas('detail_reservasi', function($query)  use ($parameter) {
                return $query->where('tanggal','LIKE',"%{$parameter}%");})
             ->where('id_pengunjung','LIKE',"%{$keyword}%")
             ->orWhere('day_start','LIKE',"%{$keyword}%")
             ->orWhere('day_end','LIKE',"%{$keyword}%")
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('id_pengunjung','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('nama','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('alamat','LIKE',"%{$keyword}%");})
             ->orwhereHas('pengunjung', function($query)  use ($keyword) {
                    return $query->where('telepon','LIKE',"%{$keyword}%");})
             ->paginate(5);
             return $maindata;
        }else{
             $maindata =M_order::with('detail_reservasi','pengunjung')
             ->where('day_start','LIKE',"%{$keyword}%")
             ->paginate(5);
             return $maindata;
        }

    }


    public function pengeluaran(Request $request){
         return View::make('content.VContentPengeluaran')->with($data);

    }


    public function neraca(Request $request){
         return View::make('content.VContentNeracaKeuangan')->with($data);
    }

    public function generate_number_to_month($data_parameter){
        $parameter_bulan = substr($data_parameter,5,7);
        $parameter_tahun = substr($data_parameter,0,4);
        if($parameter_bulan=="01"){
            $hasil = "Januari";
        }else if($parameter_bulan=="02"){
            $hasil = "Februari";
        }else if($parameter_bulan=="03"){
             $hasil = "Maret";
        }else if($parameter_bulan=="04"){
             $hasil = "April";
        }else if($parameter_bulan=="05"){
             $hasil = "Mei";
        }else if($parameter_bulan=="06"){
             $hasil = "Juni";
        }else if($parameter_bulan=="07"){
             $hasil = "Juli";
        }else if($parameter_bulan=="08"){
             $hasil = "Agustus";
        }else if($parameter_bulan=="09"){
             $hasil = "September";
        }else if($parameter_bulan=="10"){
             $hasil = "Oktober";
        }else if($parameter_bulan=="11"){
             $hasil = "November";
        }else if($parameter_bulan=="12"){
             $hasil = "Desember";
        }else{
            $hasil = "";
        }
        return $hasil." ".$parameter_tahun;
    }


//////////////////////////////////////////////////////// KEUANGAN ///////////////////////////////////////////////////////// 






//////////////////////////////////////////////////////// CHART //////////////////////////////////////////////////////////////
    protected function chart_semua($maindata){
       $data_chart = array();
        foreach ($maindata->orderBy('day_start', 'desc')->paginate(10) as $res1) {
                $datetime = explode(" ",$res1->day_start);
                $date = $datetime[0];
            if (array_key_exists($date,$data_chart)){
                $data_chart[$date]['pemasukan'] += $res1->total_harga;
                $data_chart[$date]['total'] += 1;
            }else{
                $data_chart[$date] = array('day'=>$date,
                                                 'pemasukan'=>$res1->total_harga,
                                                 'total'=>1);
            }

        }
        $data_chart = array_reverse(array_values($data_chart));
        return $data_chart;
    }

    protected function chart_tahunan($parameter,$keyword){
        $data_chart = array();
        for($i=1; $i<=12; $i++){
            $parameter_waktu = $parameter."-".sprintf("%02d", $i);
            if(empty($keyword)){
                $data_chart_raw = M_order::where('day_start','LIKE',"%{$parameter_waktu}%")->get();
            }else{
                $data_chart_raw =  M_order::where(function ($query) use ($parameter_waktu,$keyword) {
                                        $query->where('day_start','LIKE',"%{$parameter_waktu}%");
                                        $query->whereHas('pengunjung', function($query_child)  use ($keyword) {
                                            return $query_child->where('nama','LIKE',"%{$keyword}%");});
                                    })->orWhere(function ($query) use ($parameter_waktu,$keyword) {
                                        $query->where('day_start','LIKE',"%{$parameter_waktu}%");
                                        $query->whereHas('pengunjung', function($query_child)  use ($keyword) {
                                            return $query_child->where('alamat','LIKE',"%{$keyword}%");});
                                    })->orWhere(function ($query) use ($parameter_waktu,$keyword) {
                                        $query->where('day_start','LIKE',"%{$parameter_waktu}%");
                                        $query->whereHas('pengunjung', function($query_child)  use ($keyword) {
                                            return $query_child->where('telepon','LIKE',"%{$keyword}%");});
                                    })->orWhere(function ($query) use ($parameter_waktu,$keyword) {
                                        $query->where('day_start','LIKE',"%{$parameter_waktu}%");
                                        $query->where('day_start','LIKE',"%{$keyword}%");
                                    })->orWhere(function ($query) use ($parameter_waktu,$keyword) {
                                        $query->where('day_start','LIKE',"%{$parameter_waktu}%");
                                        $query->where('id_pengunjung','LIKE',"%{$keyword}%");
                                    })
                                    ->get();

            }
            $data_chart[$i] = array("day"=>substr($this->generate_number_to_month($parameter_waktu),0,-4),
                                    "pemasukan"=>0,
                                    "total"=>0);
           
            foreach($data_chart_raw as $hasil){
                // echo json_encode($hasil)."</br>";
                if (array_key_exists($i,$data_chart)){
                    if(array_key_exists('pemasukan', $data_chart[$i]) and array_key_exists('total', $data_chart[$i])){
                        $data_chart[$i]['pemasukan'] += $hasil->total_harga;
                        $data_chart[$i]['total'] += 1;
                    }else{
                         $data_chart[$i]['pemasukan'] += 0;
                        $data_chart[$i]['total'] += 0;
                    }
                }
            }
        }
         $data_chart = array_values($data_chart);
         return $data_chart;        
    }

    protected function chart_bulanan($parameter,$keyword){
         $dt = Carbon::createFromFormat('Y-m-d', ($parameter."-01"));
         $date_start = $dt->format("Y-m-d");
         $date_end =  $dt->addMonth()->format("Y-m-d");      
        
        $index=0;
        $data_chart = array();
        while ($date_start < $date_end){$index++;
            if($index==1){
                $date_start = $date_start;
            }else if($index>1){
                $date_start = date('Y-m-d', strtotime($date_start . ' +1 day'));
            }

            if($date_start==$date_end){
                break;
            }

            if(empty($keyword)){
                $data_chart_raw = M_order::where('day_start','LIKE',"%{$date_start}%")->get();
            }else{
                $data_chart_raw =  M_order::where(function ($query) use ($date_start,$keyword) {
                                        $query->where('day_start','LIKE',"%{$date_start}%");
                                        $query->whereHas('pengunjung', function($query_child)  use ($keyword) {
                                            return $query_child->where('nama','LIKE',"%{$keyword}%");});
                                    })->orWhere(function ($query) use ($date_start,$keyword) {
                                        $query->where('day_start','LIKE',"%{$date_start}%");
                                        $query->whereHas('pengunjung', function($query_child)  use ($keyword) {
                                            return $query_child->where('alamat','LIKE',"%{$keyword}%");});
                                    })->orWhere(function ($query) use ($date_start,$keyword) {
                                        $query->where('day_start','LIKE',"%{$date_start}%");
                                        $query->whereHas('pengunjung', function($query_child)  use ($keyword) {
                                            return $query_child->where('telepon','LIKE',"%{$keyword}%");});
                                    })->orWhere(function ($query) use ($date_start,$keyword) {
                                        $query->where('day_start','LIKE',"%{$date_start}%");
                                        $query->where('day_start','LIKE',"%{$keyword}%");
                                    })->orWhere(function ($query) use ($date_start,$keyword) {
                                        $query->where('day_start','LIKE',"%{$date_start}%");
                                        $query->where('id_pengunjung','LIKE',"%{$keyword}%");
                                    })
                                    ->get();
            }
            
            $data_chart[$index] = array(//"day"=>$date_start,
                                        "day"=> ($index),
                                        "pemasukan"=>0,
                                        "total"=>0);

            // echo json_encode($data_chart_raw)."</br>";
            // echo json_encode($data_chart[$index])."</br>";

            foreach($data_chart_raw as $hasil){
                // echo json_encode($hasil)."</br>";
                if (array_key_exists($index,$data_chart)){
                    if(array_key_exists('pemasukan', $data_chart[$index]) and array_key_exists('total', $data_chart[$index])){
                        $data_chart[$index]['pemasukan'] += $hasil->total_harga;
                        $data_chart[$index]['total'] += 1;
                    }else{
                         $data_chart[$index]['pemasukan'] += 0;
                        $data_chart[$index]['total'] += 0;
                    }
                }
            }
        }
         $data_chart = (array_values($data_chart));
         return $data_chart;        
    }



//////////////////////////////////////////////////////// CHART //////////////////////////////////////////////////////////////






//////////////////////////////////////////////////////// PESANAN ///////////////////////////////////////////////////////// 
    public function pesan_kamar(Request $request){
        $method_alias = $this->validate_auth_privilege($request);
        if (Gate::denies($method_alias['as'], $request)) {
            return redirect('/home')->with('error_notif', "Limited Access - Anda Tidak Memiliki Hak Akses");
        }

        $key_promo = $request->search_promo;
        if(empty($key_promo) || $key_promo == null){
            $maindata = M_kamar::paginate(5);
        }else{
            $maindata = M_kamar::paginate(5);
        }
         $data['MainTitle'] = "Grahawisata - Pesan Kamar";
         $data['FormTitle'] = "Pemesanan Kamar";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = $maindata;
         $data['keyword'] = $key_promo;
         $data['PluginJS'] = null;
         $data['SupportJS'] = null;
         $data['ContentSupport'] = null;
         return View::make('content.VContentCariKamar')->with($data);

    }  

    public function search_kamar(Request $request){
        $waktu_start =$request->get('waktu')." 14:00:00";
        $durasi = $request->get('durasi');
        $waktu_end = date('d-m-Y',strtotime($waktu_start.' + '.$durasi.' days'))." 12:00:00";
        $kamar = $request->get('kamar');
        $guest = $request->get('guest');
        $validate_guest_kamar = $this->validateGuestKamar($guest,$kamar);
        $day_start = $this->validateDate($waktu_start);
        $day_end = $this->validateDate($waktu_end);
        
        $parameter = array('day_start'=>$day_start,
                           'day_end'=>$day_end,
                           'durasi'=>$durasi,
                           'kamar'=>$kamar,
                           'guest'=>$guest,
                           'validate_guest_kamar'=>$validate_guest_kamar);

        if(($day_start) and ($day_end) and ($validate_guest_kamar) and $day_start<$day_end){
            $order_detail = M_detail_reservasi::whereBetween('tanggal' ,array($day_start->format('Y-m-d H:i:s'),$day_end->format('Y-m-d H:i:s')))->get()->pluck('id_kamar');
            $kamar_exception = array();
            foreach($order_detail as $hasil){
                    if(!in_array($hasil, $kamar_exception)){
                         array_push($kamar_exception, $hasil);
                    }
            }  
            $avail_kamar = M_kamar::whereNotIn('id_kamar',$kamar_exception)->get();
            $jml_avail_kamar_bykelas = array_count_values( M_kamar::whereNotIn('id_kamar',$kamar_exception)->get()->pluck('id_kelas')->toArray());

                $avail_kelas = array_values(array_unique( M_kamar::whereNotIn('id_kamar',$kamar_exception)
                                            ->get()
                                            ->pluck('id_kelas')
                                            ->toArray() ));
                $kelas= M_kelas_kamar::findMany($avail_kelas);
                
                $available = array();
                foreach($kelas as $hasil){
                    if($jml_avail_kamar_bykelas[$hasil->id_kelas]>=$kamar){
                        array_push($available, $hasil->id_kelas);
                    }
                }    

                $kelas= M_kelas_kamar::findMany($available);
                $index=0;    foreach($kelas as $kelas_kamar){ $index++;
                        $indexs=0;
                        foreach($avail_kamar as $kamar){;
                            if($kamar->id_kelas == $kelas_kamar->id_kelas){
                            $indexs = intval($indexs+1); 
                            $all_data_avail[$kelas_kamar->id_kelas][$indexs] = $kamar->id_kamar;
                            }
                        }
                    }
                $maindata = array('avail_kelas'=>$kelas,
                                  'all_avail_kamar'=>$avail_kamar,
                                  'available_kamar'=>$all_data_avail,
                                  'jml_avail_kamar_bykelas'=>$jml_avail_kamar_bykelas);
                echo $this->result_kamar($request,$maindata);
        }else{
            return redirect('/home/pesan_kamar')->with('error_notif', "Data Tidak Ditemukan, Periksa Kembali Format Pencarian");
        }

    }

    public function result_kamar(Request $request,$maindata){
         $data['MainTitle'] = "Grahawisata - Pesan Kamar";
         $data['FormTitle'] = "Pemesanan Kamar";
         $data['LayoutType'] = $request->get('layout');
         $data['Theme'] = $request->get('theme');
         $data['maindata'] = $maindata;
         $data['keyword'] = null;
         $data['PluginJS'] = null;
         $data['SupportJS'] = null;
         $data['ContentSupport'] = null;
         return View::make('content.VContentPesanKamar')->with($data);
    }

    public function booking(Request $request){
        // if(session('boolean_step1')){
            if($this->check_session_booking()){
                 $data['MainTitle'] = "Grahawisata - Pesan Kamar";
                 $data['FormTitle'] = "Pemesanan Kamar";
                 $data['LayoutType'] = $request->get('layout');
                 $data['Theme'] = $request->get('theme');
                 $data['maindata'] = null;
                 $data['keyword'] = null;
                 $data['PluginJS'] = null;
                 $data['SupportJS'] = null;
                 $data['ContentSupport'] = null;
                return View::make('content.VContentBookingKamar')->with($data);
            }else{
                return redirect('/home/pesan_kamar')->with('error_notif', "Data Telah Expired, Ulangi Pengisian Data");
            }
        // }else{
        //         return redirect('/home/pesan_kamar')->with('error_notif', "Data Telah Expired, Ulangi Pengisian Data");
        // }
    }

    public function check_session_booking(){
        if( !empty(session('waktu')) 
            and !empty(session('total_harga'))
            and !empty(session('durasi'))
            and !empty(session('nama_kelas')) 
            and !empty(session('jml_kamar')) 
            and !empty(session('jml_pengunjung'))
        ){
            return true;
        }else{
            return false;
        }
    }


//////////////////////////////////////////////////////// PESANAN /////////////////////////////////////////////////////////     




    public function tes(Request $request){
        // $hasil = M_kelas_kamar::withTrashed()->count();
        // $hasil = M_kelas_kamar::find('kelas_0001');
        // $hasil = M_kamar::mgenerate_id();

        //// hasmany
        // $hasil = M_kelas_kamar::where('id_kelas','kelas_0001')->get();
        // foreach($hasil as $value){
        //         echo $value->id_kelas." punya banyak kamar yaitu "."</br>";
        //     foreach($value->kamar as $result){
        //         echo $result->id_kamar."</br>";
        //     }
        // }

        // //belongsto
        // $hasil = M_kamar::with('kelas_kamar')->get();
        // foreach($hasil as $value){
        //         echo "kamar dengan id kamar : ".$value->id_kamar." memiliki kelas ".$value->kelas_kamar->nama."</br>";
        // }

        // $namakelas = "adelia";
        // $hasil = M_kelas_kamar::mget_id_kelas_by_name($namakelas); 
       
        // kelas kamar have fasilitas and kamar
        // $hasil = M_kelas_kamar::with('fasilitas')->get();
        // $hasil = M_kelas_kamar::with('fasilitas','kamar')->get();
        // foreach($hasil as $value){
        //         echo $value->id_kelas." punya banyak kamar dan fasilitas yaitu "."</br>";
        //         echo "</br></br>";
        //         echo $value->fasilitas."</br>";
        //         echo "</br>";
        //         echo $value->kamar."</br>";
        //         echo "</br></br>";
        // }

        // echo json_encode($hasil);

 
        // $hasil = M_kamar::get();
        // foreach($hasil as $value){
        //         // echo "kamar dengan id kamar : ".$value->id_kamar." memiliki kelas ".$value->kelas_kamar->nama."</br>";
        //         echo $value;
        //         echo $value->kelas_kamar;
        // }



        // $id_kelas = "kelas_0003";
        // $hasil=    M_kamar::whereHas('kelas_kamar', function($query)  use ($id_kelas) {
        //             return $query->where('id_kelas', $id_kelas);
        //         })->get()->pluck('id_kamar')->toArray();

    // echo json_encode($hasil);

        
        //// validate format date 
        // $get_start ="10-03-2017"." 14:00:00";
        // $get_end = "15-03-2017"." 12:00:00";
        // $jml_kamar = 15;
        // $day_start = $this->validateDate($get_start);
        // $day_end =$this->validateDate($get_end);
        // if(($day_start) and ($day_end) and $day_start<$day_end){
        //     $order_detail = M_detail_reservasi::with('order')->whereBetween('tanggal' ,array($day_start->format('Y-m-d H:i:s'),$day_end->format('Y-m-d H:i:s')))->get()->pluck('order');
        //     $kamar_exception = array();
        //     foreach($order_detail as $hasil){
        //             if(!in_array($hasil->id_kamar, $kamar_exception)){
        //                  array_push($kamar_exception, $hasil->id_kamar);
        //             }
        //     }  
        // //    $avail_jml_kamar_bykelas = array_count_values( M_kamar::whereNotIn('id_kamar',$kamar_exception)->get()->pluck('id_kelas')->toArray());
        //    $avail_kamar = M_kamar::whereNotIn('id_kamar',$kamar_exception)->get()->pluck('id_kamar');
        //     if(count($avail_kamar)>=$jml_kamar){
        //     $avail_kelas = array_values(array_unique( M_kamar::whereNotIn('id_kamar',$kamar_exception)
        //                                 ->get()
        //                                 ->pluck('id_kelas')
        //                                 ->toArray() ));
        //     // echo json_encode(($avail_kamar));
        //     echo json_encode(($avail_kelas));
        //     }else{
        //         echo "jumlah kamar tidak mencukupi";   
        //     }
        // }else{
        //     echo "terjadi kesalahan pada format tanggal";
        // }


        ////updateorcreate
        // $id="3374151405925555";

        // $hasil = M_pengunjung::updateOrCreate(array('id_pengunjung'=>$id),array('nama'=>'manggala asdasdd',
        //                                                                         'telepon'=>'08456212541',
        //                                                                         'alamat'=>'jl. lokoloko'));
        // if($hasil){
        // }else{
        //     echo "gagal";
        // }

        // $hasil = M_order::with('detail_reservasi','pengunjung','kamar')->get();
        // echo json_encode($hasil);

        ////soal1 GUAVA.id
        // $a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow","e"=>"yellow","f"=>"green","g"=>"yellow");
        // $this->cek_duplicate_array($a1);

        ////soal2 GUAVA.id
        // $nilai = intval("736");
        // $this->split_nilai($nilai);


                // $hasil =  M_pengguna::with('role')->get();
                // echo json_encode($hasil)."</br></br>";

                // foreach($hasil as $val){
                //     $user = $val->toArray();
                //     echo $user['role']['privilege'];
                //     // echo json_encode($val->role);
                // }

                // echo json_encode($test['role']['privilege']);

        $hasil = M_pengguna::with('setting')->where('id',Auth::user()->id)->get();
        foreach ($hasil as $val) {
            $setting =  $val->toArray();
            echo $setting['setting']['app_theme'];
        }

    }

    protected function tes_mail(Request $request){
            $title = "tes mail";
            $content = "ini content";

        $sent =    Mail::raw('Tes Hello World', function ($message)
            {

                // $message->from('me@gmail.com', 'Christian Nwamba');

                $message->subject('Testing Verify Email');
                $message->to('mangga.raka@yahoo.co.id');

            });

            // return response()->json(['message' => 'Request completed']);
        return $sent;
    }

    public function cek_duplicate_array($data_array){
        if(is_array($data_array)){
            $data_temporary = array();
            $data_result = array();
            foreach($data_array as $hasil){
               if(!in_array($hasil, $data_temporary)){
                    array_push($data_temporary, $hasil);
               }else{
                    array_push($data_result, $hasil);
               }
            }

            if(!empty($data_result)){
                echo "duplikat data ditemukan yaitu : </br>";
                foreach(array_unique($data_result) as $jawaban){
                    echo $jawaban." sebanyak => ".intval(array_count_values($data_result)[$jawaban]+1)."</br>";
                }
            }else{
               echo "tidak ada duplikat data";
            }
        }else{
            echo "inputan / masukan tidak berupa array";
        }
    }

    public function split_nilai($nilai){
        if(is_int($nilai)){
            echo $nilai." = ";
            for($a=0; $a<strlen($nilai); $a++){
                    echo substr($nilai, $a,1);
                $zero=0;
                for($i=$a; $i<strlen($nilai)-1; $i++){
                    echo $zero;
                }
                if($a<strlen($nilai)-1){
                    echo "&nbsp + &nbsp";
                }
            }
        }else{
            echo "inputan / masukan tidak berupa bilangan bulat";
        }
    }

    protected function validateDate($tanggal, $format = 'd-m-Y H:i:s'){
        $date = new \DateTime();
        $real_date = $date->createFromFormat($format, $tanggal); 
        return $real_date;
    }

    protected function validateGuestKamar($guest,$kamar){
        if($guest>=$kamar and is_numeric($guest) and is_numeric($kamar) and ($guest>0) and ($kamar>0)){
            return true;
        }else{
            return false;
        }
    }
    // public function add_kamar(){         
    //     $id_kelas = "kelas_0001";
    //     $jumlah_kamar = "8";
    //     $total = M_kamar::mtotal_by_kelas($id_kelas);
    //     if($total < 1){
    //         $start = 0;
    //     }else{
    //         $start = M_kamar::mlast_no_kamar_by_kelas($id_kelas);
    //     }

    //     for($i=($start+1); $i<=($jumlah_kamar+$start); $i++){
    //         //insert to db
    //         echo $i."</br>";
    //     }
    // }
    
}
