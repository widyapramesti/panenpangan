<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('ModelAdmin');
		$this->load->helper('form');
		$this->load->library('upload');
	}

	public function index()
	{
		$username = $this->session->username;
		if($username == null)
		{
			redirect('Admin/login');
		} else {
			$totalPetani = $this->ModelAdmin->jumlah('petani');
			$totalKategori = $this->ModelAdmin->jumlah('kategori');
			$totalBarang = $this->ModelAdmin->jumlah('barang');
			$data = [
				'nama' => $username,
				'totalPetani' => $totalPetani,
				'totalKategori' => $totalKategori,
				'totalBarang' => $totalBarang,
			];
			$this->load->view('admin/template/header',$data);
			$this->load->view('admin/template/sidebar',$data);	
			$this->load->view('admin/template/index',$data);
			$this->load->view('admin/template/footer',$data);
		}		
	}

	public function login()
	{
		$username = $this->session->username;
		if($username != null){
			redirect('Admin');
		} else{
			$this->load->view('admin/loginadmin');	
		}
		
	}


/////////////////////START-PETANI//////////////////////////

	public function petani()
	{
		$username = $this->session->username;
		if($username == null){
			redirect('Admin/login');
		} else {
			$semuaPetani = $this->ModelAdmin->getAllPetani();
			$data['dataPetani'] = $semuaPetani;
			$data['nama'] = $username;
			$data['id_petani'] = $this->ModelAdmin->getKodePetani();
			$this->load->view('admin/template/header',$data);
			$this->load->view('admin/template/sidebar',$data);	
			$this->load->view('admin/data_petani',$data);
			$this->load->view('admin/template/footer',$data);
		}
	}

	public function tambahPetani()
	{
		$id_petani = $this->input->post('id_petani');
		$nm_petani = $this->input->post('nm_petani');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');

		$data = array(
			'id_petani' => $id_petani,
			'nm_petani' =>$nm_petani,
			'tgl_lahir'=> $tgl_lahir,
			'alamat' => $alamat,
			'no_telp' => $no_telp
		);

		$result = $this->ModelAdmin->InsertPetani($data);

		$data = NULL;
		if ($result){
			$this->session->set_flashdata('pesan','Data Berhasil Disimpan');
	   		redirect('Admin/Petani');
		}else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
    		redirect('Admin/Petani');
		}
	}

	public function hapusPetani($id_petani)
	{
		$this->ModelAdmin->deletePetani($id_petani);
		$this->session->set_flashdata('pesan','Data Berhasil Dihapus');
		redirect('Admin/Petani');
	}

	public function ubahPetani()
	{
		$id_petani = $this->input->post('id_petani');
		$nm_petani = $this->input->post('nm_petani');
		$tgl_lahir = $this->input->post('tgl_lahir');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');

		$data = array(
			'nm_petani' =>$nm_petani,
			'tgl_lahir'=> $tgl_lahir,
			'alamat' => $alamat,
			'no_telp' => $no_telp
		);

		$result = $this->ModelAdmin->UpdatePetani($id_petani,$data);
		
		if (!$result){
			$this->session->set_flashdata('pesan','Data Berhasil Diubah');
    		redirect('Admin/Petani');
		}else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Diubah');
    		redirect('Admin/Petani');
		}
	}

/////////////////////END-PETANI//////////////////////////



/////////////////////START-KATEGORI//////////////////////////

	public function kategori()
	{
		$username = $this->session->username;
		if($username == null){
			redirect('Admin/login');
		} else {
			$semuaKategori = $this->ModelAdmin->getAllKategori();
			$data['dataKategori'] = $semuaKategori;
			$data['nama'] = $username;
			$data['id_kategori'] = $this->ModelAdmin->getKodeKategori();

			$this->load->view('admin/template/header',$data);
			$this->load->view('admin/template/sidebar',$data);	
			$this->load->view('admin/data_kategori',$data);
			$this->load->view('admin/template/footer',$data);
		}
		
	}

	public function tambahKategori()
	{
		$this->load->helper(array('form', 'url')); 
		$nama_file = md5(uniqid(rand(), true));
		$this->load->library('upload');
		$config = [
			'upload_path' => './assets/img/',
			'allowed_types' => 'gif|jpg|png|jpeg|bmp',
			'file_name' => $nama_file
		];

		$this->upload->initialize($config);
		  if(!$this->upload->do_upload('photo')){
		      $photo="";
		      $this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
	    	  redirect('Admin/kategori');
		  }else{
		      	$photo=$this->upload->file_name;
		       	$id_kategori = $this->input->post('id_kategori');
				$nm_kategori = $this->input->post('nm_kategori');
			
			$data = array(
			'id_kategori' => $id_kategori,
			'nm_kategori' => $nm_kategori,
			'gambar_kategori' => $photo
			);

			$result = $this->ModelAdmin->InsertKategori($data); 
			
			if ($result){
				$this->session->set_flashdata('pesan','Data Berhasil Disimpan');
	    		redirect('Admin/kategori');
			}else{
				$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
	    		redirect('Admin/kategori');
			}
		}
	}

	public function ubahKategori()
	{
		$this->load->helper(array('form', 'url')); 
		$nama_file = md5(uniqid(rand(), true));
		$this->load->library('upload');
		$config = [
			'upload_path' => './assets/img/',
			'allowed_types' => 'gif|jpg|png|jpeg|bmp',
			'file_name' => $nama_file
		];

		$this->upload->initialize($config);
		  if(!$this->upload->do_upload('photo')){

		    $id_kategori = $this->input->post('id_kategori');
			$nm_kategori = $this->input->post('nm_kategori');
				
			$data = array(
				'nm_kategori' => $nm_kategori
			);

			$result = $this->ModelAdmin->updateKategori2($data,$id_kategori,'kategori'); 
			if (!$result){
				$this->session->set_flashdata('pesan','Data Berhasil Diubah');
    			redirect('Admin/kategori');
			}else{
				$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Diubah');
    			redirect('Admin/kategori');
			}

		  }else{

			$id_kategori = $this->input->post('id_kategori');
			$nm_kategori = $this->input->post('nm_kategori');
			$photo=$this->upload->file_name;
				
			$data = array(
				'nm_kategori' => $nm_kategori,
				'gambar_kategori' => $photo
			);


			$result = $this->ModelAdmin->updateKategori($data,$id_kategori,'kategori'); 
			if (!$result){
				$this->session->set_flashdata('pesan','Data Berhasil Diubah');
    			redirect('Admin/kategori');
			}else{
				$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Diubah');
    			redirect('Admin/kategori');
			}
		}
	}

	public function hapusKategori($id_kategori)
	{
		$this->ModelAdmin->delete($id_kategori);
		$this->session->set_flashdata('pesan','Data Berhasil Dihapus');
		redirect('Admin/Kategori');
	}

/////////////////////END-KATEGORI//////////////////////////



/////////////////////START-BARANG//////////////////////////

	public function barang()
	{
		$username = $this->session->username;
		if($username == null){
			redirect('Admin/login');
		} else {
			$joinBarang = $this->ModelAdmin->joinBarang();
			$semuaBarang = $this->ModelAdmin->getAllBarang();
			$semuaKategori = $this->ModelAdmin->getAllKategori();
			$data['joinBarang'] = $joinBarang;
			$data['dataKategori'] = $semuaKategori;
			$data['dataBarang'] = $semuaBarang;
			$data['id_brg'] = $this->ModelAdmin->getKodeBarang();
			$data['nama'] = $username;
			$this->load->view('admin/template/header',$data);
			$this->load->view('admin/template/sidebar',$data);	
			$this->load->view('admin/data_barang',$data);
			$this->load->view('admin/template/footer',$data);
		}
	}

	public function tambahBarang()
	{
		$this->load->helper(array('form', 'url')); 
		$nama_file = md5(uniqid(rand(), true));
		$this->load->library('upload');
		$config = [
			'upload_path' => './assets/img/',
			'allowed_types' => 'gif|jpg|png|jpeg|bmp',
			'file_name' => $nama_file
		];

		$this->upload->initialize($config);
		  if(!$this->upload->do_upload('photo')){
		      $photo="";
		  }else{
		      	$photo=$this->upload->file_name;
		       	$id_barang = $this->input->post('id_brg');
				$nm_barang = $this->input->post('nm_brg');
				$stok = $this->input->post('stok');
				$harga = $this->input->post('harga');
				$ongkir = $this->input->post('ongkir');
				$rating = $this->input->post('rating');
				$deskripsi = $this->input->post('deskripsi');
				$id_kategori = $this->input->post('kategori');
			
			$data = array(
				'id_brg' => $id_barang,
				'nm_brg' => $nm_barang,
				'stok' => $stok,
				'harga' => $harga,
				'ongkir' => $ongkir,
				'rating' => $rating,
				'gambar_barang' => $photo,
				'deskripsi' => $deskripsi,
				'id_kategori' => $id_kategori    
			);

			$result = $this->ModelAdmin->InsertBarang($data); 
			
			if ($result){
				$this->session->set_flashdata('pesan','Data Berhasil Disimpan');
	    		redirect('Admin/barang');
			}else{
				$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
	    		redirect('Admin/barang');
			}
		}	
	}

	public function ubahBarang()
	{
		$this->load->helper(array('form', 'url')); 
		$nama_file = md5(uniqid(rand(), true));
		$this->load->library('upload');
		$config = [
			'upload_path' => './assets/img/',
			'allowed_types' => 'gif|jpg|png|jpeg|bmp',
			'file_name' => $nama_file
		];

		$this->upload->initialize($config);
		  if(!$this->upload->do_upload('photo')){
		    
		    $id_barang = $this->input->post('id_brg');
			$nm_barang = $this->input->post('nm_brg');
			$stok = $this->input->post('stok');
			$harga = $this->input->post('harga');
			$ongkir = $this->input->post('ongkir');
			$rating = $this->input->post('rating');
			$deskripsi = $this->input->post('deskripsi');
			$id_kategori = $this->input->post('kategori');
				
			$data = array(
				'nm_brg' => $nm_barang,
				'stok' => $stok,
				'harga' => $harga,
				'ongkir' => $ongkir,
				'rating' => $rating,
				'deskripsi' => $deskripsi,
				'id_kategori' => $id_kategori    
			);

			$result = $this->ModelAdmin->updateBarang2($data,$id_barang,'barang'); 
			if (!$result){
				$this->session->set_flashdata('pesan','Data Berhasil Diubah');
    			redirect('Admin/barang');
			}else{
				$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Diubah');
    			redirect('Admin/barang');
			}
			

		  }else{

			$id_barang = $this->input->post('id_brg');
			$nm_barang = $this->input->post('nm_brg');
			$stok = $this->input->post('stok');
			$harga = $this->input->post('harga');
			$ongkir = $this->input->post('ongkir');
			$deskripsi = $this->input->post('deskripsi');
			$rating = $this->input->post('rating');
			$photo=$this->upload->file_name;
			$id_kategori = $this->input->post('kategori');
				
			$data = array(
				'nm_brg' => $nm_barang,
				'stok' => $stok,
				'harga' => $harga,
				'ongkir' => $ongkir,
				'rating' => $rating,
				'deskripsi' => $deskripsi,
				'gambar_barang' => $photo,
				'id_kategori' => $id_kategori    
			);

			$result = $this->ModelAdmin->updateBarang($data,$id_barang,'barang'); 
			if (!$result){
				$this->session->set_flashdata('pesan','Data Berhasil Diubah');
    			redirect('Admin/barang');
			}else{
				$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Diubah');
    			redirect('Admin/barang');
			}
		}
	}

	public function hapusBarang($id_barang)
	{
		$this->ModelAdmin->deleteBarang($id_barang);
		$this->session->set_flashdata('pesan','Data Berhasil Dihapus');
		redirect('Admin/barang');
	}

/////////////////////END-BARANG//////////////////////////
}
