<?php

class detail extends CI_Model
{
    function empdata($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By e.Id )as row ,e.Image,e.Id,e.Firstname,e.Surname,e.Gender,e.Email,e.Religion,e.empdate,j.job as posi
        FROM employee e
                      INNER JOIN job j ON e.Jobs = j.Job_Id 
                  WHERE e.Status = '1' $search )AA
       where row > $start AND row <=$pageend order by row";
        
        return $this->db->query($query)->result();
    }

    function count_all_emp($search)
    {
        $query = "SELECT COUNT(*) as Count from( 
            SELECT ROW_NUMBER()OVER ( ORDER By e.Id )as row ,e.Image,e.Id,e.Firstname,e.Surname,e.Gender,e.Email,e.Religion,e.empdate,j.job as posi
                    FROM employee e 
                            INNER JOIN job j ON e.Jobs = j.Job_Id
                            WHERE e.Status = '1' $search)AA";

        return $this->db->query($query)->result();
    }

    function Position()
    {
        $query = "SELECT * FROM job";

        return $this->db->query($query)->result();
    }

    function insertposition($posi)
    {
        $query = "INSERT INTO job (job)
        values
        ('$posi')";

        return $this->db->query($query);
    }

    function deletejob($jobid)
    {
        $query = "DELETE FROM job WHERE Job_Id = '$jobid'";

        return $this->db->query($query);
    }

    function displayjobid($jobid)
    {
        $query = "SELECT * FROM job WHERE Job_Id = '$jobid'";

        return $this->db->query($query)->result();
    }

    function updatejob($jobid,$posi)
    {
        $query = "UPDATE job SET job = '$posi' WHERE Job_Id = '$jobid'";

        return $this->db->query($query);
    }

    function Province()
    {
        $query = "SELECT * FROM province";

        return $this->db->query($query)->result();
    }
    
    function Amphur()
    {
        $query = "SELECT * FROM amphur";

        return $this->db->query($query)->result();
    }

    function Amphurc($province)
    {
        $query = "SELECT * FROM amphur where AMPHUR_ID like '%%' $province ";

        return $this->db->query($query)->result();
    }



    function District()
    {
        $query = "SELECT * FROM district";

        return $this->db->query($query)->result();
    }

    function Districtc($amphur)
    {
        $query = "SELECT * FROM district where DISTRICT_ID like '%%' $amphur ";

        return $this->db->query($query)->result();
    }


    
    function postcodec($district)
    {
        $query = "SELECT POSTCODE FROM district Where  $district";
        
        return $this->db->query($query)->result();
    }

    function checkinsert($idcard)
    {
        $query = "SELECT count(*) as COUNT
            from employee where Idcard = '$idcard'";
        return $this->db->query($query)->result();
    }

    function insertemp($id,$idcard,$nametitle,$fname,
    $lname,$gender,$religion,$blood,$empdate,$email,$pos,$province,$amphur,$district,$postcode,$det,$status,$startdate,$salary,$national,$filename)
    {
        $query = "INSERT INTO employee (Id,Idcard,Nametitle,Firstname,Surname,Gender,Religion,Blood,empdate,Email,Jobs,Provinces,Countys,Districts,Postcodes,Address,Status,Startdate,Salary,National,Image)
        values
                                       ('$id','$idcard','$nametitle','$fname','$lname','$gender','$religion','$blood','$empdate','$email','$pos','$province','$amphur','$district','$postcode','$det','$status','$startdate','$salary','$national','$filename')"; //
        return $this->db->query($query);                                                                
    }

    function insertempimg($data)
    {       
        $this->db->insert('employee',$data);
    }

    function emptel($Id,$emp_tel)
    {
        $query = "INSERT INTO emp_telephone(Id,emp_tel)
                  values
                  ('$Id','$emp_tel')";
        return $this->db->query($query); 
    }
    function empteldel($id)
    {
        $query = "DELETE FROM emp_telephone WHERE Id = '$id'";
        return $this->db->query($query);
    }
    function emptelupdate($id,$emp_tel)
    {
        $query = "INSERT INTO emp_telephone(Id,emp_tel)
                     values
                    ('$id','$emp_tel')";
        return $this->db->query($query);
    }

    function emptelbyid($id)
    {
        $query = "SELECT emp_tel FROM emp_telephone WHERE Id = '$id'";

        return $this->db->query($query)->result();
    }

    function maxid()
    {
        $query = "SELECT max(id) as Id FROM employee";
        $result = $this->db->query($query)->result();
        foreach($result as $re){
            return $re->Id;
        }
         
    }
    function displaybyid($id)
    {
        $query = "SELECT * FROM employee WHERE Id = '$id'";

        return $this->db->query($query)->result();
    }

    function update($id,$idcard,$nametitle,$fname,$lname,$gender,$religion,$blood,$empdate,$email,$pos,$province,$amphur,$district,$postcode,$det,$status,$startdate,$salary,$national,$filename)
    {
        $query = "UPDATE employee SET Idcard = '$idcard',Nametitle = '$nametitle',Firstname = '$fname',Surname = '$lname',Gender = '$gender',Religion = '$religion',Blood = '$blood'  
        ,empdate = '$empdate',Email = '$email',Jobs = '$pos',Provinces = '$province',Countys = '$amphur',Districts = '$district',Postcodes = '$postcode',Address = '$det',Status = '$status',Startdate = '$startdate',Salary = '$salary',National = '$national',Image = '$filename' WHERE Id = '$id'";

        return $this->db->query($query);
    }
    function updatenoimg($id,$idcard,$nametitle,$fname,$lname,$gender,$religion,$blood,$empdate,$email,$pos,$province,$amphur,$district,$postcode,$det,$status,$startdate,$salary,$national)
    {
        $query = "UPDATE employee SET Idcard = '$idcard',Nametitle = '$nametitle',Firstname = '$fname',Surname = '$lname',Gender = '$gender',Religion = '$religion',Blood = '$blood'  
        ,empdate = '$empdate',Email = '$email',Jobs = '$pos',Provinces = '$province',Countys = '$amphur',Districts = '$district',Postcodes = '$postcode',Address = '$det',Status = '$status',Startdate = '$startdate',Salary = '$salary',National = '$national' WHERE Id = '$id'";

        return $this->db->query($query);
    }

    function delete($Id)
    {
        $query = "UPDATE employee SET Status = '0' WHERE Id ='$Id'";
        return $this->db->query($query);
    }

    
}
?>
