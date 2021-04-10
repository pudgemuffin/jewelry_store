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
        $query = "SELECT employee.Id,employee.Firstname as FNAME,employee.Surname as SNAME,employee.Username as Username,job.permit as per,job.Pos_Name as Poname FROM employee 
                    INNER JOIN job  ON employee.Jobs = job.Pos_Id
                    WHERE employee.Username = ".$this->db->escape($user)." and employee.Password = ".$this->db->escape($pass)."";

        return $this->db->query($query)->result();
    }
}