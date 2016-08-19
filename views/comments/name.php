<?php include ROOT.'/views/layouts/header.phtml';?>

<div class="container">

    <div class="blog-header">


        <ol class="commentlist">
            <h4 class="page-heading"><span>КОМЕНТАРИИ ПО ИМЕНИ</span></h4>
            <?php foreach ($сommentName  as  $comments):?>
                <li class="comment even thread-even depth-1" id="li-comment-1">
                    <div id="comment-1" class="comment-body clearfix">
                        <img alt='' src='/template/images/<?=$comments['id']?>.jpg' height='50' width='50' />
                        <div class="comment-author vcard"><?=$comments['name']?></div>
                        <div class="comment-meta commentmetadata">
                            <span class="comment-date"></span>
                        </div>
                        <div class="comment-inner">
                            <p><?=$comments['description']?></p>
                        </div>
                        <p class="blog-post-meta"><a href="/date/<?=$comments['date']?>"><?=$comments['date']?></a> <br><a href="/name/<?=$comments['user_id']?>"><?=$comments['user_name']?></a> <br><a href="/email/<?=$comments['user_id']?>"><?=$comments['email']?></a></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>




    </div>
</div>
<?php include ROOT.'/views/layouts/footer.phtml';?>
