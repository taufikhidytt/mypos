<?php 

// function jika sudah login
function ada_session()
{
    $ci =& get_instance();
    $session = $ci->session->userdata('user_id');
    if($session)
    {
        echo "<script>
            alert('Anda Sudah Login, Silahkan Cari Tombol Logout Untuk Keluar');
            document.location='".base_url('dashboard')."';
            </script>";
    }
}

// function jika belum login
function ga_ada_session()
{
    $ci =& get_instance();
    $session = $ci->session->userdata('user_id');
    if(!$session)
    {
        echo "<script>
            alert('Anda Belum Login, Silahkan Login Terlebih Dahulu');
            document.location='".base_url('auth/login')."';
            </script>";
    }
}

// function jika dia admin atau kasir
function check_admin()
{
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->user_login()->level != 1){
        redirect('dashboard');
    }
}

?>