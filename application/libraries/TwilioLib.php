<?php
require 'vendor/autoload.php'; // Asegúrate de que este es el camino correcto al autoload de Composer

use Twilio\Rest\Client;

class TwilioLib {
    private $sid;
    private $token;
    private $client;

    public function __construct() {
        // Credenciales de Twilio
        $this->sid = 'AC6c6620ea6f0fe9af5d66aaa8dc88ee00';
        $this->token = 'dd3aeeea1f2d7f91737086004298f917';

        // Crear cliente de Twilio
        $this->client = new Client($this->sid, $this->token);
    }

    public function send_whatsapp_message($to, $from, $body) {
        try {
            $message = $this->client->messages->create($to, [
                'from' => $from,
                'body' => $body
            ]);

            return 'Mensaje enviado con éxito! SID: ' . $message->sid;
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
