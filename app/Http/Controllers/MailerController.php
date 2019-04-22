<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailer;
use PHPMailer\PHPMailer\PHPMailer;

class MailerController extends Controller
{

    /**
     * Index
     * Traz a view da página de contato
     */
    public function index() {
        return view('mailPage');
    }
    
    /**
     * Send Mail
     * @description     Faz o envio de e-mail de acordo com o arquivo de
     *                  configuração no .env e inserção de dados do banco
     */
    public function sendMail(Request $req) {
        try {

            // checando se o método é um POST
            if(!$req->isMethod('post')) {
                return response()->json([
                    'error' => [
                        'description' => "Apenas requisições POST"
                    ]
                ], 400);
            }

            // inicializa o Model Mailer
            $mailer = new Mailer();


            /**
             * Checa se há arquivo e se o arquivo é válido
             * se tudo for true, logo ele cria um novo nome pro arquivo
             * e move o arquivo para a pasta public/archives e preenchendo o nome do arquivo
             * na nova inserção do banco
             * 
             * caso dê errado, ele retorna um 400 com a mensagem de erro
             */
            if($req->hasFile('file') && $req->file('file')->isValid()) {
                $file = $req->file('file');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $mailer->file = $filename;
                $file->move('./archives/', $filename);
                
            } else {
                return response()->json([
                    'error' => [
                        'description' => 'Não há arquivo'
                    ]
                ], 400);
            }

            // preenchendo a nova inserção no banco
            $mailer->name = $req->input('name');
            $mailer->email = $req->input('email');
            $mailer->phone = $req->input('phone');
            $mailer->message = $req->input('message');
            $mailer->ip = $_SERVER['REMOTE_ADDR'];

            // checando se há erros ao inserir no banco
            if(!$mailer->save()) {
                return response()->json([
                    'error' => [
                        'description' => 'Não foi possível salvar o e-mail'
                    ]
                ], 400);
            }

            // criando envio de e-mail
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_SECURE');
            $mail->Port = env('MAIL_PORT');

            $mail->setFrom($req->input('email'), $req->input('name'));
            $mail->addAddress (env('MAIL_TO'), env('MAIL_TO_NAME'));

            $mail->Subject = 'Netshow.me Test';
            $mail->isHTML(true);
            $mail->Body = "<p> ". $req->input('message') ." </p>";

            // checando se não há erros no envio do e-mail
            if(!$mail->send()) {
                return response()->json([
                    'error' => [
                        'description' => $mail->ErrorInfo
                    ]
                ], 400);
            }

            // se tudo tiver OK retorna um 200 com sua respectiva mensagem
            return response()->json([
                'result' => 'OK'
            ]);

        } catch (\Exception $e) {
            
            // retorna um erro caso o try seja comprometido
            return response()->json([
                    'error' => [
                        'description' => $e->getMessage()
                    ]
                ], 400);
        }
    }
}
