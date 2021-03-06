<?php
class partner extends CI_Model
{
    function checkinsertpart($partname)
    {
        $query = "SELECT count(*) as COUNT
            from partner where Part_Name = '$partname'";

        return $this->db->query($query)->result();
    }

    function insertpart($partid,$partname, $partemail,$province,$amphur, $district,$postcode, $partaddress)
    {
        $query = "INSERT INTO partner(Part_Id,Part_Name,Part_Email,Part_Province,Part_Amphur,Part_District,Part_Postcode,Part_Address)
            values
            ('$partid','$partname','$partemail','$province','$amphur','$district','$postcode','$partaddress')";

        return $this->db->query($query);
    }

    function allpartner($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By p.Part_Id )as row ,p.Part_Id,p.Part_Name,p.Part_Email,p.Part_Address,pt.Part_tel as tel
                FROM partner p
                INNER JOIN part_telephone pt  ON P.Part_Id = pt.Part_Id
                where p.Part_Id like '%%' $search
                GROUP BY p.Part_Id   )AA
                where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }

    function count_partner($search)
    {
        $query = "SELECT COUNT(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By p.Part_Id )as row ,p.Part_Id,p.Part_Name,p.Part_Email,p.Part_Address,pt.Part_tel as tel
                FROM partner p
                INNER JOIN part_telephone pt  ON P.Part_Id = pt.Part_Id
                where p.Part_Id like '%%' $search
                GROUP BY p.Part_Id  )AA";

        return $this->db->query($query)->result();
    }

    function maxparterid()
    {
        $query = "SELECT max(Part_Id) as Part_Id FROM partner";
        $result = $this->db->query($query)->result();
        foreach ($result as $re) {
            return $re->Part_Id;
        }
    }

    function count_partner_tel($partid, $Part_tel)
    {
        $query = "SELECT COUNT(*) as Count from part_telephone where Part_Id = '$partid' and Part_tel = '$Part_tel'";

        $result =  $this->db->query($query)->result();

        foreach ($result as $re) {
            return $re->Count;
        }
    }

    function allcost($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By pt.Part_Id )as row ,pt.Part_Id,pt.Part_Name
                    FROM partner pt
                    where pt.Part_Id like '%%' $search
                    GROUP BY pt.Part_Id   )AA
                where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }

    function count_cost($search)
    {
        $query = "SELECT COUNT(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By pt.Part_Id )as row ,pt.Part_Id,pt.Part_Name
                    FROM partner pt
                    where pt.Part_Id like '%%' $search
                    GROUP BY pt.Part_Id   )AA";

        return $this->db->query($query)->result();
    }

    function parttel($partid,$part_tel)
    {
        $query = "INSERT INTO part_telephone(Part_Id,Part_tel)
                  values
                  ('$partid','$part_tel')";
        return $this->db->query($query); 
    }
    function partteldel($partid)
    {
        $query = "DELETE FROM part_telephone WHERE Part_Id = '$partid'";
        return $this->db->query($query);
    }

    function displaybyid($id)
    {
        $query = "SELECT * FROM partner WHERE Part_Id = '$id'";

        return $this->db->query($query)->result();
    }
    
    function countpart($partid)
    {
        $query = "SELECT COUNT(*) as Count FROM cost where Part_Id = '$partid'";

        return $this->db->query($query)->result();

    }

    function parttelbyid($id)
    {
        $query = "SELECT Part_tel FROM part_telephone WHERE Part_Id = '$id'";

        return $this->db->query($query)->result();
    }

    function updatepart($partid, $partname, $partemail,$province,$amphur, $district,$postcode, $partaddress)
    {
        $query = "UPDATE partner SET Part_Name = '$partname',Part_Email = '$partemail',Part_Province = '$province',Part_Amphur = '$amphur',Part_District = '$district',Part_Postcode = '$postcode' ,Part_Address = '$partaddress'
            WHERE Part_Id = '$partid'";

        return $this->db->query($query);
    }

    function deletepartner($Part_Id)
    {
        $query = "DELETE FROM partner where Part_Id = '$Part_Id'";

        return $this->db->query($query);
    }

    function partnerdetail()
    {
        $query = "SELECT Part_Id,Part_Name FROM partner";

        return $this->db->query($query)->result();
    }


    function partnerbyid($partid)
    {
        $query = "SELECT * FROM partner WHERE Part_Id = '$partid'";

        return $this->db->query($query)->result();
    }

    function count_cost_check($partid,$prodid)
    {
        $query = "SELECT COUNT(*) as Count from cost where Part_Id = '$partid' and Prod_Id = '$prodid' AND Status = '0'";
  
        $result =  $this->db->query($query)->result();
       
        foreach($result as $re){
            return $re->Count;
        }
    }
    function insertcost($partid,$prodid,$price)
    {
        $query = "INSERT INTO cost(Part_Id,Prod_Id,Cost_Price,Status)
                    VALUES
                    ('$partid','$prodid','$price','1')";

        return $this->db->query($query);            
    }
    function deletecost($partid)
    {
        $query = "UPDATE  cost SET Status = '0' WHERE Part_Id = '$partid'";

        return $this->db->query($query);
    }

}   

