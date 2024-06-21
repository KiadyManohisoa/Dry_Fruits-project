<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session {

    public function __construct() {
        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Définir une valeur de session
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Récupérer une valeur de session
    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Détruire une valeur de session
    public function unset($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    // Détruire toutes les sessions
    public function destroy() {
        session_destroy();
    }

    // Définir plusieurs valeurs de session à partir d'un tableau
    public function set_array($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
    }
}
