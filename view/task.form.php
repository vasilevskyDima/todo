<?php
include_once __DIR__ . '/header.php';
?>
<div class="main">
    <div class="container mt-5">
        <div class="row">
            <h1 class="mb-5">Create task</h1>
        </div>
        <div class="row">
            <form class="needs-validation" action="<?php echo isset($task) ? 'task.update' : 'task.save'; ?>" method="post" name="task">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="userName" class="form-label">Name</label>
                        <input type="text" class="form-control <?php echo isset($validation['name']) ? 'is-invalid' : ''; ?>"
                               id="username" placeholder="" value="<?php echo $task['name'] ?? '';?>" required=""
                               name="name">
                        <?php if (isset($validation['name'])) { ?>
                            <div class="invalid-feedback">
                                <?php echo $validation['name'];?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email <span class="text-muted"></span></label>
                        <input type="email" class="form-control <?php echo isset($validation['email']) ? 'is-invalid' : ''; ?>" id="email" placeholder="you@example.com" name="email" value="<?php echo $task['email'] ?? '';?>">
                        <?php if (isset($validation['email'])) { ?>
                            <div class="invalid-feedback">
                                <?php echo $validation['email'];?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-12 my-4">
                        <label for="text" class="form-label">Description</label>
                        <textarea class="form-control <?php echo isset($validation['text']) ? 'is-invalid' : ''; ?>" id="text" rows="3" name="text"><?php echo $task['text'] ?? '';?></textarea>
                        <?php if (isset($validation['text'])) { ?>
                            <div class="invalid-feedback">
                                <?php echo $validation['text'];?>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? '';?>">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/footer.php';
?>

