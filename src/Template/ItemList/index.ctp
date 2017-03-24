<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
    <link rel="stylesheet" href="css/boot/css/bootstrap.css">
    <link rel="stylesheet" href="css/kanri.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body">
<header class="header">
    <h1 style="text-align: center;">
        Genre Search Guitar
    </h1>

    <nav class="global-nav">
        <ul>

            <li class="nav-item "><a href="/ec/top">TOP</a></li>
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
<div>
    <h1>
        <?= $title_item ?>
    </h1>
</div>
<section>

    <table class="table">
        <thead class="thead-inverse">
        <tr>
            <th>#</th>
            <th>商品名</th>
            <th>値段</th>
            <th>商品画像</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($itemList as $obj): ?>
            <tr>
                <th scope="row"><a id="o11"><a id="o11" data-toggle="modal" data-target="#myModal"
                                               data-item-name="<?= $obj["name"] ?>"
                                               data-item-id="<?= $obj["item_id"] ?>"
                                               data-item-picture="img/item/<?= $obj["picture"] ?>"
                                               data-item-price="<?= $obj["price"] ?>"
                                               data-item-stock="12"><?= $obj["item_id"] ?></a></th>
                <td><?= $obj["name"] ?></td>
                <td><?= $obj["price"] ?>円</td>
                <td><img class="image" src="img/item/<?= $obj["picture"] ?>"></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>
<!-- モーダルウィンドウの中身 -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modelTitle">商品編集</h4>
            </div>
            <div class="modal-body">
                <form id="updateItem">
                    <div class="form-group">
                        <img id="targetImg" class="image" src="" alt="">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">値段:</label>
                        <p class="" id="targetPrice"></p>
                </form>
            </div>
            <div class="modal-footer">
                <button id="cartButton" type="button" class="btn btn-primary" data-dismiss="modal">カートに入れる</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
<input id="modelID" type="hidden" name="hyouka" value="">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="css/boot/js/bootstrap.min.js"></script>
<script>
    $(function() {
        $('#myModal').on('show.bs.modal', function(e) {
            var dispData = e.relatedTarget.dataset;

            console.log(dispData);
            $("#modelTitle").text("商品名 :" +  dispData.itemName);
            $("#modelID").val(dispData.itemId);
            $("#targetPrice").text(dispData.itemPrice);
            $("#targetImg").attr('src', dispData.itemPicture);
        });

        $('#cartButton').click(function () {

            var requestData = {"item_id" : $('#modelID').val(),
                               "price" : $('#targetPrice').text()
            }
            console.log(requestData);
            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'url': '/ec/restApi/registerCart',
                'data': requestData,
                'success': function (data) {
                    if (data.code == 200) {
                        alert("カートに入れました")
                    } else {
                        // 失敗時の処理。失敗したことを伝える。
                        alert(data.message);
                    }
                },
                'error': function () {
                    // アクション側でExceptionが投げられた場合はここに来る。
                    // エラーをここで処理したい場合はExceptionを投げても良い
                }

            });
        });



        $('#myModal').on('hide.bs.modal', function(e) {
            var id = $(this).attr("id");
            console.log("閉じる");
        });
    });
</script>
</body>

</html>
