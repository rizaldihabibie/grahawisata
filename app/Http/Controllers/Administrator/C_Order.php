<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Model\M_kelas_kamar;
use App\Model\M_kamar;
use App\Model\M_order;
use App\Model\M_promo;
use App\Model\M_pengunjung;
use App\Model\M_pengguna;
use App\Model\M_detail_reservasi;
use Illuminate\Support\Facades\Validator;
use session;
use Mail;
use DateTime;
use Carbon\Carbon;
class C_Order extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    protected function validator(array $data,$action)
    {	   
    	if($action == "add"){
    		  $rules = array( // data personal pengunjung
    		  				 'id_pengunjung'=> 'required|digits_between:3,32',
    		  				 'nama'=>'required|alpha',
    		  				 'telepon'=> 'required|digits_between:1,20|numeric',
	            			 'alamat'=> 'required',
	            			 // data pemesanan
	            			 'id_pesanan'=>'unique:order,id_pesanan',
	            			 'id_kamar'=> 'required',
	            			 'day_start'=>'required|date_format:"Y-m-d H:i:s"',
	            			 'day_end'=>'required|date_format:"Y-m-d H:i:s"',
	            			 // 'kode_promo'=>'digits:12',
	            			 'jumlah_hari'=>'required|numeric|digits_between:1,2',
	            			 'jumlah_tamu'=>'required|numeric|digits_between:1,2',
	            			 'total_harga'=>'required|numeric');
        }else if($action == "edit"){
    		  $rules = null;
        }else if($action == "delete"){
			     $rules = null;  
        }

        $messages = [
        'required' => 'kolom :attribute harus diisi',
        'alpha'=> 'kolom :attribute harus berupa text',
        'unique' => 'kolom :attribute telah digunakan',
        'min' => 'kolom :attribute minimal terdiri dari :min karakter',
        'numeric'=> 'kolom :attribute harus berisi angka',
        'digits_between'=> 'kolom :attribute harus terdiri :min sampai :max karakter',
        'digits'=>'kolom :attribute harus terdiri dari :value karakter',
        'date_format'=>'periksa format tanggal kolom :attribute'
        ];

        return Validator::make($data,$rules,$messages);
    } 

	protected function step1(Request $request,$id_kelas,$nama,$data_reservasi){
		$data_reservasi = Crypt::decrypt($data_reservasi);
		$this->drop_sess_promo($request);
		$data_reservasi['id_kelas'] = $id_kelas;
		$data_reservasi['nama_kelas'] = $nama;
		$data_reservasi['total_harga'] = $this->generate_total_harga($data_reservasi['durasi'],$data_reservasi['jml_kamar'],$id_kelas);
		$data_reservasi['data_kamar'] = Crypt::encrypt($data_reservasi['data_kamar']);
		// $data_reservasi['time_book_expired'] = date("d-m-Y H:i:s",strtotime('+10 minutes'));
		$data_reservasi['time_book_expired'] = date("d-m-Y H:i:s",strtotime('+10 minutes'));
		session($data_reservasi);
		$data['boolean_step1'] = true;
		return redirect('/home/pesan_kamar/booking')->with($data);
	}



	protected function add_pengunjung(){

	}

	protected function add_order($data_order,$data_kamar){
		return array('data1'=>$data_order,'data2'=>$data_kamar);
	}

	protected function add(Request $request){
		if(session('time_book_expired')>=date("d-m-Y H:i:s")){
		// 	//add some attribute for data
			$time = $this->validateDate(session('waktu'));
			$day_start = $time->format('Y-m-d')." 00:00:00";
			$day_end =  date('Y-m-d',strtotime(date_format(date_create($time),"Y-m-d").' + '.session('durasi').' days'))." 00:00:00";
			// $day_end =  date('Y-m-d H:i:s', strtotime($time . ' +1 day'));
			echo json_encode($day_end); exit();
			$arr_kamar = Crypt::decrypt(session('data_kamar'));
			if(!empty(session('harga_promo'))){$total_harga=session('harga_promo');}else{$total_harga=session('total_harga');}
			if(!empty(session('kode_disc'))){$kode_promo=session('kode_disc');}else{$kode_promo=null;}

		   $request->merge(array('id_pesanan'=>M_order::mgenerate_id(),
		   						 'id_kamar'=>$arr_kamar,
								 'day_start' => $day_start,
							     'day_end' => $day_end,
							     'jumlah_hari' => session('durasi'),
							     'jumlah_kamar' => session('jml_kamar'),
							     'jumlah_tamu' => session('jml_pengunjung'),
		 					     'total_harga' => $total_harga));


		// 	//1st validate
    		$this->validator($request->all(),"add")->validate(); 
    		$kamar_exception = $this->kamar_exception($request);

		// 	//2nd add / update pengunjung
			$add_pengunjung = M_pengunjung::madd($request);
			if($add_pengunjung){

				//3rd add data order
				$add_order = M_order::madd($request);
				if($add_order){

				 	//4th add detail order
					$add_detail_order = $this->add_detail_order($request,$kamar_exception); 
					if($add_detail_order){
						$this->drop_sess_booking($request);
	    				return redirect('/home/pesan_kamar')->with('success', "Data Pesanan Kamar Berhasil Ditambahkan");
						
					}else{
						$this->drop_sess_booking($request);
            			return redirect('/home/pesan_kamar/')->with('error_notif', "Error Pada Data Detail Order");
					}

				}else{
            		return redirect('/home/pesan_kamar/booking')->with('error_notif', "Error Pada Data Order");
				}

			}else{
            	return redirect('/home/pesan_kamar/booking')->with('error_notif', "Error Pada Data Pengunjung");
			}


		// 	//5th check email pengguna exist or not
			$pengguna = M_pengguna::where('email',$request->email)->get();

			if($pengguna->count() == 1){
				$email_pengguna = $pengguna->pluck('email');
				$kirim_email = $this->report_email_booking($request,$email_pengguna[0]);
			}else{
				$kirim_email = false;
			}
	
	    }else{
	    	$this->drop_sess_booking($request);
	    	return redirect('/home/pesan_kamar')->with('error_notif', "Error Session Booking Expired");
	    }
	}

	protected function add_detail_order(Request $request,$kamar_exception){
		$cek = 0;
		if(empty($kamar_exception)){

			for($i=1; $i<=count($request->id_kamar); $i++){
				if($i==(intval($request->jumlah_kamar)+1) ){
					break;
				}else{
					for($a=0; $a<=$request->jumlah_hari; $a++){
						if($a==0){
							$hours = 14;
						}else if($a==intval(($request->jumlah_hari))){
							$hours = 12;
						}else{
							$hours=0;
						}
						echo  ($request->id_kamar);
			   			// $detail_reservasi = new M_detail_reservasi;
			   			// $detail_reservasi->id_pesanan = $request->id_pesanan;
			   			// $detail_reservasi->id_kamar = ($request->id_kamar)[$i];
			   			// $detail_reservasi->tanggal = date( "Y-m-d H:i:s", strtotime($request->day_start." +".$a." days"." +".$hours." hours" ));
			   			// $hasil[] = $detail_reservasi->save();
					}

				}
			}

	   		if(in_array(false,$hasil,true)){
				$hasil = false;
	   		}else{
    			$hasil = true;
	   		}
			
			return $hasil;
		}else{
			$avail_kamar = array_values(array_diff($request->id_kamar,$kamar_exception));
			if(count($avail_kamar) >= $request->jumlah_kamar){
				for($i=1; $i<=count($avail_kamar); $i++){
					if($i==(intval($request->jumlah_kamar)+1) ){
						break;
					}else{
						for($a=0; $a<=$request->jumlah_hari; $a++){
							if($a==0){
								$hours = 14;
							}else if($a==intval(($request->jumlah_hari))){
								$hours = 12;
							}else{
								$hours=0;
							}
				   			$detail_reservasi = new M_detail_reservasi;
				   			$detail_reservasi->id_pesanan = $request->id_pesanan;
				   			$detail_reservasi->id_kamar = $avail_kamar[$i-1];
				   			$detail_reservasi->tanggal = date( "Y-m-d H:i:s", strtotime($request->day_start." +".$a." days"." +".$hours." hours" ));
				   			// $hasil[] = $detail_reservasi->save();
						}						
					}
				}
				
		   		if(in_array(false,$hasil,true)){
					$hasil = false;
		   		}else{
	    			$hasil = true;
		   		}
				
				return $hasil;		
			}else{
				return false;
			}
		}
	}

	protected function kamar_exception(Request $request){

        $order_detail = M_detail_reservasi::whereBetween('tanggal' ,array($request->day_start,$request->day_end))->get()->pluck('id_kamar');
        $kamar_exception = array();
        foreach($order_detail as $hasil){
                if(!in_array($hasil, $kamar_exception)){
                     array_push($kamar_exception, $hasil);
                }
        } 
        return $kamar_exception;

	}

    protected function validateDate($tanggal, $format = 'd-m-Y'){
        $date = new \DateTime();
        $real_date = $date->createFromFormat($format, $tanggal); 
        return $real_date;
    }

    protected function generate_total_harga($durasi,$kamar,$id_kelas){
    		$harga_kelas = M_kelas_kamar::where('id_kelas',$id_kelas)->get()->pluck('harga');
    		return intval($harga_kelas[0]*$durasi*$kamar);
    		// return intval($harga_kelas*$durasi);
    }

    protected function generate_promo($promo,$id_kamar){
    	$data_promo = M_promo::where('kode_promo',$promo)->get();
    	$total_promo = $data_promo->count();
    	if($total_promo == 1){
    		// return date("Y-m-d");
    		foreach($data_promo as $hasil){
    			if( (date("Y-m-d")>=($hasil->start)) and (date("Y-m-d")<=($hasil->end)) ){
    				// return true;
    				return $this->generate_totalharga_bypromo($hasil->promo_setting,$hasil->promo_value,$hasil->discount_max,$hasil->price_min);
    				
    			}else{
    				// return false;
					$hasil = array('boolean'=>false,
								   'report'=>"waktu promo telah habis");
					return $hasil;
    			}
    		}
    	}else{

			$hasil = array('boolean'=>false,
						   'report'=>"promo tidak ditemukan");
			return $hasil;
    		// return false;
    	}
    }


    protected function ajax_generate_promo(Request $request){
		if($request->ajax()){
	    	$data_promo = M_promo::where('kode_promo',$request->kode_promo)->get();
	    	$total_promo = $data_promo->count();
	    	if($total_promo == 1){
	    		// $hasil = "asdasdasd";
	    		foreach($data_promo as $hasil){
	    			if( (date("Y-m-d")>=($hasil->start)) and (date("Y-m-d")<=($hasil->end)) ){
	    				$hasil = $this->generate_totalharga_bypromo($request->kode_promo,$hasil->promo_setting,$hasil->promo_value,$hasil->discount_max,$hasil->price_min);
	    			}else{
						$hasil = array('boolean'=>false,
									   'report'=>"waktu promo telah habis");
	    			}
	    		}
	    	}else{
				$hasil = array('boolean'=>false,
							   'report'=>"promo tidak ditemukan");
				
	    	}
	    	return response()->json($hasil,200);
	    }else{
				return redirect('/home');
	    }
    }

    protected function generate_totalharga_bypromo($kode,$promo_sett,$promo_val,$disc_max,$price_min){
    	if(!empty(session('total_harga')) or (session('total_harga')=="") ){
    		if($promo_sett == "by_money"){
				$hasil = array('boolean'=>true,
							   'report'=>"by money");
					// cek harga min, sudah memenuhi syarat apa tidak
					if(session('total_harga')>=$price_min){
						$harga_normal = session('total_harga');
						$total_harga_promo = (session('total_harga')-$promo_val);
						session(['harga_promo'=>$total_harga_promo]);
						session(['disc'=>intval($promo_val)]);
						session(['kode_disc'=>$kode]);
						$hasil = array('boolean'=>true,
									   'harga_normal'=>$harga_normal,
									   'harga_promo'=>$total_harga_promo,
									   'disc'=>intval($promo_val));

					}else{
						$hasil = array('boolean'=>false,
									   'report'=>"pembelian minimum tidak terpenuhi");
		    			// return false;
					}				
    		}else{
				if(session('total_harga')>=$price_min){
					$harga_normal = session('total_harga');
					if( (($promo_val/100)*$harga_normal) >= $disc_max ){
						$disc = $disc_max;
					}else{
						$disc = round(($promo_val/100)*$harga_normal);
					}
					$total_harga_promo = (session('total_harga')-$disc);
					session(['harga_promo'=>$total_harga_promo]);
					session(['disc'=>intval($disc)]);
					session(['kode_disc'=>$kode]);
					$hasil = array('boolean'=>true,
								   'harga_normal'=>$harga_normal,
								   'harga_promo'=>$total_harga_promo,
								   'disc'=>$disc);
				}else{
					$hasil = array('boolean'=>false,
								   'report'=>"pembelian minimum tidak terpenuhi");
	    			// return false;
				}  				
    		}
				return $hasil;
    	}else{
				return redirect('/home');
    	}
    }

    protected function drop_sess_promo(Request $request){
		//forget session
		$request->session()->forget('harga_promo');
		$request->session()->forget('disc');
		$request->session()->forget('kode_disc');
    }

    protected function report_email_booking(Request $request,$email){
            $title = "tes mail";
            $content = "ini content";
			$data['email'] = $email;
			$data['title'] = "Report Booking";
			$data['main_message'] = "Anda sukses mas bro";
         	 Mail::send('notification.ReportMail',$data, function ($message) use ($data)
            {

                // $message->from('me@gmail.com', 'Christian Nwamba');

                $message->subject('Testing Verify Email');
                $message->to($data['email']);

            });

            // return response()->json(['message' => 'Request completed']);
       if( count(Mail::failures()) > 0 ) {
       		return Mail::failures();
       }else{
       		return true;
       }

    }

    protected function drop_sess_booking(Request $request){
		$request->session()->forget('id_kelas');
		$request->session()->forget('nama_kelas');
		$request->session()->forget('total_harga');
		$request->session()->forget('data_kamar');
		$request->session()->forget('harga_promo');
		$request->session()->forget('disc');
		$request->session()->forget('kode_disc');
		$request->session()->forget('waktu');
		$request->session()->forget('durasi');
		$request->session()->forget('jml_pengunjung');
		$request->session()->forget('time_expired');
    }

}
