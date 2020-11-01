<?php

class loginpermit extends CI_Model
{
    function checkuserexist($user,$pass)
    {
        $query = "SELECT COUNT(*) as EMP FROM employee 
                    WHERE Username = ".$this->db->escape($user)." and Password = ".$this->db->escape($pass)."";

        return $this->db->query($query)->result();
    }

    function loginauth($user,$pass)
    {
        $query = "SELECT e.Firstname as FNAME,e.Surname as SNAME,e.USername as Username,p.permit as per,p.Pos_Name as Poname FROM employee e
                    INNER JOIN job p ON e.Jobs = p.Pos_Id
                    WHERE e.Username = ".$this->db->escape($user)." and e.Password = ".$this->db->escape($pass)."";

        return $this->db->query($query)->result();
    }
}