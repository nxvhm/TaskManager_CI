<div class="content">
    <div class="header">
        <span>TASKMANAGER</span>
    </div>
    <blockquote class="box rounded marginAuto">
        <span>Create Account</span> <br />
        <!--Render Login Form-->
        <?php
        
            $attr = array('class'=>'silver', 'id'=>'registerForm');    //Attributes for form
            $userAttr = array(
                'name'=>'username',
                'size'=>'28',
                'maxlength'=>'16',
                'class'=>'rounded',
            );
            $passAttr = array(
                'name'=>'password',
                'size'=>'28',
                'maxlength'=>'16',
                'class'=>'rounded',
            );
          $passAttr2 = array(
                'name'=>'password2',
                'size'=>'28',
                'maxlength'=>'16',
                'class'=>'rounded',
            );
            $buttonAttr = array(
                'class'=>'button1 rounded',
                'name'=>'submit',
                'type'=>'submit',
                'content'=>'Create Account',
            );
            $emailAttr = array(
                'name'=>'email',
                'size'=>'28',
                'maxlength'=>'24',
                'class'=>'rounded',
            );
            echo form_open('register', $attr);
            
            echo form_label('Username', 'username');
            echo form_input($userAttr);
            echo form_error('username'); // show an error message next to each form field,
            
            echo form_label('Password', 'password');
            echo form_password($passAttr);
            echo form_error('password');
            
            echo form_label('Repeat Password', 'password2');
            echo form_password($passAttr2);
            echo form_error('password2');
            
            echo form_label('Email Adress', 'Email');
            echo form_input($emailAttr);
            echo form_error('email');
            echo form_button($buttonAttr);
           echo form_close();
        ?>
        <!--//Render Login Form-->
    </blockquote>
</div>


