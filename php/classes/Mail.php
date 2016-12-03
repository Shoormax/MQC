<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 28/11/2016
 * Time: 19:22
 */
class Mail {
    /**
     * @var string
     */
    public $to;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $headers;

    /**
     * Mail constructor.
     *
     * @author Valentin Dérudet
     *
     * @param $to
     * @param $subject
     * @param $message
     * @param $headers
     */
    public function __construct($to, $subject, $message, $headers) {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;
    }

    /**
     * Méthode permettant d'envoyer un mail
     *
     * @author Valentin Dérudet
     *
     * @return bool
     */
    public function send() {
        return mail($this->to, $this->subject, $this->message, $this->headers);
    }
}