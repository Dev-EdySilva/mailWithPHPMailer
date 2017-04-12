<html>
    <head>
        <title>Testando envio de e-mails</title>
        <meta charset="utf-8" />
    </head>
    
    <body>
       
        <h2>Testando envio de emails usando PHPMailer</h2>
        
        <form method="post">
            <label>Seu nome :</label>
            <input type="text" name="name" />
            
            <label>Seu e-mail :</label>
            <input type="text" name="email" />
            
            <label>Sua mensagem :</label>
            <input type="text" name="message" />
            
            <br>
            <button name="send">Enviar</button>
        </form>
        
        <?php
            /*
             
                MAIL_DRIVER=smtp
                MAIL_HOST=br528.hostgator.com.br
                MAIL_PORT=587
                MAIL_USERNAME=contato@redtagmobile.com.br
                MAIL_PASSWORD=Redtag2016#
                MAIL_ENCRYPTION=tls
             
             */
             
            require_once './PHPMailer/class.smtp.php';
            require_once './PHPMailer/class.phpmailer.php';
        
            if( isset( $_POST['send'] ) ){
                
                $name = filter_input(INPUT_POST, 'name');
                $email = filter_input(INPUT_POST, 'email');
                $message = filter_input(INPUT_POST, 'message');
                
                echo "<strong>Nome :</strong>$name<br> <strong>E-mail :</strong>$email<br> <strong>Mensagem :</strong>$message<br>";
                
                $mail = new PHPMailer(true);
                
                $mail->isSMTP();
                
                try{
                    
                    $mail->Host = 'br528.hostgator.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
                    $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
                    $mail->Port       = 587; //  Usar 587 porta SMTP
                    $mail->Username = 'contato@redtagmobile.com.br'; // Usuário do servidor SMTP (endereço de email)
                    $mail->Password = 'Redtag2016#'; // Senha do servidor SMTP (senha do email usado)
                    $mail->SMTPSecure='tls';

                    //Define o remetente
                    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
                    $mail->SetFrom('contato@redtagmobile.com.br', 'Contato RedTag'); //Seu e-mail
                    $mail->AddReplyTo('info@redtagmobile.com.br', 'RedTag Mobile'); //Seu e-mail
                    $mail->Subject = 'Testando envio de e-mails com PHPMailer';//Assunto do e-mail


                    //Define os destinatário(s)
                    //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//                    $mail->AddAddress('e-mail@destino.com.br', 'Teste Locaweb');
                    $mail->addAddress($email, $name);

                    //Campos abaixo são opcionais 
                    //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
                    //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
                    //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo


                    //Define o corpo do email
                    $mail->MsgHTML("Olá <strong>$name</strong>, parece que você escreveu isso para nós<br>\"$message\""); 

                    ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
                    //$mail->MsgHTML(file_get_contents('arquivo.html'));

                    $mail->Send();
                    echo "Mensagem enviada com sucesso</p>\n";
                    
                } catch (phpmailerException $e) {
                    die($e->getMessage());
                }
                
            }
        ?>
        
    </body>
</html>