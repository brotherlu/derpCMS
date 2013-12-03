<?php include TEMPLATE_PATH."/includes/header.php"; ?>

<div class="Home">

<?php foreach ($results['projects'] as $project): ?>
    <h2><?php echo $project->title; ?></h2>
<?php endforeach ?>

</div>

<?php include TEMPLATE_PATH."/includes/footer.php"; ?>
