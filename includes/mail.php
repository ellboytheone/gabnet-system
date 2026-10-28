<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . '/../vendor/autoload.php';

    function enviarCodigo($destino, $nome, $codigo){

        $mail = new PHPMailer(true);

        try{

            //Servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;

            //EMAIL DO SISTEMA
            $mail->Username   = 'gabnetportaldeinformacoes@gmail.com';

            //PASSWORD DE APP
            $mail->Password   = 'jzbylfjzobpywmhf';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //UTF8
            $mail->CharSet = 'UTF-8';

            //Remetente
            $mail->setFrom('gabnetportaldeinformacoes@gmail.com', 'GABnet - Portal de Informações');

            //Destino
            $mail->addAddress($destino, $nome);

            //Conteúdo
            $mail->isHTML(true);

            $mail->Subject = 'Código de activação da conta';

            $mail->Body = <<<HTML
                    <div style="margin:0;padding:0;background-color:#f4f7fb; font-family:Arial,Helvetica,sans-serif;">
                    
                    <table width="100%" cellpadding="0" cellspacing="0" style="border: 0;background-color:#f4f7fb;padding:40px 0;">
                        <tr>
                            <td align="center">

                                <table width="600" cellpadding="0" cellspacing="0"  
                                    style="border: 0;background:#ffffff;border-radius:18px;overflow:hidden;
                                    box-shadow:0 8px 25px rgba(0,0,0,0.08);">

                                    <!-- Header -->
                                    <tr>
                                        <td 
                                            style="background:linear-gradient(135deg,#0f172a,#1e3a8a);
                                            padding:35px;text-align:center;">

                                            <h1 style="color:#ffffff;margin:0;font-size:32px;">
                                                GABnet
                                            </h1>

                                            <p style="color:#cbd5e1;margin-top:8px;font-size:14px;">
                                                Sistema Web de Consulta de Informações Escolares
                                            </p>
                                        </td>
                                    </tr>

                                    <!-- Conteúdo -->
                                    <tr>
                                        <td style="padding:45px 40px;color:#1e293b;">

                                            <h2 style="margin-top:0;font-size:26px;color:#0f172a;">
                                                Activação da tua conta
                                            </h2>

                                            <p style="font-size:16px;line-height:1.7;margin-bottom:20px;">
                                                Saudações! <strong>{$nome}</strong>,
                                            </p>

                                            <p style="font-size:16px;line-height:1.7;margin-bottom:30px;">
                                                Recebemos um pedido para activar a tua conta no 
                                                <strong>GABnet</strong>.
                                            </p>

                                            <!-- Código -->
                                            <div style="text-align:center;margin:35px 0;">

                                                <div style="
                                                    display:inline-block;
                                                    background:#eff6ff;
                                                    border:2px dashed #2563eb;
                                                    border-radius:14px;
                                                    padding:20px 35px;
                                                ">

                                                    <span style="
                                                        font-size:36px;
                                                        font-weight:bold;
                                                        color:#1d4ed8;
                                                        letter-spacing:10px;
                                                        font-family:Courier New, monospace;
                                                    ">
                                                        {$codigo}
                                                    </span>

                                                </div>

                                            </div>

                                            <p style="font-size:15px;line-height:1.7;color:#475569;">
                                                Este código expira em 
                                                <strong>20 minutos</strong>.
                                            </p>

                                            <p style="font-size:15px;line-height:1.7;color:#475569;">
                                                Se não foste tu que fizeste este pedido, podes ignorar este e-mail.
                                            </p>

                                        </td>
                                    </tr>

                                    <!-- Footer -->
                                    <tr>
                                        <td style="
                                            background:#f8fafc;
                                            padding:25px;
                                            text-align:center;
                                            border-top:1px solid #e2e8f0;
                                        ">

                                            <p style="margin:0;font-size:13px;color:#64748b;">
                                                © 2026 GABnet • Todos os direitos reservados
                                            </p>

                                        </td>
                                    </tr>

                                </table>

                            </td>
                        </tr>
                    </table>

                </div>
            HTML;

            return $mail->send();
        }catch(Exception $e){
            return false;
        }
    }