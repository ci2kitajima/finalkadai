<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>top</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style0.css">
    <link rel="stylesheet" href="css/boot/css/bootstrap.css">
</head>

<body>
<header class="header">
    <h1>
        Genre Search Guitar
    </h1>
    <nav class="global-nav">
        <ul>

            <li class="nav-item"><a href="/ec/top">TOP</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=1">ROCK</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=2">METAL</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=3"> FUSION</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=4"> JAZZ</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=5">FUNK</a></li>

            <?php if (!$loginFlg) { ?>
                <li class="nav-item nav-account"><a href="/ec/login">LOGIN</a></li>
            <?php } else { ?>
                <li class="nav-item nav-account"><a id="li_logout">LOGOUT</a></li>
                <li class="nav-item "><a href="/ec/carts">CART</a></li>
            <?php } ?>
        </ul>
        <form action="/ec/itemList" method="get">
            <div class="input-search-area">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="検索ワードを入力してください"
                           name="word" aria-describedby="basic-addon2">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">検索</button>
                    </span>
                </div>
            </div>
        </form>

    </nav>
</header>
<div class="main">
    <div class="rank-container header item">
        <h2>注目のギター</h2>
        <nav class="rank">
            <ul>
                <?php foreach ($rank as $obj): ?>
                    <li class="rank-item"><a href="<?= $obj['name'] ?>"><?= $obj['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <div id="masonry-container" style="width:100%;">
        <h1>

        </h1>
        <section class="item item-l item-gakki0">
            <a href="#">
                <img class="image" src="img/rock.jpg" alt="ROCK">
                <div class="category">ROCK</div>
                <p class="description">ROCKギターについて</p>
            </a>
        </section>
        <section class="item item-m item-gakki1">
            <a href="#">
                <img class="image" src="img/metal.jpg" alt="METAL">
                <div class="category">METAL</div>
                <p class="description">METALギターについて</p>
            </a>
        </section>
        <section class="item item-m item-gakki0">
            <a href="#">
                <img class="image" src="img/fusion.jpg" alt=" FUSION">
                <div class="category">FUSION</div>
                <p class="description">FUSIONギターについて</p>
            </a>
        </section>
        <section class="item item-gakki0">
            <a href="#">
                <img class="image" src="img/jazz.jpg" alt=" JAZZ">
                <div class="category">JAZZ</div>
                <p class="description">JAZZギターについて</p>
            </a>
        </section>
        <section class="item item-gakki1">
            <a href="#">
                <img class="image" src="img/funk.jpg" alt="FUNK">
                <div class="category">FUNK</div>
                <p class="description">FUNKギターについて</p>
            </a>
        </section>
        <section class="item item-m item-gakki2">
            <a href="#">
                <img class="image" src="img/classic.jpg" alt=" CLASSIC">
                <div class="category">CLASSIC</div>
                <p class="description">CLASSICギターについて</p>
            </a>
        </section>
        <section class="item item-m item-gakki2">
            <a href="#">
                <img class="image" src="img/info.jpg" alt="お知らせ">
                <div class="category">お知らせ</div>
                <p class="description"></p>
            </a>
        </section>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.js"></script>
<script>
    $(function () {
        $('#li_logout').click(function () {
            alert("ログアウトしました。");
            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'url': '/ec/restApi/logout',
                'success': function (data) {
                    if (data.code == 200) {
                        location.reload();
                    } else {
                    }
                },
                'error': function () {

                }
            });
        });
    });


    new Masonry('#masonry-container', {
        itemSelector: '.item',
        columnWidth: 180,
        gutter: 4
    });


</script>
</body>

</html>
