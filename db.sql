CREATE TABLE member (
  member_num INT AUTO_INCREMENT PRIMARY KEY COMMENT '멤버 주키',
  uname VARCHAR(20) NOT NULL COMMENT '이름',
  id VARCHAR(20) NOT NULL COMMENT '아이디',
  pw_crypt VARCHAR(100) NOT NULL COMMENT '비밀번호 암호화',
  email1 VARCHAR(20) NOT NULL COMMENT '이메일 아이디',
  email2 VARCHAR(20) NOT NULL COMMENT '이메일 주소',
  phone1 VARCHAR(20) NOT NULL COMMENT '핸드폰번호1',
  phone2 VARCHAR(20) NOT NULL COMMENT '핸드폰번호2',
  phone3 VARCHAR(20) NOT NULL COMMENT '핸드폰번호3',
  home1 VARCHAR(20) COMMENT '집전화번호1',
  home2 VARCHAR(20) COMMENT '집전화번호2',
  home3 VARCHAR(20) COMMENT '집전화번호3',
  zip VARCHAR(20) NOT NULL COMMENT '지번',
  address1 VARCHAR(50) NOT NULL COMMENT '기본주소',
  address2 VARCHAR(50) COMMENT '상세주소',
  sms BOOLEAN NOT NULL COMMENT 'sms수신',
  mailre BOOLEAN NOT NULL COMMENT '메일수신'
) ENGINE=INNODB DEFAULT CHARSET=utf8

CREATE TABLE lecture (
  lecture_num INT(11) PRIMARY KEY AUTO_INCREMENT COMMENT '강의 주키',
  lecture_kind VARCHAR(20) NOT NULL COMMENT '강의 분류',
  lecture_title VARCHAR(50) NOT NULL COMMENT '강의 제목',
  lecture_teacher VARCHAR(20) NOT NULL COMMENT '강사 이름',
  lecture_diffi VARCHAR(10) NOT NULL COMMENT '강의 난이도',
  lecture_time VARCHAR(20) NOT NULL COMMENT '강의 시간', 
  lecture_img VARCHAR(100) NOT NULL COMMENT '강의 이미지'
) ENGINE=INNODB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8


CREATE TABLE board (
  board_num INT(11) PRIMARY KEY AUTO_INCREMENT COMMENT '게시판 주키',
  board_title VARCHAR(50) NOT NULL COMMENT '글 제목',
  board_content VARCHAR(500) NOT NULL COMMENT '글 내용',
  board_satis VARCHAR(10) NOT NULL COMMENT '강의 만족도',
  board_file VARCHAR(50) COMMENT '첨부파일',
  board_date DATE NOT NULL COMMENT '등록 날짜',
  board_count INT NOT NULL COMMENT '조회수',
  member_num INT NOT NULL COMMENT '멤버 외래키',
  lecture_num INT NOT NULL COMMENT '강의 외래키',
  FOREIGN KEY (member_num) REFERENCES member(member_num),
  FOREIGN KEY (lecture_num) REFERENCES lecture(lecture_num)
) ENGINE=INNODB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8