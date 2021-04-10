<?php

class detail extends CI_Model
{
    function empdata($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By e.Id )as row ,e.Image,e.Id,e.Firstname,e.Surname,e.Gender,e.Email,e.Religion,e.empdate,j.Pos_Name as posi , et.emp_tel as emptel
        FROM employee e
                    INNER JOIN job j ON e.Jobs = j.Pos_Id 
					INNER JOIN emp_telephone et on e.Id = et.Id
                    WHERE e.Status = '1' $search
					GROUP BY e.Id  )AA
       where row > $start AND row <=$pageend order by row";
        
        return $this->db->query($query)->result();
    }

    function count_all_emp($search)
    {
        $query = "SELECT COUNT(*) as Count from( 
            SELECT ROW_NUMBER()OVER ( ORDER By e.Id )as row ,e.Image,e.Id,e.Firstname,e.Surname,e.Gender,e.Email,e.Religion,e.empdate,j.Pos_Name as posi
                    FROM employee e 
                            INNER JOIN job j ON e.Jobs = j.Pos_Id
                            WHERE e.Status = '1' $search)AA";

        return $this->db->query($query)->result();
    }

    function count_emp_tel($id,$emp_tel)
    {
        $query = "SELECT COUNT(*) as Count from emp_telephone where Id = '$id' and emp_tel = '$emp_tel'";

        $result =  $this->db->query($query)->result();
       
        foreach($result as $re){
            return $re->Count;
        }
        
    }

    
    
    function Position($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By Pos_Id )as row ,Pos_Id,Pos_Name
                    FROM job
                    WHERE Pos_Id like '%%' $search
                    )AA
                    where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }
    
    function callposition()
    {
        $query = "SELECT Pos_Id,Pos_Name,permit from job";
        return $this->db->query($query)->result();
    }

    function displaypermit()
    {
        $query = "SELECT permit from job";
        return $this->db->query($query)->result();
    }


    function count_all_position($search)
    {
        $query = "SELECT COUNT(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By Pos_Id )as row ,Pos_Name
                    FROM job
                    WHERE Pos_Id like '%%' $search )AA";

        return $this->db->query($query)->result();
    }

    function maxidpos()
    {
        $query = "SELECT max(Pos_Id) as Id FROM job";
        $result = $this->db->query($query)->result();
        foreach($result as $re){
            return $re->Id;
        }
         
    }


    function insertposition($posid,$posi,$permit)
    {
        $query = "INSERT INTO job (Pos_Id,Pos_Name,permit)
        values
        ('$posid','$posi','$permit')";

        return $this->db->query($query);
    }

    function deletejob($Pos_Id)
    {
        $query = "DELETE FROM job WHERE Pos_Id = '$Pos_Id'";

        return $this->db->query($query);
    }

    function displayjobid($jobid)
    {
        $query = "SELECT * FROM job WHERE Pos_Id = '$jobid'";

        return $this->db->query($query)->result();
    }

    function updatejob($jobid,$posi,$permit)
    {
        $query = "UPDATE job SET Pos_Name = '$posi',permit = '$permit' WHERE Pos_Id = '$jobid'";

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
    $lname,$gender,$religion,$blood,$empdate,$email,$pos,$province,$amphur,$district,$postcode,$det,$status,$startdate,$salary,$national,$filename,$user,$pass)
    {
        $query = "INSERT INTO employee (Id,Idcard,Nametitle,Firstname,Surname,Gender,Religion,Blood,empdate,Email,Jobs,Provinces,Countys,Districts,Postcodes,Address,Status,Startdate,Salary,National,Image,Username,Password)
        values
                                       ('$id','$idcard','$nametitle','$fname','$lname','$gender','$religion','$blood','$empdate','$email','$pos','$province','$amphur','$district','$postcode','$det','$status','$startdate','$salary','$national','$filename','$user','$pass')"; //
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

    function update($id,$idcard,$nametitle,$fname,$lname,$gender,$religion,$blood,$empdate,$email,$pos,$province,$amphur,$district,$postcode,$det,$status,$startdate,$salary,$national,$filename,$pass)
    {
        $query = "UPDATE employee SET Idcard = '$idcard',Nametitle = '$nametitle',Firstname = '$fname',Surname = '$lname',Gender = '$gender',Religion = '$religion',Blood = '$blood'  
        ,empdate = '$empdate',Email = '$email',Jobs = '$pos',Provinces = '$province',Countys = '$amphur',Districts = '$district',Postcodes = '$postcode',Address = '$det',Status = '$status',Startdate = '$startdate',Salary = '$salary',National = '$national',Image = '$filename',Password = '$pass' WHERE Id = '$id'";

        return $this->db->query($query);
    }
    function updatenoimg($id,$idcard,$nametitle,$fname,$lname,$gender,$religion,$blood,$empdate,$email,$pos,$province,$amphur,$district,$postcode,$det,$status,$startdate,$salary,$national,$pass)
    {
        $query = "UPDATE employee SET Idcard = '$idcard',Nametitle = '$nametitle',Firstname = '$fname',Surname = '$lname',Gender = '$gender',Religion = '$religion',Blood = '$blood'  
        ,empdate = '$empdate',Email = '$email',Jobs = '$pos',Provinces = '$province',Countys = '$amphur',Districts = '$district',Postcodes = '$postcode',Address = '$det',Status = '$status',Startdate = '$startdate',Salary = '$salary',National = '$national',Password = '$pass' WHERE Id = '$id'";

        return $this->db->query($query);
    }

    function delete($Id)
    {
        $query = "UPDATE employee SET Status = 0 WHERE Id ='$Id'";
        return $this->db->query($query);
    }

    function checkinsertpos($posi)
    {
        $query = "SELECT COUNT(*) as COUNT
            from job WHERE Pos_Name = '$posi'";

        return $this->db->query($query)->result();
    }

    function ordersdata($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By Ord_Id )as row , Ord_Id, Ord_Date, Ord_Price, partner.Part_Name, orders.Id, employee.Firstname
                    FROM orders
                    INNER JOIN employee ON employee.Id = orders.Id 
                    INNER JOIN partner  ON partner.Part_Id     = orders.Part_Id
					WHERE Ord_Id like '%%' $search
					GROUP BY Ord_Id  )AA
                    where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }

    function count_orders($search)
    {
        $query = "SELECT Count(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By Ord_Id )as row , Ord_Id, Ord_Date, Ord_Price, partner.Part_Name, orders.Id, employee.Firstname
                    FROM orders
                    INNER JOIN employee ON employee.Id = orders.Id 
                    INNER JOIN partner  ON partner.Part_Id     = orders.Part_Id
					WHERE Ord_Id like '%%' $search
					GROUP BY Ord_Id  )AA";

        return $this->db->query($query)->result();
    }

    function receivedata($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By receive.Rec_Id )as row , receive.Rec_Id, receive.Rec_Date, employee.Firstname
        FROM receive
        INNER JOIN employee ON employee.Id = receive.Id 
        WHERE receive.Rec_Id like '%%' $search
        GROUP BY receive.Rec_Id  )AA
        where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();

    }

    function count_receive($search)
    {

        $query = "SELECT Count(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By receive.Rec_Id )as row , receive.Rec_Id, receive.Rec_Date, employee.Firstname
        FROM receive
        INNER JOIN employee ON employee.Id = receive.Id 
        WHERE receive.Rec_Id like '%%' $search
        GROUP BY receive.Rec_Id  )AA";

        return $this->db->query($query)->result();
    }

    function lots($start, $pageend,  $search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By lot.Lot_Id )as row , lot.Lot_Id, lot.Lot_Date, lot.Lot_Cost
        FROM lot 
        WHERE lot.Lot_Id like '%%' $search
        GROUP BY lot.Lot_Id  )AA
        where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }

    function count_lots($search)
    {
        $query = "SELECT Count(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By lot.Lot_Id )as row , lot.Lot_Id, lot.Lot_Date, lot.Lot_Cost
        FROM lot 
        WHERE lot.Lot_Id like '%%' $search
        GROUP BY lot.Lot_Id  )AA";

        return $this->db->query($query)->result();
    }
}
