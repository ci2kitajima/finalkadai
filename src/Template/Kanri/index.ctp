<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>スタンダードレイアウト</title>
    <link rel="stylesheet" href="css/boot/css/bootstrap.css">
    <link rel="stylesheet" href="css/kanri.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body">
<header class="area-line">
    <h1>商品管理ページ</h1>
</header>
<section class="area-line">
    <form class="form-inline">
        <div style="width:100%;">
            <div class="form-group form--item">
                <label for="formGroupExampleInput">商品名</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="商品名">
            </div>
            <div class="form-group form--item">
                <label for="formGroupExampleInput2">値段</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="値段">
            </div>
            <div class="form-group form--item">
                <label for="formGroupExampleInput2">個数</label>
                <input type="text" class="form-control" id="formGroupExampleInput3" placeholder="個数">
            </div>
            <div class="form-group form--item">
                <label for="sel1">ステータス</label>
                <select class="form-control" id="sel1">
                    <option>公開</option>
                    <option>非公開</option>
                </select>
            </div>
            <div class="form-group form--item">
                <label for="formGroupExampleInput2">商品画像</label>
                <input type="file" style="">
            </div>
            <div style="width:10%; margin:20px;">
                <button type="button" class="btn btn-custom"><span>登録</span></button>
            </div>
        </div>
    </form>
</section>
<section>
    <h2>商品一覧</h2>
    <table class="table">
        <thead class="thead-inverse">
        <tr>
            <th>#</th>
            <th>商品名</th>
            <th>値段</th>
            <th>商品画像</th>
            <th>個数</th>
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
                <td><?= $obj["stock"] ?></td>
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
                <h4 class="modal-title">商品編集</h4>
            </div>
            <div class="modal-body">
                <form id="updateItem">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">商品名:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">値段:</label>
                        <textarea class="form-control" id="messagee-text"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">個数:</label>
                        <textarea class="form-control" id="messageee-text"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sel1">ステータス</label>
                        <select class="form-control" id="seld1">
                            <option>公開</option>
                            <option>非公開</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">更新</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="css/boot/js/bootstrap.min.js"></script>
<script>
    $(function() {
        $('#myModal').on('show.bs.modal', function(e) {
            var id = $(this).attr("id");
            console.log(e.relatedTarget.dataset);
        });
        $('#myModal').on('hide.bs.modal', function(e) {
            var id = $(this).attr("id");
            console.log("閉じる");
        });
    });
</script>

</body>

</html>
