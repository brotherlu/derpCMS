<?php include TEMPLATE_PATH."/includes/header.php"; ?>

<?php foreach ($results['projects'] as $project): ?>
    <h2><?php echo $project->title; ?></h2>
<?php endforeach ?>

<?php include TEMPLATE_PATH."/includes/footer.php"; ?>
