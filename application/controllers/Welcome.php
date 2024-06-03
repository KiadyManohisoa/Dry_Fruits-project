<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function index() {
		 $this->load->view('welcome_message');
	 }

	 public function newIndex ($number) {
		 //Redirige l'utilisateur vers le profil

		 //redirect('index.php/ForTemplate/about');
		 $data['contents'] = '<div class=\"content\"> <p>I\'m the content </p> </div>';
		 $data['number'] = $number;

		 $this->load->view('template',$data);
	 }

	 public function accueil() {
		 $data = array();
		 $data['pseudo'] = 'Rakoto';
		 $data['email'] = 'rakoto@mada.com';
		 $data['en_ligne'] = true;

		 //Maintenant les variables sont disponibles dans la vue
		 $this->load->view('vueAccueil',$data);
	 }

	 public function manger($plat = '',$boisson = '') {
		 $data ['plat'] = 'Voici votre menu : <br/> '.$plat.'<br/>'.$boisson.'<br/> Bon appétit';
		 $this->load->view('test',$data);
	 }

	 public function bonjour ($pseudo='') {
		 echo 'Salut à toi : '.$pseudo.'<br/>';
		 echo 'Variable id : '.$this->input->get('id');

		 // $data['info'] = 'Salut à toi : '.$pseudo.'<br/>';
		 // $this->load->view('test',$data);

	 }

	// public function index()
	// {
	// 	$this->load->view('welcome_message');
	//
	// }
}
