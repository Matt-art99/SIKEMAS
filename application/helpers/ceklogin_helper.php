<?php

function ceklogin()
{
  $ci = get_instance();
  if ( !$ci->session->userdata('nik')) {
    redirect('auth');
  }
}

function ceklogin_admin()
{
  $ci = get_instance();
  if ( !$ci->session->userdata('admin')) {
    redirect('auth');
  }
}

function ceklogin_petugas()
{
  $ci = get_instance();
  if ( !$ci->session->userdata('petugas')) {
    redirect('auth');
  }
}
