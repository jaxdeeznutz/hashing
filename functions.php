<?php

require_once "config.php";

function get_pepper()
{
    global $PEPPER;
    $pepper = isset($PEPPER) ? trim((string) $PEPPER) : "";
    if ($pepper === "") {
        throw new RuntimeException("PEPPER is missing in config.php.");
    }
    return $pepper;
}

function generate_salt($length = 16)
{
    $bytes = random_bytes($length);
    return base64_encode($bytes);
}

function hash_password($password, $salt)
{
    $combined = $password . $salt . get_pepper();
    return hash("sha256", $combined);
}

function register_user($email, $password)
{
    $email = trim($email);
    if ($email === "" || $password === "") {
        return "Email and password are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Please enter a valid email address.";
    }

    $salt = generate_salt();
    $password_hash = hash_password($password, $salt);

    try {
        $pdo = get_db_connection();
        $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, salt) VALUES (:e, :h, :s)");
        $stmt->execute([
            ":e" => $email,
            ":h" => $password_hash,
            ":s" => $salt,
        ]);
        return "Registration successful.";
    } catch (PDOException $e) {
        if ($e->getCode() === "23000") {
            return "That email is already registered.";
        }
        return "An error occurred during registration.";
    }
}

function verify_login($email, $password)
{
    $email = trim($email);
    if ($email === "" || $password === "") {
        return false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $pdo = get_db_connection();
    $stmt = $pdo->prepare("SELECT email, password_hash, salt FROM users WHERE email = :e");
    $stmt->execute([":e" => $email]);
    $row = $stmt->fetch();

    if (!$row) {
        return false;
    }

    $candidate_hash = hash_password($password, $row["salt"]);
    return hash_equals($row["password_hash"], $candidate_hash);
}

