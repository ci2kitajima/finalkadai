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

    <nav class="global-nav">
        <ul>

            <li class="nav-item active"><a href="#">TOP</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=001">ROCK</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=002">METAL</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=003"> FUSION</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=004"> JAZZ</a></li>
            <li class="nav-item"><a href="/ec/itemList?genre=005">FUNK</a></li>
            <li class="nav-item nav-account"><a href="#">LOGIN</a></li>
        </ul>
        <div class="input-search-area">
            <div class="input-group ">
                <input type="text" class="form-control" placeholder="検索ワードを入力してください" aria-describedby="basic-addon2">
                <span class="input-group-addon span" id="basic-addon2">検索開始</span>
            </div>
        </div>

    </nav>
</header>
<div>
    <h1>
       Cart
    </h1>
</div>
<section>

    <table class="table">
        <thead class="thead-inverse">
        <tr>
            <th>商品名</th>
            <th>値段</th>
            <th>個数</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (cart_list as $obj): ?>
            <tr>
                <th scope="row"><a id="o11"><a id="o11" data-toggle="modal" data-target="#myModal"
                                               data-item-name="<?= $obj["name"] ?>"
                                               data-item-id="<?= $obj["item_id"] ?>"
                                               data-item-picture="<?= $obj["num"] ?>"<?= $obj["item_id"] ?></a></th>
                <td><?= $obj["name"] ?></td>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modelTitle">商品編集</h4>
                <h4 class="modal-title" id="mpdelItemId"></h4>
            </div>
            <div class="modal-body">
                <form id="updateItem">
                    <div class="form-group">
                        <img class="image" src="img/classic.jpg" alt=" CLASSIC">
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

            $("#modelTitle").text("商品名" +  dispData.itemName);
            $("#modelID").val(dispData.itemId);
            $("#targetPrice").text(dispData.itemPrice + "円");
        });

        $('#cartButton').click(function () {

            var requestData = {"item_id" : $('#modelID').val()}
            $.ajax({
                'type': 'post',
                'dataType': 'json',
                'url': '/ec/restApi/registerCart',
                'data': requestData,
                'success': function (data) {
                    var list = null;
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
