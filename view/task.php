<?php
include_once __DIR__ . '/header.php';
?>
<main>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row">
                <?php if (isset($user) && $user) { ?>
                    <div class="alert alert-success" role="alert">
                        Welcome admin!
                    </div>
                <?php } ?>

                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>№</th>
                        <?php if (isset($data['order']) && $data['order'] == "ASC") { ?>
                            <th><a href="/task?sort=name&order=DESC" class="link-info">Name</a></th>
                        <?php } else { ?>
                            <th><a href="/task?sort=name&order=ASC" class="link-info">Name</a></th>
                        <?php } ?>
                        <?php if (isset($data['order']) && $data['order'] == "ASC") { ?>
                            <th><a href="/task?sort=email&order=DESC" class="link-info">Email</a></th>
                        <?php } else { ?>
                            <th><a href="/task?sort=email&order=ASC" class="link-info">Email</a></th>
                        <?php } ?>
                        <th>Description</th>
                        <?php if (isset($data['order']) && $data['order'] == "ASC") { ?>
                            <th><a href="/task?sort=status&order=DESC" class="link-info">Status</a></th>
                        <?php } else { ?>
                            <th><a href="/task?sort=status&order=ASC" class="link-info">Status</a></th>
                        <?php } ?>
                        <?php if (isset($user) && $user) { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($tasks) && count($tasks) > 0) { ?>
                        <?php foreach ($tasks as $item) { ?>
                            <tr>
                                <td><?php echo $item['id'] ?></td>
                                <td><?php echo $item['name'] ?></td>
                                <td><?php echo $item['email'] ?></td>
                                <td><?php echo $item['text'] ?></td>
                                <?php if ($item['status'] == 0) { ?>
                                    <td>Insert</td>
                                <?php } else { ?>
                                    <td>Update</td>
                                <?php } ?>
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <td>
                                        <a href="/task.remove?id=<?php echo $item['id'] ?>"
                                           class="link-danger">Delete</a>
                                        <a href="/task.edit?id=<?php echo $item['id'] ?>" class="link-danger">Edit</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                No records found
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6 "><?php echo $pagination ?? ''; ?></div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="/task.insert" class="btn btn-primary me-md-2" type="button">Create task</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once __DIR__ . '/footer.php';
?>
