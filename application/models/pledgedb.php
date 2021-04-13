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
                    $pledgeMonth, $pledgeemp ,$pledgecus, $pledgeweight)
    {
        $query = "INSERT INTO pledge (Pledge_Id, Pledge_Detail, Pledge_Price, Pledge_Debt, Pledge_Debt_Price, Pledge_Sdate, Pledge_Ndate
                                    , Pledge_Month, Pledge_Emp, Pledge_Cus, Pledge_Status, Pledge_Weight)
                        VALUES ('$pledgeid', '$pledgedetail', '$pledgeprice', '$pledgedebt', '$pledgedebtprice', '$pledgeSdate', '$pledgeNdate', 
                    '$pledgeMonth', '$pledgeemp', '$pledgecus', '1', '$pledgeweight')";

        return $this->db->query($query);
    }

    function addplelist($pledgeid ,$pledgeweightper, $pledgepro)
    {
        $query = "INSERT INTO pledge_list (Pledge_Id, Pledge_Weight_Per, Pledge_Pro, Pledge_Stat, Pledge_Stat_Stock)
                        VALUES ('$pledgeid', '$pledgeweightper', '$pledgepro', '1', '0')";

        return $this->db->query($query);
    }

    function selectndate($search)
    {
        $query = "SELECT Pledge_Ndate from pledge
                    WHERE Pledge_Id = '$search'";

        return $this->db->query($query)->result();
    }

    function countpledge()
    {
        $query = "SELECT Pledge_Id from pledge";

        return $this->db->query($query)->result();
    }

    function checkpledge()
    {
        $query = "SELECT Pledge_Id, Pledge_Ndate, DATE_ADD(Pledge_Ndate,INTERVAL 90 DAY) as lastday from pledge";

        return $this->db->query($query)->result();
    }

    function selectpledge($plid)
    {
        $query = "SELECT Pledge_Id, Pledge_Detail, Pledge_Price, Pledge_Debt, Pledge_Debt_Price, Pledge_Sdate, Pledge_Ndate, Pledge_Month, Pledge_Emp, Pledge_Cus
        , Pledge_Weight
                    FROM pledge
                        WHERE Pledge_Id = '$plid'";

        return $this->db->query($query)->result();
    }

    function selectsubpledge($plid)
    {
        $query = "SELECT Pledge_Id, Pledge_Weight_Per, Pledge_Pro FROM pledge_list
                    WHERE Pledge_Id = '$plid'";

        return $this->db->query($query)->result();
    }

    function setpledgezero()
    {
        $query = "UPDATE pledge
        SET Pledge_Status = '2'
        WHERE  Pledge_Id IN (SELECT Pledge_Id FROM pledge
        WHERE  Pledge_Ndate < CURRENT_DATE
        AND DATE_ADD(Pledge_Ndate,INTERVAL 90 DAY)  < CURRENT_DATE)";

        return $this->db->query($query);
    }

    function setpledgelistzero()
    {
        $query = "UPDATE pledge_list
        SET Pledge_Stat = '2'
        WHERE  Pledge_Id IN (SELECT Pledge_Id FROM pledge
        WHERE  Pledge_Ndate < CURRENT_DATE
        AND DATE_ADD(Pledge_Ndate,INTERVAL 90 DAY)  < CURRENT_DATE)";

        return $this->db->query($query);
    }

    function updatepledge($pledgeid, $date, $pledgeprice, $pledgedebt, $pledgedebtprice, $pledgeweight, $pledday)
    {
        $query = "UPDATE pledge SET Pledge_Ndate = '$date', Pledge_Price = '$pledgeprice' , Pledge_Debt = '$pledgedebt', 
        Pledge_Debt_Price = '$pledgedebtprice', Pledge_Weight = '$pledgeweight', Pledge_Month = '$pledday'
        WHERE Pledge_Id = '$pledgeid'";

        return $this->db->query($query);
    }

    function deladdplelist($plid)
    {
        $query = "DELETE pledge_list WHERE Pledge_Id = '$plid'";

        return $this->db->query($query);

    }

    function selectlist()
    {
        $query = "SELECT pledge_list.Pledge_Pro, pledge_list.Pledge_Weight_Per, pledge.Pledge_Price, pledge.Pledge_Weight, pledge.Pledge_Id FROM pledge_list
        LEFT JOIN pledge on pledge_list.Pledge_Id = pledge.Pledge_Id
        WHERE  Pledge_Stat = '2' and Pledge_Stat_Stock = '0'";

        return $this->db->query($query)->result();
    }

    function insertstock($id,$pledgepro,$result,$pledgeweightp,$plid)
    {
        $query = "INSERT INTO pledge_stock (ProdPL_Id, ProdPL_Name, ProdPL_Weight_Per, Pledge_Id, ProdPL_Status)
            VALUES ('$id','$pledgepro','$result','$pledgeweightp','$plid','1')";

return $this->db->query($query);    
    }

}
?>