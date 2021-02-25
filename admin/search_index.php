<?php
session_start();
include "../header.php";
include "../body.php";
include "../db.php";
if($_SESSION['userid']==''){
	echo '<script>alert("관리자 로그인이 필요합니다.");location.href="/member/login.html";</script>';
} else if($_SESSION['userid']!='admin'){
	echo '<script>alert("관리자만 접근 가능합니다.");history.back();</script>';
}
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$title = $_POST['title'];
$kind = $_POST['kind'];
if(!empty($kind)){
	$query = "select lecture_num from lecture where lecture_kind='$kind' and lecture_title like '%$title%' order by lecture_num desc";
}else{
	$query = "select lecture_num from lecture where lecture_title like '%$title%' order by lecture_num desc";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);
					
$allPost = $row;
				
$onePage = 20;
$allPage = ceil($allPost / $onePage);
					
if($page < 1 || ($allPage && $page > $allPage)){
	echo '<script>alert("존재하지 않는 페이지 입니다.");history.back();</script>';
	exit;
}					
$oneSection = 5;
$currentSection = ceil($page / $oneSection);
$allSection = ceil($allPage / $oneSection);
$firstPage = ($currentSection * $oneSection) - ($oneSection - 1);
if($currentSection == $allSection){
	$lastPage = $allPage;
}else{
	$lastPage = $currentSection * $oneSection;
}		
$prevPage = $page - 1 ;
$nextPage = $page + 1;

$paging = '';
if($row == 0){
	$paging = '<a class="active">1</a>';
}else{
	if($page != 1){
		$paging .= '<a href="index.php?page=1"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>';
	}
	if($page != 1){
		$paging .= '<a href="index.php?page='.$prevPage.'"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>';
	}
	for($i=$firstPage; $i<=$lastPage; $i++){
		if($i==$page){
			$paging .= '<a class="active">'.$i.'</a>';
		}else{
			$paging .= '<a href="index.php?page='.$i.'">'.$i.'</a>';
		}
	}
	if($page != $lastPage){
		$paging .= '<a href="index.php?page='.$nextPage.'"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>';
	}
	if($page != $allPage){
		$paging .= '<a href="index.php?page='.$allPage.'"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>';
	}
	$currentLimit = ($onePage * $page) - $onePage;
}
?>

<div id="container" class="container">
<div class="tit-box-h3">
	<h3 class="tit-h3">강의 검색 결과</h3>
</div>
		<table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs">
			<caption class="hidden">수강후기</caption>
			<colgroup>
				<col style="width:8%"/>
				<col style="width:8%"/>
				<col style="*"/>
				<col style="width:15%"/>
				<col style="width:12%"/>
			</colgroup>
			<div class="search-info">
			<div class="search-form f-r">
				<form action="search_index.php?page=1" method="POST">
					<select class="input-sel" style="width:158px" name="kind">
						<option value="">분류</option>
						<option value="일반직무">일반직무</option>
						<option value="산업직무">산업직무</option>
						<option value="공통역량">공통역량</option>
						<option value="어학 및 자격증">어학 및 자격증</option>
					</select>
					<select class="input-sel" style="width:158px">
						<option value="">강의명</option>
					</select>
					<input type="text" id="title" name="title" class="input-text" placeholder="강의명을 입력하세요." style="width:158px"/>
					<input type="submit" class="btn-s-dark" onclick="return submitChk();" value="검색">
				</form>
			</div>
		</div>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">분류</th>
					<th scope="col">강의명</th>
					<th scope="col">강사이름</th>
					<th scope="col">강의시간</th>
				</tr>
			</thead>
	 
			<tbody>
				<?php
					if($row == 0){
						echo '
							<tr class="bbs-sbj">
								<td colspan="5" class="last">
									등록된 강의가 없습니다!
								</td>
							</tr>';
					}		
                    if(!empty($kind)){
						$query2 = "select lecture_num, lecture_kind, lecture_title, lecture_teacher, lecture_time from lecture where lecture_kind='$kind' and lecture_title like '%$title%' order by lecture_num desc limit $currentLimit, $onePage";
					}else{
						$query2 = "select lecture_num, lecture_kind, lecture_title, lecture_teacher, lecture_time from lecture where lecture_title like '%$title%' order by lecture_num desc limit $currentLimit, $onePage";
					}
                    $result2 = mysqli_query($conn, $query2);
					$count = mysqli_num_rows($result2);
					$i = $count;
                    while($row = mysqli_fetch_array($result2)){
						$lecture_num = $row['lecture_num'];
						$lecture_kind = $row['lecture_kind'];
						$lecture_title = $row['lecture_title'];
						$lecture_teacher = $row['lecture_teacher'];
						$lecture_time = $row['lecture_time'];
						echo '
							<tr class="bbs-sbj">
								<td>'.$i--.'</td>
								<td>'.$lecture_kind.'</td>
								<td>
									<a href="lecture_read.html?page=1&num='.$lecture_num.'">
									<span class="tc-gray ellipsis_line">'.$lecture_title.'</span>
									</a>
								</td>
								<td>
								<span class="tc-gray ellipsis_line">'.$lecture_teacher.'</span>
								</td>
								<td class="last">'.$lecture_time.'</td>
							</tr>';
						
					}
				?>
			</tbody>
		</table>

		<div class="box-paging">
            
            <?php
            echo $paging;
            ?>
		</div>

		<div class="box-btn t-r">
			<a href="../index.php?mode=admin" class="btn-m">목록</a>
		</div>
	</div>
</div>
<?php
include "../footer.php";
?>
</div>
<script>
	function submitChk(){
		var title = document.getElementById("title").value;
		if(title == ''){
			alert("강의명을 입력하세요!");
			return false;
		}else if(title.length<2){
			alert("2글자 이상 입력하세요!");
			return false;
		}else{
			return true;
		}
	}

</script>
</body>
</html>
