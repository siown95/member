<?php
include "../call_index.php";
include "../db.php";
call_header();
session_start();
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
?>
<body>
<?php
call_body();
?>
<div id="container" class="container">
		<div class="search-info">
			<div class="search-form f-r">
				<select class="input-sel" style="width:158px">
					<option value="">분류</option>
				</select>
				<select class="input-sel" style="width:158px">
					<option value="">강의명</option>
					<option value="">작성자</option>
				</select>
				<input type="text" class="input-text" placeholder="강의명을 입력하세요." style="width:158px"/>
				<button type="button" class="btn-s-dark">검색</button>
			</div>
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

			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">분류</th>
					<th scope="col">강의제목</th>
					<th scope="col">강사이름</th>
					<th scope="col">강의시간</th>
				</tr>
			</thead>
	 
			<tbody>
				<?php		
                    $query = "select * from lecture";
                    $result = mysqli_query($conn, $query);
                    $total_record = mysqli_num_rows($result);
                    $list = 20;
                    $block_cnt = 5;

                    $block_num = ceil($page / $block_cnt);
                    $block_start = (($block_num-1) * $block_cnt) + 1;
                    $block_end = $block_start + $block_cnt - 1;

                    $total_page = ceil($total_record / $list);
                    if($block_end > $total_page){
                        $block_end = $total_page;
                    }
                    $total_block = ceil($total_page / $block_cnt);
                    $block_start = ($page - 1) * $list;
                    $query2 = "select lecture_num, lecture_kind, lecture_title, lecture_teacher, lecture_time from lecture order by lecture_num desc limit $block_start, $list";
                    $result2 = mysqli_query($conn, $query2);
                    while($row = mysqli_fetch_array($result2)){
						if($row == 0){
							echo '
							<tr class="bbs-sbj">
								<td colspan="5" class="last">
									등록된 강의가 없습니다!
								</td>
							</tr>';
						}else{
							$lecture_num = $row['lecture_num'];
							$lecture_kind = $row['lecture_kind'];
							$lecture_title = $row['lecture_title'];
							$lecture_teacher = $row['lecture_teacher'];
							$lecture_time = $row['lecture_time'];
							echo '
								<tr class="bbs-sbj">
								<td>'.$lecture_num.'</td>
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
					}
				?>
			</tbody>
		</table>

		<div class="box-paging">
            
            <?php
            if($page <= 1){
            }else{
                echo '<a href="index.php?page=1"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>';
            }
            if($page <= 1){
               
            }else{
                $pre = $page - 1;
                echo '<a href="index.php?page='.$pre.'"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>';
            }
            for($i = $block_start; $i <= $block_end; $i++){
                if($page == $i){
                    echo '<a class="active">'.$i.'</a>';
                }else if($i==0){
					
                }else{
					echo "<a href='index.php?page=$i'>$i</a>";
				}
            }
            if($block_num >= $total_block){
                
            }else{
                $next = $page + 1;
                echo '<a href="index.php?page='.$next.'"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>';
            }
            if($page >= $total_page){
                
            }else{
                echo '<a href="index.php?page='.$total_page.'"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>';
            }
            ?>
		</div>

		<div class="box-btn t-r">
			<a href="../index.php?mode=lecture_insert" class="btn-m">강의 등록</a>
		</div>
	</div>
</div>
<?php
call_footer();
?>
</div>
</body>
</html>
