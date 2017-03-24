<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>カート一覧</title>
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
<div>
    <h1>
        Cart
    </h1>
</div>
<section>
    <h2>
        合計：<?= $cart_count ?>円
    </h2>
    <button id="buyButton" type="button" class="btn btn-primary" data-dismiss="modal">購入</button>
</section>
<section>


    <table class="table">
        <thead class="thead-inverse">
        <tr>
            <th>#</th>
            <th>商品名</th>
            <th>値段</th>
            <th>個数</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart_list as $obj): ?>
            <tr>
                <th scope="row"><a id="o11" data-toggle="modal" data-target="#myModal"
                                   data-item-name="<?= $obj["name"] ?>"
                                   data-item-id="<?= $obj["item_id"] ?>"
                                   data-item-price="<?= $obj["price"] ?>"
                                   data-item-picture="img/item/<?= $obj["picture"] ?>"
                                   data-item-num="<?= $obj["num"] ?>"><?= $obj["item_id"] ?></a></th>
                <td><?= $obj["name"] ?></td>
                <td><?= $obj["price"] ?>円</td>
                <td><?= $obj["num"] ?></td>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modelTitle"></h4>
                <h4 class="modal-title" id="mpdelItemId"></h4>
            </div>
            <div class="modal-body">
                <form id="updateItem">
                    <div class="form-group">
                        <img id="targetImg" class="image" src="img/classic.jpg" alt=" CLASSIC">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">値段:</label>
                        <p class="" id="targetPrice"></p>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">個数:</label>
                        <textarea class="form-control" id="targetNum"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="changeCartItemNum" type="button" class="btn btn-primary" data-dismiss="modal">変更する</button>
                <button id="deleteCartItem" type="button" class="btn btn-primary" data-dismiss="modal">削除</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
<input id="modelID" type="hidden" name="hyouka" value="">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="css/boot/js/bootstrap.min.js"></script>
<script>
    $(function () {
        $('#myModal').on('show.bs.modal', function (e) {
            var dispData = e.relatedTarget.dataset;
            console.log(dispData);

            $("#modelTitle").text("商品名" + dispData.itemName);
            $("#modelID").val(dispData.itemId);
            $("#targetPrice").text(dispData.itemPrice + "円");
            $("#targetNum").text(dispData.itemNum);
            $("#targetImg").attr('src', dispData.itemPicture);
        });

        $('#changeCartItemNum').click(function () {
            var requestData = {
                "item_id": $('#modelID').val(),
                "num": $('#targetNum').val()
            }
            console.log(requestData);
            alert("変更しました");
            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'url': '/ec/restApi/changeCartItemNum',
                'data': requestData,
                'success': function (data) {
                    alert("変更しました");
                    console.log(data);
                    var list = null;
                    if (data.code == 200) {
                        alert("変更しました");
                        location.reload();
                    } else if (data.code == 300) {
                        // 失敗時の処理。失敗したことを伝える。
                        alert(data.message);
                    } else {

                    }
                },
                'error': function () {
                    location.reload();

                }
            });
        });

        $('#deleteCartItem').click(function () {
            var requestData = {"item_id": $('#modelID').val()}
            alert("削除しました");
            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'url': '/ec/restApi/deleteCartItem',
                'data': requestData,
                'success': function (data) {
                    var list = null;
                    if (data.code == 200) {
                        alert("削除しました");
                        location.reload();
                    } else {
                        // 失敗時の処理。失敗したことを伝える。
                        alert(data.message);
                        location.reload();
                    }
                },
                'error': function () {
                    location.reload();
                    // アクション側でExceptionが投げられた場合はここに来る。
                    // エラーをここで処理したい場合はExceptionを投げても良い
                }
            });
        });

        $('#buyButton').click(function () {
            alert("購入しました");
            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'url': '/ec/restApi/buy',
                'success': function (data) {
                    if (data.code == 200) {
                        location.reload();

                    } else {
                        alert(data.message);
                    }
                },
                'error': function () {
                    location.reload();
                    // アクション側でExceptionが投げられた場合はここに来る。
                    // エラーをここで処理したい場合はExceptionを投げても良い
                }
            });
        });


        $('#myModal').on('hide.bs.modal', function (e) {
            var id = $(this).attr("id");
            console.log("閉じる");
        });
    });
</script>
</body>

</html>
