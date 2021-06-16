<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends Site_Controller
{
    public $message = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('extra');
        $this->load->library('Auth');
        $this->load->library("phpmailer_library");
    }

    public function login()
    {
        $this->data['title'] = 'Login';
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        if ($this->form_validation->run() === TRUE)
        {
            if($this->input->method() == 'post')
            {
                $this->data['email']        = $this->input->post('email');
                $this->data['password']     = $this->input->post('password');
                $this->data['remember']     = (bool) $this->input->post('remember');
                if($this->auth->login($this->data['email'], $this->data['password'], $this->data['remember']))
                {
                    $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];
                }
                else
                {
                    $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                }
            }
        }
        else
        {
            $toast = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->message[] = ['login' => 'error', 'type' => 'error','message' => $toast];
        }
        echo json_encode($this->message);
    }

    public function register() {
        $this->data['title'] = 'Register';
        $this->form_validation->set_rules('fristname', 'fristname', 'required|trim');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('phone', 'phone', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        $this->form_validation->set_rules('repassword', 'repassword', 'required|trim');
        $this->form_validation->set_rules('sign_term', 'Please, check if you agree to our Terms, Data Policy and Cookies Policy', 'required|trim');
        //$this->form_validation->set_rules('g-recaptcha-response', 'Google captcha', 'required|trim');

        if ($this->form_validation->run() === TRUE)
        {
            if($this->input->method() == 'post')
            {
                $this->data['fristname']    = $this->input->post('fristname');
                $this->data['lastname']     = $this->input->post('lastname');
                $this->data['fullname']     = $this->input->post('fristname')." ".$this->input->post('lastname');
                $this->data['email']        = $this->input->post('email');
                $this->data['reemail']      = $this->input->post('reemail');
                $this->data['dial_code']    = $this->input->post('dial_code');
                $this->data['phone']        = $this->input->post('phone');
                $this->data['type']         = $this->input->post('type');
                $this->data['company_name'] = $this->input->post('company_name');
                $this->data['password']     = $this->input->post('password');
                $this->data['repassword']   = $this->input->post('repassword');

                if($this->data['password'] == $this->data['repassword'])
                {
                    if($this->data['type'] == 2 || $this->data['type'] == 3 || $this->data['type'] == 4)
                    {
                        $this->form_validation->set_rules('company_name', 'company_name', 'required|trim');
                        if ($this->form_validation->run() === TRUE)
                        {
                            $create_user = $this->auth->create_user($this->data['email'], $this->data['password'], $this->data['phone'], FALSE, $this->data['fullname'], $this->data['type'],$this->data['company_name']);

                            if($create_user)
                            {
                                $this->load->model('User_model');
                                $array = array(
                                    'user_groups_id' => $this->data['type'],
                                    'login_type'     => 0,
                                    'company_name'   => $this->data['company_name'],
                                    'country_code'   => $this->data['dial_code'],
                                    'slug'           => generateSeoURL($this->data['company_name']),
                                    'slug_user'           => generateSeoURL($this->data['fullname']),
                                );

                                $updata_user = $this->User_model->save_fcm($create_user,$array);


                                if($updata_user)
                                {
                                    $array = [
                                        'user_id'           => $create_user,
                                        'ntf_comp_email'    => 0,
                                        'ntf_comp_sms'      => 0,
                                        'ntf_cert_email'    => 0,
                                        'ntf_cert_sms'      => 0,
                                        'ntf_pass_email'    => 0,
                                        'ntf_pass_sms'      => 0
                                    ];
                                    $insert_ntf_settings = $this->User_model->insert_ntf_settings($array);
                                   
                                        // $this->auth->login($this->data['email'], $this->data['password'], FALSE);
                                        // $this->message[] = ['confirm' => 'success', 'type' => 'success','message' => 'Registration is completed, please confirm your account by entering URL sent to your e-mail.'];
                                        
                                        /* Send mail */


                                        $this->data['verification_code'] = $this->auth->generate_verification_code($this->data['email']);
                                        $message  = "<h1>Hi ".$this->data['company_name']."</h1>";
                                        $message .= "<h2>Thanks for registration at <a href=\"https://www.makromedicine.com\">makromedicine.com</a> </h2>";
                                        $message .= "<p>You have been successfully registrated. </p>";
                                        $message .= "<p>Please confirm your account from <a href='".base_url('authentication/confirm/').$this->data['verification_code']."'>here</a></p>";

                                        $this->sendMail([$this->data['email']], 'Confirm your account', $message);
                                        
                                        /**/
                                        $this->sendMail(['support@makromedicine.com'], 'New Account Registered', 'New Account Created: ' . $this->data['company_name']);


                                    
                                }
                                else
                                {
                                    $this->auth->login($this->data['email'], $this->data['password'], FALSE);
                                    $this->message[] = ['login' => 'error', 'type' => 'error','message' => 'Server Error ! Please Change User Information'];
                                }
                            }
                            else
                            {
                                $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                            }
                        }
                        else
                        {
                            $toast = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                            $this->message[] = ['login' => 'error', 'type' => 'error','message' => $toast];
                        }
                    }
                    else
                    {
                        $create_user = $this->auth->create_user($this->data['email'], $this->data['password'], $this->data['phone'], FALSE, $this->data['fullname'], $this->data['type'],$this->data['company_name']);
                        if($create_user)
                        {
                            $this->load->model('User_model');
                            $array = array(
                                'user_groups_id' => $this->data['type'],
                                'country_code'   => $this->data['dial_code'],
                                'slug_user'           => generateSeoURL($this->data['fullname']),
                            );
                            $updata_user = $this->User_model->save_fcm($create_user,$array);

                            if($updata_user)
                            {
                                $array = [
                                    'user_id'           => $create_user,
                                    'ntf_comp_email'    => 0,
                                    'ntf_comp_sms'      => 0,
                                    'ntf_cert_email'    => 0,
                                    'ntf_cert_sms'      => 0,
                                    'ntf_pass_email'    => 0,
                                    'ntf_pass_sms'      => 0
                                ];
                                $insert_ntf_settings = $this->User_model->insert_ntf_settings($array);

                                
                                $this->data['verification_code'] = $this->auth->generate_verification_code($this->data['email']);
                                $message  = "<h1>Hi ".$this->data['company_name']."</h1>";
                                $message .= "<h2>Thanks for registration at <a href=\"https://www.makromedicine.com\">makromedicine.com</a> </h2>";
                                $message .= "<p>You have been successfully registrated. </p>";
                                $message .= "<p>Please confirm your account from <a href='".base_url('authentication/confirm/').$this->data['verification_code']."'>here</a></p>";
                                

                                $this->sendMail([$this->data['email']], 'Confirm your account', $message);

                                if($insert_ntf_settings)
                                {
                                    $this->auth->login($this->data['email'], $this->data['password'], FALSE, NULL, TRUE);
									$this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];

                                }
                                else
                                {
                                    $this->auth->login($this->data['email'], $this->data['password'], FALSE);
									$this->data['is_loggedin'] = $this->auth->is_loggedin();
                                    $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];
                                }
                                
                            }
                            else
                            {
                                $this->auth->login($this->data['email'], $this->data['password'], FALSE);
                                $this->message[] = ['login' => 'error', 'type' => 'error','message' => 'Server Error ! Please Change User Information'];
                            }
                        }
                        else
                        {
                            $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                        }
                    }
                }
                else
                {
                    $this->message[] = ['login' => 'error', 'type' => 'error','message' => 'Password does not match'];
                }
            }
        }
        else
        {
            $toast = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->message[] = ['login' => 'error', 'type' => 'error','message' => $toast];
        }
        echo json_encode($this->message);
    }

    public function logout()
    {
        $this->auth->logout();
        redirect('/', 'refresh');
    }

    public function google()
    {
        $this->form_validation->set_rules('fullname', 'fullname', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        if ($this->form_validation->run() === TRUE)
        {
            if($this->input->method() == 'post')
            {
                $this->data['fullname'] = $this->input->post('fullname');
                $this->data['email']    = $this->input->post('email');
                $this->data['imgurl']   = $this->input->post('imgurl');
                $this->data['country']   = $this->input->post('country');
                $this->data['password'] = '1';

                $check = $this->auth->user_exist_by_email(trim($this->data['email']));
                if($check)
                {
                    $login = $this->auth->emailLogin($this->data['email']);
                    if ($login)
                    {
                        $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];
                    }
                    else
                    {
                        $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                    }
                }
                else
                {
                    $create_user = $this->auth->create_user($this->data['email'], $this->data['password'], null , FALSE, $this->data['fullname'], 6,FALSE,TRUE);
                    if($create_user)
                    {
                        $this->load->model('User_model');
                        $array = array(
                            'user_groups_id'  => 6,
                            'login_type'      => 1,
                            'country_id'      => get_country_id($this->data['country']),
                            'country_code'    => $this->data['country'],
                            'images'          => $this->data['imgurl'],
                            'slug'            => generateSeoURL($this->data['fullname']),
                            'slug_user'           => generateSeoURL($this->data['fullname']),
                        );
                        $updata_user = $this->User_model->save_fcm($create_user,$array);

                        if($updata_user)
                        {
                            $array = [
                                'user_id'           => $create_user,
                                'ntf_comp_email'    => 0,
                                'ntf_comp_sms'      => 0,
                                'ntf_cert_email'    => 0,
                                'ntf_cert_sms'      => 0,
                                'ntf_pass_email'    => 0,
                                'ntf_pass_sms'      => 0
                            ];
                            $insert_ntf_settings = $this->User_model->insert_ntf_settings($array);
                            if($insert_ntf_settings)
                            {
                                 $login = $this->auth->emailLogin($this->data['email']);
                    if ($login)
                    {
                        $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];
                    }
                    else
                    {
                        $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                    }
                            }
                            else
                            {
                                $login = $this->auth->emailLogin($this->data['email']);
                    if ($login)
                    {
                        $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];
                    }
                    else
                    {
                        $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                    }
                            }
                        }
                        else
                        {
                            $login = $this->auth->emailLogin($this->data['email']);
                    if ($login)
                    {
                        $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];
                    }
                    else
                    {
                        $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                    }
                        }
                    }
                    else
                    {
                        $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                    }
                }
                echo json_encode($this->message);
            }
        }
    }

    public function facebook()
    {
        $this->form_validation->set_rules('fullname', 'fullname', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        if ($this->form_validation->run() === TRUE)
        {
            if($this->input->method() == 'post')
            {
                $this->data['fullname'] = $this->input->post('fullname');
                $this->data['email']    = $this->input->post('email');
                $this->data['imgurl']   = $this->input->post('imgurl');
                $this->data['country']  = $this->input->post('country');
                $this->data['password'] = $this->input->post('password');

                $check = $this->auth->user_exist_by_email(trim($this->data['email']));

                if($check)
                {
                    $login = $this->auth->emailLogin($this->data['email']);
                    if ($login)
                    {
                        $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];
                    }
                    else
                    {
                        $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                    }
                }
                else
                {
                    $create_user = $this->auth->create_user($this->data['email'], $this->data['password'], null , FALSE, $this->data['fullname'], 6);
                    if($create_user)
                    {
                        $this->load->model('User_model');
                        $array = array(
                            'user_groups_id'  => 6,
                            'login_type'      => 2,
                            'country_id'      => get_country_id($this->data['country']),
                            'country_code'    => $this->data['country'],
                            'images'          => $this->data['imgurl'],
                            'slug'            => generateSeoURL($this->data['fullname']).'-'.rand(0,9999),
                            'slug_user'           => generateSeoURL($this->data['fullname']).'-'.rand(0,9999)
                        );
                        $updata_user = $this->User_model->save_fcm($create_user,$array);
                        if($updata_user)
                        {
                            $array = [
                                'user_id'           => $create_user,
                                'ntf_comp_email'    => 0,
                                'ntf_comp_sms'      => 0,
                                'ntf_cert_email'    => 0,
                                'ntf_cert_sms'      => 0,
                                'ntf_pass_email'    => 0,
                                'ntf_pass_sms'      => 0
                            ];
                            $insert_ntf_settings = $this->User_model->insert_ntf_settings($array);
                            if($insert_ntf_settings)
                            // {
                            //     $this->auth->login($this->data['email'], $this->data['password'], FALSE);
                            //     $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Login successful, Redirect....'];
                            // }
                            // else
                            // {
                                $this->auth->login($this->data['email'], $this->data['password'], FALSE);
                                $this->message[] = ['login' => 'success', 'type' => 'success','message' => 'Registration successful, Confirm Email...'];
                            // }
                        }
                        else
                        {
                            $this->auth->login($this->data['email'], $this->data['password'], FALSE);
                            $this->message[] = ['login' => 'error', 'type' => 'error','message' => 'Server Error ! Please Change User Information'];
                        }
                    }
                    else
                    {
                        $this->message[] = ['login' => 'error', 'type' => 'error','message' => $this->auth->print_errors()];
                    }
                }
                echo json_encode($this->message);
            }
        }
    }

    public function password($var)
    {
        $this->data['thisUser'] = $this->auth->get_verification_code($var);
        $frommail=(isset($_GET['m']))? true : false;
        if ($this->data['thisUser'])
        {
            if($this->input->method() == 'post')
            {
                $this->form_validation->set_rules('new_password', 'New password', 'trim|required');
                $this->form_validation->set_rules('re_password',  'Re new password', 'trim|required');
                if ($this->form_validation->run())
                {
                    $this->data['new_password'] = $this->input->post('new_password');
                    $this->data['re_password']  = $this->input->post('re_password');
                    if($this->data['new_password'] == $this->data['re_password'])
                    {
                        $updata_user = $this->auth->update_user($this->data['thisUser']->id , $this->data['thisUser']->email, $this->data['new_password']);
                        if($updata_user)
                        {
                            $reset_verification_code = $this->auth->reset_verification_code($this->data['thisUser']->id);
                            if($reset_verification_code)
                            {
                                if($frommail)
                                $this->db->set('process',2)->where('id',$this->data['thisUser']->id)->update('wc_users');
                                
                                 $mail = $this->phpmailer_library->load();
                                //Server settings
                               // $mail->SMTPDebug = 2;                                     
                                $mail->isSMTP();                                         
                                $mail->Host       = 'smtp.yandex.com';         
                                $mail->SMTPAuth   = true;                                  
                                $mail->Username   = 'support@makromedicine.com'; 
                                $mail->Password   = '72880105m';   
                                $mail->SMTPSecure = 'tls';     
                                $mail->SMTPOptions = array (
                                        'ssl' => array(
                                            'verify_peer' => false,
                                            'verify_peer_name' => false,
                                            'allow_self_signed' => true)
                                    );                             
                                $mail->Port       =587;   
                                 //Recipients
                                $mail->setFrom('support@makromedicine.com');
                                $mail->addAddress('support@makromedicine.com');     
                              
                                // Content
                                $mail->isHTML(true);                                 
                                $mail->Subject = 'Company Reset Password';
                                $mail->Body    = 'The company has reset the password.<br> Name: '.$this->data['thisUser']->company_name.' <br>E-mail:'.$this->data['thisUser']->email;
                              
                                $mail->send();

                              $this->auth->login($this->data['thisUser']->email, $this->data['new_password'], FALSE);
                              redirect('settings', 'refresh');
                            }
                            else
                            {
                              $this->data['message'][] = ['password' => 'error', 'type' => 'error','message' => 'Please try again'];
                            }
                        }
                        else
                        {
                          $this->data['message'][] = ['password' => 'error', 'type' => 'error','message' => 'Server error'];
                        }
                    }
                    else
                    {
                      $this->data['message'][] = ['password' => 'error', 'type' => 'error','message' => 'Passwords do not match'];
                    }
                }
                else
                {
                   $toast = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                   $this->data['message'][] = ['password' => 'error', 'type' => 'error','message' => $toast];
                }
            }
            $this->template->render($this->controller . '/authentication/password');
        }
        else
        {
          redirect('/?send_email=false', 'refresh');
        }
    }


     public function confirm($var)
    {
        $this->data['thisUser'] = $this->auth->get_verification_code($var);
        if ($this->data['thisUser'])
        {
            
            $this->db->set('checked', 1);
            $this->db->where('id', $this->data['thisUser']->id);
        $updata_user = $this->db->update('wc_users');
                        if($updata_user)
                        {
                            $reset_verification_code = $this->auth->reset_verification_code($this->data['thisUser']->id);
                            if($reset_verification_code)
                            {
                              $this->auth->emailLogin($this->data['thisUser']->email);
                              redirect('profile', 'refresh');
                            }
                            else
                            {
                              $this->data['message'][] = ['password' => 'error', 'type' => 'error','message' => 'Please try again'];
                               redirect('/?confirm_account=true', 'refresh');
                            }
                        }
                        else
                        {
                          $this->data['message'][] = ['password' => 'error', 'type' => 'error','message' => 'Server error'];
                           redirect('/?confirm_account=true', 'refresh');
                        }
           
        }
        else
        {
          redirect('/?confirm_account=true', 'refresh');
        }
    }

    public function reset_password($var)
    {
        $this->auth->reset_password($var);
        redirect('/?send_email=true', 'refresh');
    }

    public function forget()
    {
        if($this->input->method() == 'post')
        {
            $this->form_validation->set_rules( 'email', '', 'required' );

            if ($this->form_validation->run()){
                if($this->auth->remind_password($this->input->post('email')))
                    $this->message[] = ['forget' => 'succsess', 'type' => 'succsess','message' => 'The link has been sent to your mail address'];
                else
                    $this->message[] = ['forget' => 'error', 'type' => 'error','message' => 'Server Error'];

            }else{
                $this->message[] = ['forget' => 'error', 'type' => 'error','message' => 'Email is required'];
            }
        }
        else
        {
           $this->message[] = ['forget' => 'error', 'type' => 'error','message' => 'This email not found'];
        }
        echo json_encode($this->message);
    }
}
