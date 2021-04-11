<?php
class pledgedb extends CI_Model
{

    function allpledge($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By Pledge_Id )as row ,Pledge_Id, Pledge_Detail, Pledge_Price, Pledge_Debt, Pledge_Debt_Price, Pledge_Sdate, Pledge_Ndate, Pledge_Month, employee.Firstname, CONCAT(customer.Cus_fname,'  ',customer.Cus_lname) as Name FROM pledge
        JOIN employee ON employee.Id = pledge.Pledge_Emp
        JOIN customer ON customer.Cus_Id = pledge.Pledge_Cus
        WHERE Pledge_Status = '1' $search ) AA
        where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();

    }

    function count_allpledge($search)
    {
        $query = "SELECT Count(*) as COUNT from( SELECT ROW_NUMBER()OVER ( ORDER By Pledge_Id )as row ,Pledge_Id, Pledge_Detail, Pledge_Price, Pledge_Debt, Pledge_Debt_Price, Pledge_Sdate, Pledge_Ndate, Pledge_Month, employee.Firstname, CONCAT(customer.Cus_fname,'  ',customer.Cus_lname) as Name FROM pledge
        JOIN employee ON employee.Id = pledge.Pledge_Emp
        JOIN customer ON customer.Cus_Id = pledge.Pledge_Cus
        WHERE Pledge_Status = '1' $search) AA";

        return $this->db->query($query)->result();

    }
    

    function maxpledge()
    {
        $query = "SELECT MAX(Pledge_Id) as Id from pledge";

        $result = $this->db->query($query)->result();

        foreach($result as $r){
            return $r->Id;
        }
    }

    function exppl()
    {
        $query = "SELECT max(ProdPl_Id) as Id from pledge_stock";

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

    function addple($pledgeid, $pledgedetail, $pledgeprice, $pledgedebt, $pledgedebtprice ,$pledgeSdate , $pledgeNdate, 
                    $pledgeMonth, $pledgeemp ,$pledgecus)
    {
        $query = "INSERT INTO pledge (Pledge_Id, Pledge_Detail, Pledge_Price, Pledge_Debt, Pledge_Debt_Price, Pledge_Sdate, Pledge_Ndate
                                    , Pledge_Month, Pledge_Emp, Pledge_Cus, Pledge_Status)
                        VALUES ('$pledgeid', '$pledgedetail', '$pledgeprice', '$pledgedebt', '$pledgedebtprice', '$pledgeSdate', '$pledgeNdate', 
                    '$pledgeMonth', '$pledgeemp', '$pledgecus', '1')";

        return $this->db->query($query);
    }

    function addplelist($pledgeid ,$pledgeweightper, $pledgepro)
    {
        $query = "INSERT INTO pledge_list (Pledge_Id, Pledge_Weight_Per, Pledge_Pro, Pledge_Status)
                        VALUES ('$pledgeid', '$pledgeweightper', '$pledgepro', '1')";

        return $this->db->query($query);
    }

    function selectndate()
    {
        $query = "SELECT Pledge_Ndate from pledge
                    WHERE Pledge_Id = 'PLE21040001'";

        return $this->db->query($query)->result();
    }
}
?>