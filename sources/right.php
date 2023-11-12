<?php
$cacheFile = 'tmp/html/' . md5('information') . '.cache'; // Cache file path
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 3600) {
    $information = unserialize(file_get_contents($cacheFile));
} else {
    $information = $d->simple_fetch("select * from #_thongtin limit 0,1");
    // Cache the result
    file_put_contents($cacheFile, serialize($information));
}
$nav_left   = $d->o_fet("select * from #_category where menu=1 and hien_thi=1 order by so_thu_tu asc, id desc");
$support    = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");

$news_left  = $d->o_fet("select * from #_tintuc where noi_bat=1 and hien_thi=1 and category_id=175  order by so_thu_tu asc, id desc limit 0,10");
$tongdai = $d->getTemplates(31);

$sp_hot = $d->o_fet("select * from #_sanpham where sp_hot=1 and ".get_column_show()."=1 order by so_thu_tu asc, id desc");
$allTin = $d->simple_fetch("select * from #_category where id=175 and hien_thi=1 ");
?>

<div class="col-md-3 col-left plr10 col-right" >

<div>
        <div class="clearfix bao-left">
        
        <div class="box-search">
            <div class="d7">
                <?php 
                    if(isset($_POST['textsearch'])){
                        $url = base64_encode($_POST['textsearch']);
                        $d->location(URLPATH."search/$url.html");
                    }
                ?>
                <form method="post" action="search.html">
                <input type="text" name="textsearch" placeholder="<?=_typekey?>">
                <button type="submit"><span class="cr-search"></span><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>      
        </div>
    </div>

    <div class="clearfix bao-left">
        <h3 class="title-left title-font"><?=_support_online?></h3>
        <div class="box">

        <?php $st = 0; ?>
        <?php foreach($support as $item) { $st++; ?>
        <div class="col-md-12 col-sm-6">
            <div class="support">
                <div class="content">
                    <h4 class="hot-support"><?=$item['name_'.$_SESSION['lang']]?></h4>
                    <a href="skype:<?=$item['skype']?>?chat">
                        <img src="<?=URLPATH?>templates/images/skype.png" width="60" title="<?=$item['name_'.$_SESSION['lang']]?>">
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
        </div>
    </div>

     <div class="clearfix bao-left">
        <h3 class="title-left title-font"><?=_tongdai?></h3>
        <div class="box">
             <div class="sodt">
                 <h4><?=$information['hotline']?></h4>
             </div>  
             <div class="content-tongdai">
                 <?=$tongdai['content_'.$_SESSION['lang']]?>
             </div>    
        </div>
    </div>

    <div class="clearfix bao-left">
        <h3 class="title-left title-font"><?=_dangkynhanbantin?></h3>
        <div class="box">
            <form>
                <div class="text-dangky">
                    <?=_nhapdiachiemail?>
                </div>    
                <div class="input-dangky">
                    <input type="text" name="dangky" id="subscribe_email">
                </div> 
                <div class="clearfix dk-huy">
                    <button class="button button--naira bt-dangky" type="button" onclick="email_subscribe()"><?=_dangky?></button>
                </div>
            </form>
             
        </div>
    </div>

    <div class="clearfix bao-left">
        <h3 class="title-left title-font"><?=_news?></h3>
        <div class="box news tin-tuc">
            <?php foreach($news_left as $item) {?>
            
            <div class="item">
                <div class="img">
                    <a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=@$item['name_'.$_SESSION['lang']] ?>">
                        <img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['image_path']?>&w=450&h=400" alt="<?=@$item['name_'.$_SESSION['lang']] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
                    </a>
                </div>
                <div class="info">
                    <a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=$item['name_'.$_SESSION['lang']]?>"><?=$d->subText($item['name_'.$_SESSION['lang']],60)?></a>
                </div>
            </div>
            
            <?php } ?>
            <div class="tin-khac">
                <a href="<?=URLPATH?><?=$allTin['alias_'.$lang]?>.html"><?=_viewall?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            </div>
        </div> 
    </div>

    <div class="clearfix bao-left">
        <h3 class="title-left title-font"><?=_sanphamnoibat?></h3>
        <div class="box">            
             <div class="panel-products" id="marqueebox0" style="height:500px; overflow: hidden">
                <?php
                    if(!empty($sp_hot)){
                        foreach ($sp_hot as $key => $item) {
                            ?>
                                <div class="item">
                                    <div class="img">
                                        <a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=@$item['name_'.$_SESSION['lang']] ?>">
                                            <img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['image_path']?>&w=450&h=400" alt="<?=@$item['name_'.$_SESSION['lang']] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=$item['name_'.$_SESSION['lang']]?>"><?=$d->subText($item['name_'.$_SESSION['lang']],60)?></a>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>                                                        
            </div>
        </div>
    </div>

    
 </div>
</div>

<script type="text/javascript">
    
     function email_subscribe(){
        var name = $('#subscribe_email').val();
       if (name  === '') {
            alert('Vui lòng nhập email!.');
            return false;
        }
        if( !isValidEmailAddress( name ) ) {
            alert('Email không đúng định dạng!');
            return false;
        }
        $.ajax({
            url: './sources/ajax.php',
            type: 'post',
            data: $('#subscribe').serialize() + '&do=register_email',
            
            success: function(data) {
                if(data=='ok') {
                    alert('Đăng ký thành công!');
                    location.reload();
                }
                else {
                    alert('Xảy ra lỗi!');
                    $('#subscribe_email').val('');
                }
            }               
        }); 
    };
</script>

<script>
    function startmarquee(lh,speed,delay,index){
        var t;
        var p=false;
        var o=document.getElementById("marqueebox"+index);
        o.innerHTML+=o.innerHTML;
        o.innerHTML+=o.innerHTML;
        o.onmouseover=function(){p=true}
        o.onmouseout=function(){p=false}
        o.scrollTop = 0;
        function start(){
            t=setInterval(scrolling,speed);
            if(!p) o.scrollTop += 2;
        }
        function scrolling(){
            if(o.scrollTop%lh!=0){
                o.scrollTop += 2;
                if(o.scrollTop>=o.scrollHeight/2) o.scrollTop = 0;
            }else{
                clearInterval(t);
                setTimeout(start,delay);
            }
        }
        setTimeout(start,delay);
    }
    startmarquee(388,100,6,0);
</script>
