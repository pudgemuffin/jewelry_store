<?php
    class partner extends CI_Model
    {
        function checkinsertpart($partname)
        {
            $query = "SELECT count(*) as COUNT
            from partner where Part_Name = '$partname'";

            return $this->db->query($query)->result();
        }

        function insertpart($partname,$partemail,$parttel,$partaddress)
        {
            $query = "INSERT INTO partner(Part_Name,Part_Email,Part_Tel,Part_Address)
            values
            ('$partname','$partemail','$parttel','$partaddress')";

            return $this->db->query($query);
        }

        function allpartner()
        {
            $query = "SELECT * FROM partner";

            return $this->db->query($query)->result();
        }

        function displaybyid($id)
        {
            $query = "SELECT * FROM partner WHERE Part_Id = '$id'";

            return $this->db->query($query)->result();
        }

        function updatepart($partid,$partname,$partemail,$parttel,$partaddress)
        {
            $query = "UPDATE partner SET Part_Name = '$partname',Part_Email = '$partemail',Part_Tel = '$parttel',Part_Address = '$partaddress'
            WHERE Part_Id = '$partid'";

            return $this->db->query($query);
        }

        function deletepartner($partid)
        {
            $query = "DELETE FROM partner where Part_Id = '$partid'";

            return $this->db->query($query);
        }
    }
?>