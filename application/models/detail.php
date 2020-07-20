<?php

class detail extends CI_Model
{
    function empdata()
    {
        $query = "SELECT * FROM employee";
        //Something!
        return $this->db->query($query)->result();
    }

    function Depts()
    {
        $query = "SELECT * FROM department";

        return $this->db->query($query)->result();
    }

    function Position()
    {
        $query = "SELECT * FROM job";

        return $this->db->query($query)->result();
    }
    
    function Positionc($depts)
    {
        $query = "SELECT * FROM job where Job_Id like '%%' $depts order by Job_Id";

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

    function insertemp($idcard,$nametitle,$fname,
    $lname,$gender,$religion,$blood,$empdate,$pnum,$email,$depts,$pos,$province,$amphur,$district,$postcode,$det)
    {
        $query = "INSERT INTO employee (Idcard,Nametitle,Firstname,Surname,Gender,Religion,Blood,empdate,Pnum,Email,Depts,Jobs,Provinces,Countys,Districts,Postcodes,Address)
        values
                                       ('$idcard','$nametitle','$fname','$lname','$gender','$religion','$blood','$empdate','$pnum','$email','$depts','$pos','$province','$amphur','$district','$postcode','$det')"; //
        return $this->db->query($query);                                                                
    }

    function displaybyid($id)
    {
        $query = "SELECT * FROM employee WHERE Id = '$id'";

        return $this->db->query($query)->result();
    }

    function update($id,$idcard,$nametitle,$fname,$lname,$gender,$religion,$blood,$empdate,$pnum,$email,$pos,$province,$amphur,$district,$postcode,$det)
    {
        $query = "UPDATE employee SET Idcard = '$idcard',Nametitle = '$nametitle',Firstname = '$fname',Surname = '$lname',Gender = '$gender',Religion = '$religion',Blood = '$blood'  
        ,empdate = '$empdate',Pnum = '$pnum',Email = '$email',Jobs = '$pos',Provinces = '$province',Countys = '$amphur',Districts = '$district',Postcodes = '$postcode',Address = '$det' WHERE Id = '$id'";

        return $this->db->query($query);
    }

    function delete($idcard)
    {
        $query = "DELETE FROM employee WHERE Idcard ='$idcard'";
        return $this->db->query($query);
    }
}
?>
