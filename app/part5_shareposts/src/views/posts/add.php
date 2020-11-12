<?php require APP_ROOT . '/views/include/header.php'; ?>
<a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light">
    <i class="fa fa-backward"></i>
    Back
</a>
<div class="card card-body bg-light mt-5">
    <h2>Add Post</h2>
    <p>Create a post</p>
    <form action="<?php echo URL_ROOT; ?>/posts/add" method="post">
        <div class="form-group">
            <label for="email">Title: </label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="body">Content:</label>
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
        </div>
        <input type="submit" class="btn btn-success" value="ADD">
    </form>
</div>
<?php require APP_ROOT . '/views/include/footer.php'; ?>