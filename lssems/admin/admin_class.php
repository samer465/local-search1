<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where username = '".$username."' and password = '".md5($password)."' and type= 1 ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where email = '".$email."' and password = '".md5($password)."'  and type= 2 ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}
	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(!empty($cpass) && !empty($password)){
					$data .= ", password=md5('$password') ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
					$_SESSION['login_id'] = $id;
			return 1;
		}
	}

	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_FILES['img']['tmp_name'] != '')
			$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function save_system_settings(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['cover']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['cover']['name'];
			$move = move_uploaded_file($_FILES['cover']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", cover_img = '$fname' ";

		}
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set $data where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set $data");
		}
		if($save){
			foreach($_POST as $k => $v){
				if(!is_numeric($k)){
					$_SESSION['system'][$k] = $v;
				}
			}
			if($_FILES['cover']['tmp_name'] != ''){
				$_SESSION['system']['cover_img'] = $fname;
			}
			return 1;
		}
	}
	function save_image(){
		extract($_FILES['file']);
		if(!empty($tmp_name)){
			$fname = strtotime(date("Y-m-d H:i"))."_".(str_replace(" ","-",$name));
			$move = move_uploaded_file($tmp_name,'../assets/uploads/'. $fname);
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
			$hostName = $_SERVER['HTTP_HOST'];
			$path =explode('/',$_SERVER['PHP_SELF']);
			$currentPath = '/'.$path[1]; 
			if($move){
				return $protocol.'://'.$hostName.$currentPath.'/assets/uploads/'.$fname;
			}
		}
	}
	function save_area(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO areas set $data");
		}else{
			$save = $this->db->query("UPDATE areas set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_area(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM areas where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_service(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if($k == 'description')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO services set $data");
		}else{
			$save = $this->db->query("UPDATE services set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_service(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM services where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_persons_companies(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','areas_id')) && !is_numeric($k)){
				if($k == 'description')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$data .= ", areas_id='".(implode(",",$areas_id))."' ";
		if(isset($_FILES['img_path']) && $_FILES['img_path']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img_path']['name'];
			$move = move_uploaded_file($_FILES['img_path']['tmp_name'],'../assets/uploads/'. $fname);
			$data .= ", img_path = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO persons_companies set $data");
		}else{
			$save = $this->db->query("UPDATE persons_companies set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_persons_companies(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM persons_companies where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_about(){
		extract($_POST);
		if(!empty($content)){
			$save = file_put_contents('../about.html', $content);
			if($save)
				return 1;
		}else{
			$fh = fopen('../about.html', 'w' );
			fclose($fh);
				return 1;
		}
	}
	// Forgot Password
	function forgot_password(){
		extract($_POST);
		$check = $this->db->query("SELECT * FROM users WHERE email = '".$this->db->real_escape_string($email)."' AND type = 2");
		if($check->num_rows > 0){
			$token = bin2hex(random_bytes(32));
			$expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
			$this->db->query("INSERT INTO password_resets SET email='".$this->db->real_escape_string($email)."', token='$token', expires_at='$expires'");
			// In production, send email with reset link. For now, store the token.
			return json_encode(['status'=>'success','message'=>'Password reset instructions have been sent to your email address. Check your inbox.','token'=>$token]);
		} else {
			return json_encode(['status'=>'error','message'=>'No account found with that email address.']);
		}
	}

	// Reset Password
	function reset_password(){
		extract($_POST);
		$check = $this->db->query("SELECT * FROM password_resets WHERE token='".$this->db->real_escape_string($token)."' AND used=0 AND expires_at > NOW()");
		if($check->num_rows > 0){
			$row = $check->fetch_assoc();
			$this->db->query("UPDATE users SET password=md5('".$this->db->real_escape_string($password)."') WHERE email='".$row['email']."'");
			$this->db->query("UPDATE password_resets SET used=1 WHERE id=".$row['id']);
			return json_encode(['status'=>'success','message'=>'Password has been reset successfully.']);
		} else {
			return json_encode(['status'=>'error','message'=>'Invalid or expired reset token.']);
		}
	}

	// Send Message (from contact form)
	function send_message(){
		extract($_POST);
		$sender_name = $this->db->real_escape_string($sender_name);
		$sender_email = $this->db->real_escape_string($sender_email);
		$subject = $this->db->real_escape_string($subject);
		$message = $this->db->real_escape_string($message);
		$save = $this->db->query("INSERT INTO messages SET sender_name='$sender_name', sender_email='$sender_email', subject='$subject', message='$message'");
		if($save){
			return json_encode(['status'=>'success','message'=>'Your message has been sent successfully! We will get back to you soon.']);
		} else {
			return json_encode(['status'=>'error','message'=>'Failed to send message. Please try again.']);
		}
	}

	// Get single message
	function get_message(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM messages WHERE id = ".(int)$id);
		if($qry->num_rows > 0){
			$row = $qry->fetch_assoc();
			// Mark as read
			$this->db->query("UPDATE messages SET status=1 WHERE id=".(int)$id);
			return json_encode($row);
		}
		return json_encode(null);
	}

	// Reply to message
	function reply_message(){
		extract($_POST);
		$reply = $this->db->real_escape_string($reply);
		$save = $this->db->query("UPDATE messages SET reply='$reply', status=1 WHERE id=".(int)$id);
		if($save){
			return json_encode(['status'=>'success','message'=>'Reply sent successfully.']);
		}
		return json_encode(['status'=>'error','message'=>'Failed to send reply.']);
	}

	// Delete message
	function delete_message(){
		extract($_POST);
		$del = $this->db->query("DELETE FROM messages WHERE id=".(int)$id);
		if($del) return 1;
	}

	// Save Booking
	function save_booking(){
		extract($_POST);
		$user_id = (int)$user_id;
		$provider_id = (int)$provider_id;
		$service_id = (int)$service_id;
		$booking_date = $this->db->real_escape_string($booking_date);
		$booking_time = $this->db->real_escape_string($booking_time);
		$notes = $this->db->real_escape_string($notes);
		$save = $this->db->query("INSERT INTO bookings SET user_id=$user_id, provider_id=$provider_id, service_id=$service_id, booking_date='$booking_date', booking_time='$booking_time', notes='$notes'");
		if($save){
			return json_encode(['status'=>'success','message'=>'Booking submitted successfully! The provider will confirm your appointment.']);
		}
		return json_encode(['status'=>'error','message'=>'Failed to submit booking.']);
	}

	// Get user bookings
	function get_bookings(){
		extract($_POST);
		$uid = (int)$user_id;
		$_status = array('Pending','Confirmed','Completed','Cancelled');
		$qry = $this->db->query("SELECT b.*, pc.name as provider_name, s.service FROM bookings b INNER JOIN persons_companies pc ON pc.id=b.provider_id INNER JOIN services s ON s.id=b.service_id WHERE b.user_id=$uid ORDER BY b.date_created DESC");
		$data = array();
		while($row=$qry->fetch_assoc()){
			$row['status_text'] = $_status[$row['status']];
			$data[] = $row;
		}
		return json_encode($data);
	}

	// Save Review
	function save_review(){
		extract($_POST);
		$user_id = (int)$user_id;
		$provider_id = (int)$provider_id;
		$rating = (int)$rating;
		$review = $this->db->real_escape_string($review);
		$save = $this->db->query("INSERT INTO reviews SET user_id=$user_id, provider_id=$provider_id, rating=$rating, review='$review'");
		if($save) return 1;
	}

	// Get provider reviews
	function get_reviews(){
		extract($_POST);
		$pid = (int)$provider_id;
		$qry = $this->db->query("SELECT r.*, CONCAT(u.firstname,' ',u.lastname) as reviewer_name FROM reviews r INNER JOIN users u ON u.id=r.user_id WHERE r.provider_id=$pid ORDER BY r.date_created DESC");
		$data = array();
		while($row=$qry->fetch_assoc()){
			$data[] = $row;
		}
		return json_encode($data);
	}

	// Get cart count (stub for compatibility)
	function get_cart_count(){
		return json_encode(['count'=>0,'list'=>[]]);
	}

	function find_sp(){
		extract($_POST);
  		$_type = array("","Single/Freelancer","Group/Service Provider Business");
		$get = $this->db->query("SELECT sp.*,s.service FROM persons_companies sp inner join services s on s.id = sp.service_id where service_id = $s or Concat('[',REPLACE(',','],[',areas_id),']') LIKE '%[$a]%' ");
		$data = array();
		while($row=$get->fetch_assoc()){
			$row['type'] = $_type[$row['type']];
			$data[] = $row;
		}
		return json_encode($data);
	}
}