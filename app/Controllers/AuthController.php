<?php

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\User;

class AuthController extends Controller
{
    //Connexion utilisateur
    public function login()
    {
        $errors = [];
        $old = [
            'email' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $old['email'] = $email;

            // Validations de base
            if ($email === '') {
                $errors[] = "L'email est obligatoire.";
            }

            if ($password === '') {
                $errors[] = "Le mot de passe est obligatoire.";
            }

            if (empty($errors)) {
                $user = User::findByEmail($email);

                if (!$user || !password_verify($password, $user['password'])) {
                    $errors[] = "Identifiants incorrects.";
                } else {
                    // si c'est bon : on connecte l'utilisateur
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $_SESSION['user_id'] = (int) $user['id'];
                    $_SESSION['user_name'] = $user['firstname'];

                    // Redirection vers la page d'accueil
                    header('Location: /');
                    exit;
                }
            }
        }

        $this->render('auth/login', [
            'errors' => $errors,
            'old' => $old,
        ]);
    }

    // Inscription de utilisateur
    public function register()
    {
        $errors = [];
        $old = [
            'firstname' => '',
            'lastname' => '',
            'email' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = trim($_POST['firstname'] ?? '');
            $lastname = trim($_POST['lastname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';

            $old['firstname'] = $firstname;
            $old['lastname'] = $lastname;
            $old['email'] = $email;

            // Validations de base
            if ($firstname === '') {
                $errors[] = "Le prénom est obligatoire.";
            }

            if ($lastname === '') {
                $errors[] = "Le nom est obligatoire.";
            }

            if ($email === '') {
                $errors[] = "L'email est obligatoire.";
            }

            if ($password === '') {
                $errors[] = "Le mot de passe est obligatoire.";
            }

            if ($password !== $passwordConfirm) {
                $errors[] = "La confirmation du mot de passe ne correspond pas.";
            }

            // Vérifier que l'email n'est pas déjà utilisé
            if (empty($errors)) {
                $existingUser = User::findByEmail($email);
                if ($existingUser) {
                    $errors[] = "Un compte existe déjà avec cet email.";
                }
            }

            if (empty($errors)) {
                $created = User::create([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => $password,
                ]);

                if ($created) {
                    // Option : connecter directement l'utilisateur après inscription
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }

                    $newUser = User::findByEmail($email);

                    $_SESSION['user_id'] = (int) $newUser['id'];
                    $_SESSION['user_name'] = $newUser['firstname'];

                    header('Location: /');
                    exit;
                } else {
                    $errors[] = "Erreur lors de la création du compte.";
                }
            }
        }

        $this->render('auth/register', [
            'errors' => $errors,
            'old' => $old,
        ]);
    }

    // Déconnexion utilisateur
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // On supprime les infos utilisateur
        unset($_SESSION['user_id'], $_SESSION['user_name']);


        header('Location: /');
        exit;
    }
}
