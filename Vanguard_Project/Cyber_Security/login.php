<?php
require 'vendor/autoload.php';
require_once 'db.php';
use Firebase\JWT\JWT;

$secret_key = 'your_secret_key_here';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $token = JWT::encode(
                [
                    'iat' => time(),
                    'exp' => time() + 3600,
                    'data' => [
                        'user_id' => $user['id'],
                        'username' => $user['username']
                    ]
                ],
                $secret_key,
                'HS256'
            );

            setcookie("token", $token, time() + 3600, "/", "", true, true);
            header("Location: home.php");
            exit();
        } else {
            $error = 'Password salah';
        }
    } else {
        $error = 'Username tidak ditemukan';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <?php if ($error): ?>
        <div style="color: red;"> <?php echo $error; ?> </div>
    <?php endif; ?>
</body>
</html>