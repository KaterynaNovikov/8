<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
</head>
<body>
    <h1>Students</h1>
    <form method="post" action="/college/students/addStudent">
        <input type="text" name="name" placeholder="Name" required>
        <select name="group_id" required>
            <option value="">Select Group</option>
            <?php
            $groups = (new StudentsModel())->getGroups();
            foreach ($groups as $group) {
                echo "<option value='{$group['id']}'>{$group['name']}</option>";
            }
            ?>
        </select>
        <button type="submit">Add Student</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Group</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id']; ?></td>
            <td><?= $student['name']; ?></td>
            <td><?= $student['group_name']; ?></td>
            <td>
                <form method="post" action="/college/students/actions">
                    <input type="hidden" name="id" value="<?= $student['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
