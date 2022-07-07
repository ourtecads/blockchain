<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Explorer extends Guess_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
      $this->data['page'] = 'Bitcoin Explorer';
    
	    if($this->input->post('txid')) {
      if (strlen($this->input->post('txid')) < 35) {                    // Identify post request is hash or an address, for easy ways to identity it, just count the lenght of the posted value, bitcoin address lenght is not more than 34       
          return redirect('explorer/addr/'.$this->input->post('txid')); // redirect to /addr/ if user request to check address
      }else{
	        return redirect('explorer/tx/'.$this->input->post('txid'));   // redirect to /addr/ if user request to check tx hash
      }
	}
		$this->render('explorer', $this->data);
		
	}
	
	public function tx($tx = '')                            //function to handle hash request
	{
    $this->data['page'] = 'Trancaction: '.$tx;			      // get the transaction hash from url
    $url = "https://blockchain.info/rawtx/$tx";           // get data from blochain
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $this->data['trans'] = json_decode($result, TRUE);    // return as array
		$this->render('explorer', $this->data);
		
	}
	
	public function addr($addr = '')                          // function to handle address request
	{
    $this->data['page'] = 'Address: '.$addr;			          // get the address from url
    $url = "https://blockchain.info/balance?active=$addr";  // get data from blochain
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $this->data['address'] = json_decode($result, TRUE); //return as array
    $this->data['the_address'] = $addr;
		$this->render('explorer', $this->data);
	}

}
