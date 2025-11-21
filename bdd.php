<?php
function connexion($env) {
    global $env;
    try {
        $pdo = new PDO(
        $env['bddUrl'],
        $env['bddUsername'],
        $env['bddMdp']);
    } catch (Exception $e) {
        throw new Error('cannot connect to bdd');
    }
    return $pdo;
}
 ?>