<?php
    class customer extends CI_Model
    {
        function checkinsertcus($cususer)
        {
            $query = "SELECT count(*) as COUNT
            from customer where Cus_User = '$cususer'";

            return $this->db->query($query)->result();
        }

        function insertcus($cususer,$cuspass,$cusfname,$cuslname,$cusgender,$cusemail,$custel,$province,$amphur,$district,$postcode,$cusaddress)
        {
            $query = "INSERT INTO customer(Cus_User,Cus_Pass,Cus_fname,Cus_lname,Cus_Gender,Cus_Email,Cus_Tel,Cus_Province,Cus_Amphur,Cus_District,Cus_Postcode,Cus_Address)
                    values
                    ('$cususer','$cuspass','$cusfname','$cuslname','$cusgender','$cusemail','$custel','$province','$amphur','$district','$postcode','$cusaddress')";
            return $this->db->query($query);    
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

        function editcust($cusid,$cususer,$cuspass,$cusfname,$cuslname,$cusgender,$cusemail,$custel,$province,$amphur,$district,$postcode,$cusaddress)
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
