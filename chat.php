<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" id=""></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" id=""></td>
            </tr>
            <tr>
                <td>Your message:</td>
                <td><textarea name="message" id="" cols="30" rows="10"></textarea></td>
            </tr>
        </table>
    </form>
    
</body>
</html>