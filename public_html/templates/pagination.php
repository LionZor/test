<div class="row  justify-content-center">
    <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="/">Первая</a></li>
        <?php for($i = -2; $i < 3; ++$i): 
            $cur_page = $page + $i;
            if($cur_page < 1 || $cur_page > $count_page)
                continue;
            $active = ($page == $cur_page) ? 'active' : ' ';
            ?>
                
            <li class="page-item <?=$active?>"><a class="page-link" href="<?=$SERVER['PHP_SELF']?>?page=<?=$cur_page?>"><?=$cur_page?></a></li>
        
        <?php endfor ?>
        <li class="page-item"><a class="page-link" href="<?=$SERVER['PHP_SELF']?>?page=<?=$count_page?>">Последняя</a></li>
    </ul>
    </nav>
</div>