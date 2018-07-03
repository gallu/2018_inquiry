<html>
{*  admin_list.tpl  *}
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>

<body>

<div class="container">
<h1>問い合わせ一覧</h1>
{* $data|var_dump *}

<table class="table table-hover">
<tr>
  <th>ID
  <th>名前
  <th>作成日
{foreach from=$data item=i}
<tr>
  <td><a href="./admin_detail.php?id={$i.id}">{$i.id}</a>
  <td>{$i.name}
  <td>{$i.created_at}
  <td><a href="./admin_detail.php?id={$i.id}">詳細閲覧</a>
{/foreach}

</table>
</div>

</body>
</html>






