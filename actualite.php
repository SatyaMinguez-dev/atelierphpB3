<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";
require_once __DIR__ . "/templates/header.php";


//@todo On doit récupérer l'id en paramètre d'url et appeler la fonction getArticleById récupérer l'article
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$article = getArticleById($pdo, $id);

?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="/uploads/articles/<?php echo htmlspecialchars($article['image']); ?>" class="d-block mx-lg-auto img-fluid" alt="Article Image" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?php echo htmlspecialchars($article['title']); ?></h1>
        <p class="lead"><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
    </div>
</div>



<?php require_once __DIR__ . "/templates/footer.php"; ?>