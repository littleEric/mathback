<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>题库</title>
	<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
</head>
<body>


	<div class="wrapper">
		<div class="container">
			<div class="row">

				<div class="span12">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>题库</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>id</th>
											<th>题目</th>
											<th>选项1</th>
											<th>选项2</th>
											<th>选项3</th>
											<th>选项4</th>
											<th>选项5</th>
                                            <th>操作</th>
										</tr>
									</thead>
									<tbody id="tbody">

									</tbody>
								</table>
							</div>
						</div><!--/.module-->

					<br />

					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

</body>
<script src="js/jquery.js"></script>
<script>
    $.post("getAll.php", function(data){
        console.log(data);
        var bightml = '';
        for(i=0;i<data.length;i++){
            var html = '<tr class="odd gradeX">';
            var obj = JSON.parse(data[i]);
            html += "<td>" + obj.id + "</td>";
            html += '<td><img src="' + obj.question + '"></td>';
            for(j = 0;j<obj.option.length;j++){
                html += '<td><img src="' + obj.option[j].src + '"></td>';
            }
            for(k=obj.option.length;k<5;k++){
                html += '<td></td>';
            }
            html += '<td><button class="btn-primary">删除</button></td></tr>';
            bightml += html;
        }
        $("#tbody").append(bightml);
        //按钮点击，执行删除操作
        $("button").click(function () {
            //待删除题目的id
            var id = $(this).parent().parent().children().first().text();
            $.post("deletebyid.php",{id:id}, function(data){
                location.reload();
            });
        });
    });

</script>
</html>