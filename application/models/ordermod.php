<?php
class ordermod extends CI_Model
{
    function Partneror($search)
    {
        $query = "SELECT partner.Part_Name,cost.Part_Id,cost.Cost_Price,product.Prod_Name,cost.Prod_Id,size.Size From cost 
        LEFT JOIN rings on rings.Prod_Id = cost.Prod_Id 
        JOIN product  on product.Prod_Id = cost.Prod_Id
        JOIN partner  on partner.Part_Id = cost.Part_Id
        LEFT JOIN size  on size.Id = rings.Size where cost.Part_Id like '%%' $search and cost.`Status` = 1 ";

        return $this->db->query($query)->result();
    }

    function Price($prod)
    {
        $query = "SELECT Cost_Price from cost Where Prod_Id like '%%' $prod";
        return $this->db->query($query)->result();
    }


    function Part()
    {
        $query = "SELECT partner.Part_Name,cost.Part_Id,cost.Cost_Price,product.Prod_Name,cost.Prod_Id,size.Size From cost
        LEFT JOIN rings  on rings.Prod_Id = cost.Prod_Id 
        JOIN product  on product.Prod_Id = cost.Prod_Id
        JOIN partner  on partner.Part_Id = cost.Part_Id
        LEFT JOIN size  on size.Id = rings.Size WHERE cost.Status = '1'";

        return $this->db->query($query)->result();
    }

    function Partajx($partner)
    {
        $query = "SELECT partner.Part_Name,cost.Part_Id,cost.Cost_Price,product.Prod_Name,cost.Prod_Id,size.Size From cost
        LEFT JOIN rings  on rings.Prod_Id = cost.Prod_Id 
        JOIN product  on product.Prod_Id = cost.Prod_Id
        JOIN partner  on partner.Part_Id = cost.Part_Id
        LEFT JOIN size  on size.Id = rings.Size WHERE partner.Part_Id like '%%' AND cost.Status = '1' $partner ";

        return $this->db->query($query)->result();
    }

    function maxid()
    {
        $query = "SELECT max(Ord_Id) as Id FROM orders";
        $result = $this->db->query($query)->result();
        foreach($result as $re){
            return $re->Id;
        }
         
    }

    function count_cost_check($ordid,$idproduct)
    {
        $query = "SELECT COUNT(*) as Count from sub_order where Ord_Id = '$ordid' and Prod_Id = '$idproduct'";
  
        $result =  $this->db->query($query)->result();
       
        foreach($result as $re){
            return $re->Count;
        }
    }

    function insertor($ordid,$date,$total,$ordstat,$part,$id)
    {
        $query = "INSERT INTO orders (Ord_Id,Ord_Date,Ord_Price,Ord_Status,Part_Id,Id)
                    values ('$ordid','$date','$total','$ordstat','$part','$id')";
        return $this->db->query($query); 
    }

    function insertord($price,$piece,$ordid,$idproduct,$total_piece)
    {
        $query = "INSERT INTO sub_order (Priceper,Piece,Ord_Id,Prod_Id,Total_per,Remaining)
                    values ('$price','$piece','$ordid','$idproduct','$total_piece','$piece')";
        return $this->db->query($query); 
    }

    function vieworder($Ord_Id)
    {
        $query = "SELECT orders.Ord_Id, orders.Ord_Date, orders.Ord_Price, orders.Part_Id, employee.Firstname, partner.Part_Name from orders join employee 
        on orders.Id = employee.Id
        join partner on orders.Part_Id = partner.Part_Id
        where orders.Ord_Id = '$Ord_Id'";

        return $this->db->query($query)->result();
    }

    function viewsuborder($Ord_Id)
    {
        $query = "SELECT sub_order.Prod_Id, sub_order.Piece, sub_order.Priceper, sub_order.Total_per, product.Prod_Name from sub_order 
        join product on sub_order.Prod_Id = product.Prod_Id
        where sub_order.Ord_Id = '$Ord_Id'";

        return $this->db->query($query)->result();
    }

    function receive()
    {
        $query = "SELECT Ord_Id from orders WHERE Ord_Status = 1";

        return $this->db->query($query)->result();
    }

    function ordajax($ord)
    {
        $query = "SELECT sub_order.Prod_Id, sub_order.Piece, sub_order.Priceper, product.Prod_Name, partner.Part_Name, sub_order.Remaining, sub_order.Ord_Id,orders.Ord_Price from sub_order 
        join product on sub_order.Prod_Id = product.Prod_Id
        join orders on orders.Ord_Id = sub_order.Ord_Id
        join partner on partner.Part_Id = orders.Part_Id
        where sub_order.Ord_Id = '$ord' and sub_order.Remaining > 0";
        
        return $this->db->query($query)->result();
    }

    function maxrec()
    {
        $query = "SELECT max(Rec_Id) as Id FROM receive";
        $result = $this->db->query($query)->result();
        foreach($result as $re){
            return $re->Id;
        }
    }

    function insertrec($recid,$date,$id)
    {
            
        $query = "INSERT INTO receive (Rec_Id, Rec_Date, Id)
        VALUES ('$recid','$date','$id')";

        return $this->db->query($query);
    }
    
    function insertsubrec($recid,$ordid,$prodid,$rec)
    {
        $query = "INSERT INTO sub_receive (Rec_Id, Ord_Id, Prod_Id, Amount)
        VALUES ('$recid','$ordid','$prodid','$rec')";

        return $this->db->query($query);
    }

    function updatesubord($remain,$ordid,$prodid)
    {
        $query = "UPDATE sub_order SET Remaining = '$remain' WHERE Ord_Id = '$ordid' and Prod_Id = '$prodid'";

        return $this->db->query($query);
    }

    function checkremainorder($ord)
    {
        $query = "SELECT sum(Remaining) as remain from sub_order WHERE Ord_Id = '$ord'";
        
        $result =  $this->db->query($query)->result();

        foreach($result as $re){
            return $re->remain;
        }
    }
    
    function updateorder($ord)
    {
        $query = "UPDATE orders SET Ord_Status = 0 WHERE Ord_Id = '$ord'";

        return $this->db->query($query);
    }

    function maxlot()
    {
        $query = "SELECT max(Lot_Id) as Id FROM lot";
        $result = $this->db->query($query)->result();
        foreach($result as $re){
            return $re->Id;
        }
    }

    function insertlot($lotid,$date,$price)
    {
        $query = "INSERT INTO lot (Lot_Id,Lot_Date,Lot_Cost)
        VALUES ('$lotid','$date','$price')";

        return $this->db->query($query);
    }

    function insertsublot($lotid,$recid,$rec,$prodid,$per,$ordper)
    {
        $query = "INSERT INTO sub_lot (Lot_Id,Rec_Id,Amount,Prod_Id, Price_Per, All_per)
        VALUES ('$lotid','$recid','$rec','$prodid','$per','$ordper')";

        return $this->db->query($query);
    }

    function viewreceive($recid)
    {
        $query = "SELECT receive.Rec_Id, receive.Rec_Date, employee.Firstname from receive
        JOIN employee on employee.Id = receive.Id
        WHERE receive.Rec_Id = '$recid'";

        return $this->db->query($query)->result();
    }

   function viewsubreceive($recid)
   {
       $query = "SELECT sub_receive.Rec_Id, sub_receive.Ord_Id, sub_receive.Amount, product.Prod_Name from sub_receive
       JOIN product on product.Prod_Id = sub_receive.Prod_Id
       WHERE sub_receive.Rec_Id = '$recid'";

       return $this->db->query($query)->result();
   }

   function viewlots($lot)
   {
       $query = "SELECT Lot_Id, Lot_Date, Lot_Cost from lot
       WHERE Lot_Id = '$lot'";

       return $this->db->query($query)->result();
   }

   function viewsublots($lot)
   {
       $query = "SELECT sub_lot.Rec_Id, product.Prod_Name, sub_lot.Amount, sub_lot.Price_Per, sub_lot.All_per  from sub_lot
       JOIN product ON product.Prod_Id = sub_lot.Prod_Id
       WHERE sub_lot.Lot_Id = '$lot'";

       return $this->db->query($query)->result();
   }
}
?>