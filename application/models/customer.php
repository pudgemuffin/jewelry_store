<?php
class customer extends CI_Model
{
    function checkinsertcus($cususer)
    {
        $query = "SELECT count(*) as COUNT
            from customer where Cus_User = '$cususer'";

        return $this->db->query($query)->result();
    }

    function insertcus($cusid, $cusfname, $cuslname, $cusgender, $cusemail, $province, $amphur, $district, $postcode, $cusaddress,$cusbdate)
    {
        $query = "INSERT INTO customer(Cus_Id,Cus_fname,Cus_lname,Cus_Gender,Cus_Email,Cus_Province,Cus_Amphur,Cus_District,Cus_Postcode,Cus_Address,Cus_Bdate)
                    values
                    ('$cusid','$cusfname','$cuslname','$cusgender','$cusemail','$province','$amphur','$district','$postcode','$cusaddress','$cusbdate')";
        return $this->db->query($query);
    }

    function custel($CusId, $cus_tel)
    {
        $query = "INSERT INTO Cus_telephone(Id,cus_tel)
                  values
                  ('$CusId','$cus_tel')";
        return $this->db->query($query);
    }

    function maxid()
    {
        $query = "SELECT max(Cus_Id) as CusId FROM customer";
        $result = $this->db->query($query)->result();
        foreach ($result as $re) {
            return $re->CusId;
        }
    }
    function allcust()
    {
        $query = "SELECT * FROM customer";
        return $this->db->query($query)->result();
    }

    function displaybyid($id)
    {
        $query = "SELECT * FROM customer WHERE Cus_Id = '$id'";

        return $this->db->query($query)->result();
    }

    function editcust($cusid, $cususer, $cuspass, $cusfname, $cuslname, $cusgender, $cusemail, $custel, $province, $amphur, $district, $postcode, $cusaddress)
    {
        $query = "UPDATE customer SET Cus_User = '$cususer',Cus_Pass = '$cuspass',Cus_fname = '$cusfname',Cus_lname = '$cuslname',Cus_Gender = '$cusgender',Cus_Email = '$cusemail',Cus_Tel = '$custel'
            ,Cus_Province = '$province',Cus_Amphur = '$amphur',Cus_District = '$district',Cus_Postcode = '$postcode',Cus_Address = '$cusaddress'
            WHERE Cus_Id = '$cusid'";
        return $this->db->query($query);
    }

    function delete($cusid)
    {
        $query = "DELETE FROM customer WHERE Cus_Id ='$cusid'";
        return $this->db->query($query);
    }
}
