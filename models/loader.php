<?php
class Loader{
    public $db;
    public function __construct($db){
        $this->db = $db;
    }
    
    public function getTeacherClass($teacherid=NULL, $classid=NULL){
        $select_content6=("select DISTINCT class, l.id from teacherclasses t inner join classes l on l.id=t.classid where teacherid ='$teacherid' order by class asc");
        $content_result6= mysqli_query($this->db, $select_content6) or die(mysqli_error($this->db));
        $content6 = mysqli_fetch_assoc($content_result6);
        $num_chk6 = mysqli_num_rows($content_result6);
        do{	
            $seleted = '';
            if($content6['id'] == $classid){ $seleted = 'selected="selected"'; }
        ?>
            <option value="<?php echo $content6['id']?>" <?php echo $seleted ?>> <?php echo $content6["class"]?></option>
        <?php
        }while($content6 = mysqli_fetch_assoc($content_result6));
    }

    public function getTeacherGroup($teacherid=NULL, $groupid=NULL){
        $select_content6=("select DISTINCT groupname, g.gid from teacherclasses t inner join groups g on g.gid=t.groupid where teacherid ='$teacherid' order by groupname");
        $content_result6= mysqli_query($this->db, $select_content6) or die(mysqli_error($this->db));
        $content6 = mysqli_fetch_assoc($content_result6);
        $num_chk6 = mysqli_num_rows($content_result6);
        do{	
            $seleted = '';
            if($content6['gid'] == $groupid){ $seleted = 'selected="selected"'; }
        ?>
            <option value="<?php echo $content6['gid']?>" <?php echo $seleted ?>> <?php echo $content6["groupname"]?></option>
        <?php
        }while($content6 = mysqli_fetch_assoc($content_result6));
    }

    public function getClassTeacher($teacherid=NULL, $classid=NULL){
        $select_content6=("select DISTINCT class, l.id from class_teacher t inner join classes l on l.id=t.classid where teacherid ='$teacherid' order by class asc");
        $content_result6= mysqli_query($this->db, $select_content6) or die(mysqli_error($this->db));
        $content6 = mysqli_fetch_assoc($content_result6);
        $num_chk6 = mysqli_num_rows($content_result6);
        do{	
            $seleted = '';
            if($content6['id'] == $classid){ $seleted = 'selected="selected"'; }
        ?>
            <option value="<?php echo $content6['id']?>" <?php echo $seleted ?>> <?php echo $content6["class"]?></option>
        <?php
        }while($content6 = mysqli_fetch_assoc($content_result6));
    }

    public function getClassTeacherGroup($teacherid=NULL, $groupid=NULL){
        $select_content6=("select DISTINCT groupname, g.gid from class_teacher t inner join groups g on g.gid=t.groupid where teacherid ='$teacherid' order by groupname");
        $content_result6= mysqli_query($this->db, $select_content6) or die(mysqli_error($this->db));
        $content6 = mysqli_fetch_assoc($content_result6);
        $num_chk6 = mysqli_num_rows($content_result6);
        do{	
            $seleted = '';
            if($content6['gid'] == $groupid){ $seleted = 'selected="selected"'; }
        ?>
            <option value="<?php echo $content6['gid']?>" <?php echo $seleted ?>> <?php echo $content6["groupname"]?></option>
        <?php
        }while($content6 = mysqli_fetch_assoc($content_result6));
    }

    public function getSubjectBase($where=NULL, $subid=NULL){
        $select_content1=("select subjectid from teacherclasses $where"); 
        $content_result1= mysqli_query($this->db, $select_content1) or die(mysqli_error($this->db));
        $content1 = mysqli_fetch_assoc($content_result1);
        do{	
            $subjectid = $content1["subjectid"];
            $sql2 = "SELECT sid, subject FROM subjects where sid='$subjectid' and status !='2'";
            $query2 = mysqli_query($this->db, $sql2)or die("The error resulted due to:: ".mysqli_error($this->db));
            $contents = mysqli_fetch_assoc($query2);
            $seleted = '';
            if($contents["sid"] == $subid){ $seleted = 'selected="selected"'; }
        ?>
            <option value="<?php echo $contents["sid"] ?>" <?php echo $seleted ?>> <?php echo $contents["subject"] ?></option>
        <?php
        }while($content1 = mysqli_fetch_assoc($content_result1));
    }	  

    public function getClassName($classid=NULL, $subid=NULL){
        $select_content1=("select * from classes where id='$classid'");
        $content_result1= mysqli_query($this->db, $select_content1) or die(mysqli_error($this->db));
        $content1 = mysqli_fetch_assoc($content_result1);
        return $content1['class'];
    }

    function getTopicById($topic_id){
        $sql = "SELECT * FROM ada_topics WHERE topic_id = '$topic_id'";
        $result = mysqli_query($this->db, $sql) or die(mysqli_error($this->db));
        $content1 = mysqli_fetch_assoc($result);
        return $content1['topic'];
    }

    function getSubCatById($sub_cat){
        $select_content2= sprintf("select * from sub_category where category_id = '$sub_cat'");
        $content_result2= mysqli_query($this->db, $select_content2) or die(mysqli_error($this->db));
        $content2 = mysqli_fetch_assoc($content_result2);//var_dump($content2);exit;
        return $content2['sub_category'];
    }

    function getSchoolById($class){
        $select_content4= sprintf("select * from schools where schoolid = '$class'");
    $content_result4= mysqli_query($this->db, $select_content4) or die(mysqli_error($this->db));
    $content4 = mysqli_fetch_assoc($content_result4);
        return $content4['school'];
    }

    public function getGroupName($groupid=NULL, $subid=NULL){
        $select_content2=("select * from groups where gid='$groupid'");
        $content_result2= mysqli_query($this->db, $select_content2) or die(mysqli_error($this->db));
        $content2 = mysqli_fetch_assoc($content_result2); 
        return $content2["groupname"];
    }

    public function getSubjectName($subjectid=NULL, $subid=NULL){
        $select_content3=("select * from subjects where sid='$subjectid'");
        $content_result3= mysqli_query($this->db, $select_content3) or die(mysqli_error($this->db));
        $content3 = mysqli_fetch_assoc($content_result3);
        return $content3["subject"];
    }

    public function getSemeterName($semesterid=NULL, $subid=NULL){
        $select_content3=("select * from terms where tid='$semesterid'");
        $content_result3= mysqli_query($this->db, $select_content3) or die(mysqli_error($this->db));
        $content3 = mysqli_fetch_assoc($content_result3);
        return $content3["term"];
    }

    public function getExamType($typeid=NULL){
        if($typeid == 1){ return "Essay"; }
        elseif($typeid == 2){ return "True/False";}
        elseif($typeid == 3){ return "Multiple Choice: One Answer"; }
        elseif($typeid == 4){ return "Multiple Choice: Multiple Answer"; }
    }

    public function getQuestionLink($typeid=NULL){
        if($typeid == 1){ return "essay-editing"; }
        elseif($typeid == 2){ return "type-true-editing";}
        elseif($typeid == 3 or $typeid == 4){ return "m_choice_editing"; }
    }

    public function getGrade($score=NULL){
		global $db;
		$select_content4=("select * from grades where low <='$score' and high >= '$score'");
		$content_result4= mysqli_query($db, $select_content4) or die (mysqli_error($db));
		$content4 = mysqli_fetch_assoc($content_result4);
		
		if($content4["grade"] ==""){
			$grade = '-';
		}
		else $grade = $content4["grade"];
		return $grade;
	}
		
	public function getWeight($score=NULL){
		global $db;
		$select_content4=("select * from grades where low <='$score' and high >= '$score'");
		$content_result4= mysqli_query($this->db, $select_content4) or die (mysqli_error($this->db));
		$content4 = mysqli_fetch_assoc($content_result4);
		
		$weight = $content4["weight"];
		return $weight;
    }

    
    
    public function getPrevoiuseResult($stid=NULL, $classv=NULL, $term=NULL, $year=NULL, $total_cgpa=NULL){
        $select_content44=("select * from resultposition where sid = '$sid' and year = '$year' and class='$classv' and term !='$term'  and term < '$term'");
        $content_result44= mysqli_query($this->db, $select_content44) or die(mysqli_error($this->db));
        $content44 = mysqli_fetch_assoc($content_result44);
        $num_chk44 = mysqli_num_rows ($content_result44);
        if($num_chk44 > 0){
            do{ 
                $cum_score += $content44['score'];
                $cum_overall += $content44['overall'];
                $total_cgpa += $content44['cgpa'];
            } while ($content44 = mysqli_fetch_assoc($content_result44));
        }

        if($total_cgpa != "" and $term == 2){
            $total_cgpa = (($total_cgpa + $total_gpa)/2);
            $total_cgpa = round($total_cgpa,2);
        }
        else if($total_cgpa != "" and $term == 3){
            $total_cgpa = (($total_cgpa + $total_gpa)/3);
            $total_cgpa = round($total_cgpa,2);
        }
        else{
            $total_cgpa = $total_gpa;
        }

        return array(
            'pscore'=>$cum_score,
            'poverall'=>$cum_overall,
            'pcgpa'=>$total_cgpa
        );
    }

}

?>