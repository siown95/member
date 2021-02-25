<?php
session_start();
include "../header.php";
include "../body.php";
include "../db.php";
$kind = $_GET['kind'];
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$title = $_POST['title'];
$select = $_POST['select'];
$kind = $_POST['kind'];
if($select == '강의명'){
    if(!empty($kind)){
        $query = "select board_num from board, lecture 
        where board.lecture_num=lecture.lecture_num and lecture_kind='$kind' and lecture_title like '%$title%' order by board_num desc";
    }else{
        $query = "select board_num from board, lecture
        where board.lecture_num=lecture.lecture_num and lecture_title like '%$title%' order by board_num desc";
    }
}else{
    if(!empty($kind)){
        $query = "select board_num from board, member, lecture 
        where board.member_num=member.member_num and board.lecture_num=lecture.lecture_num and lecture_kind='$kind' and uname like '%$title%' order by board_num desc";
    }else{
        $query = "select board_num from board, member
        where board.member_num=member.member_num and uname like '%$title%' order by board_num desc";
    }
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
		$paging .= '<a href="board_list.html?page=1"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>';
	}
	if($page != 1){
		$paging .= '<a href="board_list.html?page='.$prevPage.'"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>';
	}
	for($i=$firstPage; $i<=$lastPage; $i++){
		if($i==$page){
			$paging .= '<a class="active">'.$i.'</a>';
		}else{
			$paging .= '<a href="board_list.html?page='.$i.'">'.$i.'</a>';
		}
	}
	if($page != $lastPage){
		$paging .= '<a href="board_list.html?page='.$nextPage.'"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>';
	}
	if($page != $allPage){
		$paging .= '<a href="board_list.html?page='.$allPage.'"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>';
	}
	$currentLimit = ($onePage * $page) - $onePage;
}

?>
<div id="container" class="container">
	<?php
	include "../lnb.php";
	?>
    	<table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs">
			<caption class="hidden">검색결과</caption>
			<colgroup>
				<col style="width:8%"/>
				<col style="width:10%"/>
				<col style="*"/>
				<col style="width:15%"/>
				<col style="width:12%"/>
			</colgroup>
			<div class="search-info">
			<div class="search-form f-r">
				<form action="board_search.php?page=1" method="POST">
					<select class="input-sel" style="width:158px" name="kind">
						<option value="">분류</option>
						<option value="일반직무">일반직무</option>
						<option value="산업직무">산업직무</option>
						<option value="공통역량">공통역량</option>
						<option value="어학 및 자격증">어학 및 자격증</option>
					</select>
					<select class="input-sel" style="width:158px" name="select">
						<option value="강의명">강의명</option>
						<option value="작성자">작성자</option>
					</select>
					<input type="text" id="title" name="title" class="input-text" placeholder="강의명을 입력하세요." style="width:158px"/>
					<input type="submit" class="btn-s-dark" value="검색" onclick="return submitChk()">
				</form>
			</div>
		</div>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">분류</th>
					<th scope="col">제목</th>
					<th scope="col">강좌만족도</th>
					<th scope="col">작성자</th>
				</tr>
			</thead>
	 
			<tbody>
				<?php
					if($row == 0){
					echo '
						<tr class="bbs-sbj">
							<td colspan="5" class="last">
								등록된 후기가 없습니다!
							</td>
						</tr>';
					}
					if($select == '강의명'){
                        if(!empty($kind)){
                            $query2 = "select board_num, board_title, board_satis, uname, lecture_title, lecture_kind from board, member, lecture  
                            where board.member_num=member.member_num and board.lecture_num=lecture.lecture_num and lecture_kind='$kind' and lecture_title like '%$title%' order by board_num desc limit $currentLimit, $onePage";
                        }else{
                            $query2 = "select board_num, board_title, board_satis, uname, lecture_title, lecture_kind from board, member, lecture
                            where board.member_num=member.member_num and board.lecture_num=lecture.lecture_num and lecture_title like '%$title%' order by board_num desc limit $currentLimit, $onePage";
                        }
                    }else{
                        if(!empty($kind)){
                            $query2 = "select board_num, board_title, board_satis, uname, lecture_title, lecture_kind from board, member, lecture 
                            where board.member_num=member.member_num and board.lecture_num=lecture.lecture_num and lecture_kind='$kind' and uname like '%$title%' order by board_num desc limit $currentLimit, $onePage";
                        }else{
                            $query2 = "select board_num, board_title, board_satis, uname, lecture_title, lecture_kind from board, member, lecture
                            where board.member_num=member.member_num and board.lecture_num=lecture.lecture_num and uname like '%$title%' order by board_num desc limit $currentLimit, $onePage";
                        }
                    }
					              
                    $result2 = mysqli_query($conn, $query2);
                    while($row2 = mysqli_fetch_array($result2)){
						$board_num = $row2['board_num'];
						$board_title = $row2['board_title'];
						$board_satis = $row2['board_satis'];
						$uname = $row2['uname'];
						$lecture_title = $row2['lecture_title'];
						$lecture_kind = $row2['lecture_kind'];
						echo '
							<tr class="bbs-sbj">
								<td>'.$board_num.'</td>
								<td>'.$lecture_kind.'</td>
								<td>
									<a href="board_read.html?page=1&num='.$board_num.'">
									<span class="tc-gray ellipsis_line">수강 강의명 : '.$lecture_title.'</span>
									<strong class="ellipsis_line">'.$board_title.'</strong>
									</a>
								</td>
								<td>
									<span class="star-rating">';
										if($board_satis==5){
										echo '<span class="star-inner" style="width:100%"></span>';	
										}else if($board_satis==4){
										echo '<span class="star-inner" style="width:80%"></span>';
										}else if($board_satis==3){
										echo '<span class="star-inner" style="width:60%"></span>';
										}else if($board_satis==2){
										echo '<span class="star-inner" style="width:40%"></span>';
										}else{
										echo '<span class="star-inner" style="width:20%"></span>';
										}
							echo'	</span>
								</td>
								<td class="last">'.$uname.'</td>
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
			<?php
			if(isset($_SESSION['userid'])){
				echo '<a href="/index.php?mode=list" class="btn-m">목록</a>';
			}
			?>
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
			alert("검색어를 입력하세요!");
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