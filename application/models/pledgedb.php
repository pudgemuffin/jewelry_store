<?php
class pledgedb extends CI_Model
{
    function maxpledge()
    {
        $query = "SELECT MAX(Pledge_Id) as Id from pledge";

        $result = $this->db->query($query)->result();

        foreach($result as $r){
            return $r->Id;
        }
    }

    function recbuy()
    {
        $query = "SELECT World_Price FROM World_price WHERE Id = 2";

        return $this->db->query($query)->result();
    }
}
?>