<?php

    include_once './user.php';

    $user = new User();

    // Create & update user
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['age']) && isset($_POST['email'])) {
        $data = [
        'first_name' => htmlentities(strip_tags($_POST['first_name'])),
        'last_name' => htmlentities(strip_tags($_POST['last_name'])),
        'age' => htmlentities(strip_tags($_POST['age'])),
        'email' => htmlentities(strip_tags($_POST['email'])),
        ];

        if (isset($_POST['id'])) {
            $data['id'] = htmlentities(strip_tags($_POST['id']));
            $user->update($data);
            } else {
            $user->create($data);
        }
    }

    // Load all users
    $allUsers = $user->list();

    // Delete user
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $user->delete($id);
    }

    ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пользователи</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script>
        function removeUserConfirmation(id) {
            if (confirm('Вы уверены что хотите удалить данного пользователя?')) {
                window.location.href = '?delete=' + id;
            }
        }
    </script>
</head>
<body>
<div class="container my-3">
    <div class="card p-3 mb-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Имя</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Возраст</th>
                <th scope="col">Email</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($allUsers)): ?>
                <?php foreach ($allUsers as $user): ?>
                    <tr>
                        <form method="POST">
                            <th scope="row"><input name="id" class="form-control" type="number" placeholder="id" value="<?= $user['id'] ?>" readonly="" required></th>
                            <td><input name="first_name" class="form-control" type="text" placeholder="Имя" value="<?= $user['first_name'] ?>" required></td>
                            <td><input name="last_name" class="form-control" type="text" placeholder="Фамилия" value="<?= $user['last_name'] ?>" required></td>
                            <td><input name="age" class="form-control" type="number" placeholder="Возраст" value="<?= $user['age'] ?>" required></td>
                            <td><input name="email" class="form-control" type="email" placeholder="Email" value="<?= $user['email'] ?>" required></td>
                            <td>
                                <div class="btn-group" role="group">
                                <button type="submit" title="Редактировать" class="btn  btn-success">
                                  Изменить
                                </button>
                                <button onclick="removeUserConfirmation(<?= $user['id'] ?>)" type="button" title="Удалить" class="btn btn-danger">
                                    Удалить
                                </button>
                                </div>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card p-3">
        <h2 class="text-center h5 pb-3">Добавление нового пользователя</h2>
        <form method="POST">
            <div class="form-floating mb-3">
                <input name="first_name" type="text" class="form-control" id="first_name" aria-describedby="Имя пользователя" placeholder="Иван" required>
                <label for="first_name">Имя</label>
            </div>
            <div class="form-floating mb-3">
                <input name="last_name" type="text" class="form-control" id="last_name" aria-describedby="Фамилия пользователя" placeholder="Иванов" required>
                <label for="last_name">Фамилия</label>
            </div>
            <div class="form-floating mb-3">
                <input name="age" type="number" max="150" class="form-control" id="first_name" aria-describedby="Возраст пользователя" placeholder="33" required>
                <label for="first_name">Возраст</label>
            </div>
            <div class="form-floating mb-3">
                <input name="email" type="text" class="form-control" id="email" aria-describedby="Email пользователя" placeholder="name@example.com" required>
                <label for="email">Email</label>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
</div>
</body>
</html>