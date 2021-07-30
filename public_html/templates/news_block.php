
<div class="col-lg-3 col-md-4 col-sm-6  news">
  <div class="card h-100">
    <a href="/show_news.php?id=<?=$id?>">
      <img src="<?=$image?>" alt="" class="card-img-top" alt>
    </a>
    <div class="card-body d-flex flex-column justify-content-end p-1">
      <div class="card-title font-weight-bold text-center"><?=$title?></div>
      <div class="card-text font-weight-italic text-center h-100"><?=$ann?>
      <hr \>
      <div class="row">
        <span class="text-xl-left  text-center col-6 col-sm-12 col-xl-6"><?=$date?></span>
        <a href="/show_news.php?id=<?=$id?>" class="text-center text-xl-right col-6 col-sm-12 col-xl-6">Далее...</a>
      </div>
      <div class="row">

        <form class="col-12 my-1" action="edit_news.php" method="GET">
          <input type="hidden" name="id" value="<?=$id?>">
          <button  class="btn btn-outline-primary btn-block px-0" type="submit" class="delete">Редактировать</button>
        </form>

        <form class="col-12 my-1 " action="delete_news.php" method="POST" onsubmit='if(confirm("Удалить?")){ return true}else {return false}'>
                          <input type="hidden" name="id" value="<?=$id?>">
                          <button  class="btn btn-outline-danger btn-block px-0" type="submit" class="delete">Удалить</button>
        </form>

      </div>
      </div>
    </div>
  </div>
</div>
