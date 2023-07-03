<?php
	$this->load->view('partial/header_view');

	if(isset($main_content))
	{
		$this->load->view($main_content);
	}

	$this->load->view('partial/footer_view');
?>