<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('theme');
	}
	public function index()
	{	
		
		$data['title'] = "Home";
		$this->theme->load_view($data,'welcome_message');
	}
	public function create_form()
	{	
		$data['title'] =  "create form";
		$row =  $this->input->post('number_of_row');
		$column =  $this->input->post('number_of_column');	
		$data['table']= '<form id="dynamic_form" method="post" ><div class="table-responsive"><table>';
		$lable = '';
		$nameText = '';
		$typeInput = '';
		
		for ($i=1; $i <= $row ; $i++) {
			if($i==1){ $lable = "Name :";$nameText="name[]";$typeInput = "text" ;}
			if($i==2){ $lable = "Email :";$nameText="email[]";$typeInput = "email" ;}
			if($i==3){ $lable = "Phone :";$nameText="phone[]";$typeInput = "number" ;}
			if($i==4){ $lable = "City :";$nameText="city[]"; $typeInput = "text" ;}
			if($i==5){ $lable = "State :";$nameText="state[]";$typeInput = "text" ;}
			if($i==6){ $lable = "Country :";$nameText="country[]";$typeInput = "text" ;}
			if($i==7){ $lable = "Age :";$nameText="age[]";$typeInput = "number" ;}
			if($i==8){ $lable = "Gender :";$nameText="gender[]";$typeInput = "text" ;}
			$data['table'] .= '<tr><th>'.$lable.'</th>';
			for ($j=1; $j <= $column; $j++) { 
				$data['table'] .= '<td><input type="'.$typeInput.'" name="'.$nameText.'" class="form-control" required></td>';
			}
			$data['table'] .= '</tr>';

		}
		$data['table'] .= '<tr><td><input name="row" type="hidden" value="'.$row.'"><input name="column" type="hidden" value="'.$column.'"><input id="url_save" type="hidden" value="'.site_url('save_data').'"><input type="submit" name="send_email" value="Send Email" id="send_email" class="btn btn-primary pull-right"></td><td><input type="button" name="back" value="Back" id="back" class="btn btn-primary pull-left"></td></tr></table></div></form>';
		$data['status'] = 1;
		echo json_encode($data);
			
	}
	public function save_data(){
		$this->load->model('User');
		$data = $this->input->post();
		$result = $this->User->batchInsert($data);
				
        if($result){
        	$response = $this->generatePDFFile();
        	if ($response) {
        		echo json_encode(array('status'=> 1 ,"message"=>"Email Send SuccessFully!"));
        		
        	}else{
        		echo json_encode(array('status'=> 0 ,"message"=>"Can not Create Attached DOC!"));
        	}          
        }
        else{
            echo json_encode(array('status'=> 0 ,"message"=>"Can not Save Data!"));
          
        }
        
		
	}
	// generate PDF File
     public function generatePDFFile() {
        $data = array();            
        $htmlContent='';
        $this->load->model('User');
        $count = count($this->input->post('name'));
        $to = $this->input->post('email[0]');
      	$data['getInfo'] = $this->User->get_data($count);
       
        $data['count']  = $count;
        $data['row']  = $this->input->post('row');
        $data['column']  = $this->input->post('column');
        $htmlContent = $this->load->view('pdf/attach_file', $data, TRUE);       
        $createPDFFile = time().'.pdf';
        $this->createPDF(ROOT_FILE_PATH.$createPDFFile, $htmlContent);
        $response = $this->send($to ,ROOT_FILE_PATH.$createPDFFile, $htmlContent);
        if ($response) {
    		return true;
    	} else{
    		return false;
    	} 
       
     }

    // create pdf file 
    public function createPDF($fileName,$html) {
        ob_start(); 
        // Include the main TCPDF library (search for installation path).
        $this->load->library('Pdf');
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Test');
        $pdf->SetTitle('Test');
        $pdf->SetSubject('Test');
        $pdf->SetKeywords('Test');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // set auto page breaks
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetAutoPageBreak(TRUE, 0);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }       

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // add a page
        $pdf->AddPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();       
        ob_end_clean();
        //Close and output PDF document
        $pdf->Output($fileName, 'F');        
    }
    // Email Send
    public function send($to ,$filename){
        // Load PHPMailer library
        $this->load->library('Phpmailer_library');
        
        // PHPMailer object
        $mail = $this->phpmailer_library->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.googlemail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rajniyadav263@gmail.com';
        // $mail->Username = 'youremail@gmail.com';
        $mail->Password = '9806624004@s';
        // $mail->Password = '********';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('rajniyadav263@gmail.com', 'Test');
        //$mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress($to);
        $mail->addAttachment($filename);
        
        
        // Email subject
        $mail->Subject = 'See Attached Doc';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Check This is a mail you have saved data</h1>
            <p>This is a test email sending using .</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
        	echo json_encode(array('status'=> 0 ,"message"=>"Message could not be sent.!","error"=> 'Mailer Error: ' . $mail->ErrorInfo));
        }else{
            return true;
        }
    }
}
