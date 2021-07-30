<div class="slider w-75 h-75 mx-auto">
    <?php 
    $s_news = get_news($pdo, 1, 5);
        foreach($s_news as $id => $value): ?>
        <div>
            <div class="row">
                <img class="float-left" src="<?=$value['image_large']?>" alt="" height=400></a>
                <div class="float-right col-lg col-12">
                    <h3 class="title text-center m-3">
                        <?=$value['title']?>
                    </h3>
                    <div class="text-center m-3">
                    <?=$value['announcement']?>
                    <a class="d-block" href="/show_news.php?id=<?=$id?>">Показать полностью</a>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach ?>
  </div>