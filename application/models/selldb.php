<?php
class selldb extends CI_Model
{
    function sellpro()
    {
        // $query = "SELECT product.Prod_Img, product.Prod_Id, protype.Prot_Name, product.Prod_Name, product.Fee, weight.Weight_Name, size.Size, 
        // IFNULL(sum(sub_lot.Amount),0) as Amount from product
        // LEFT JOIN sub_lot on sub_lot.Prod_Id = product.Prod_Id
        // JOIN weight on weight.Weight_Id = product.Prod_Weight
        // LEFT JOIN rings on rings.Prod_Id = product.Prod_Id
        // LEFT JOIN size on size.Id = rings.Size
        // JOIN protype on protype.Prot_Id = product.Prod_Type
        // GROUP BY product.Prod_Id";

        $query = "SELECT product.Prod_Img, product.Prod_Id, protype.Prot_Name, product.Prod_Name, product.Fee, weight.Weight_Name, size.Size, 
        IFNULL(sub_lot.Amount,0) as Amount, Weight.Weight_Cal, sub_lot.Lot_Id, promo.Prom_Discount, promo.Prom_Name from product
        LEFT JOIN sub_lot on sub_lot.Prod_Id = product.Prod_Id
        JOIN weight on weight.Weight_Id = product.Prod_Weight
        LEFT JOIN rings on rings.Prod_Id = product.Prod_Id
        LEFT JOIN size on size.Id = rings.Size
        JOIN protype on protype.Prot_Id = product.Prod_Type
		LEFT JOIN (SELECT sub_promotion.Prod_Id, sub_promotion.Prom_Id, promotion.Prom_Discount, promotion.Prom_Name from sub_promotion
		JOIN promotion on promotion.Promotion_Id = sub_promotion.Prom_Id) promo 
		on promo.Prod_Id = product.Prod_Id
        GROUP BY product.Prod_Id, sub_lot.Lot_Id";

        return $this->db->query($query)->result();
    }

    function custselect()
    {
        $query = "SELECT Cus_Id, CONCAT(Cus_fname,'  ',Cus_lname) as Name 
        from customer";

        return $this->db->query($query)->result();
    }

    function selectpro($prodid, $lotid)
    {
        $query = "SELECT product.Prod_Img, product.Prod_Id, protype.Prot_Id, product.Prod_Name, product.Fee, weight.Weight_Name, size.Size, 
        IFNULL(sub_lot.Amount,0) as Amount, Weight.Weight_Cal, sub_lot.Lot_Id, promo.Prom_Discount, promo.Prom_Name from product
        LEFT JOIN sub_lot on sub_lot.Prod_Id = product.Prod_Id
        JOIN weight on weight.Weight_Id = product.Prod_Weight
        LEFT JOIN rings on rings.Prod_Id = product.Prod_Id
        LEFT JOIN size on size.Id = rings.Size
        JOIN protype on protype.Prot_Id = product.Prod_Type
		LEFT JOIN (SELECT sub_promotion.Prod_Id, sub_promotion.Prom_Id, promotion.Prom_Discount, promotion.Prom_Name from sub_promotion
		JOIN promotion on promotion.Promotion_Id = sub_promotion.Prom_Id) promo 
		on promo.Prod_Id = product.Prod_Id
        WHERE product.Prod_Id = '$prodid' and sub_lot.Lot_Id = '$lotid'
        GROUP BY product.Prod_Id, sub_lot.Lot_Id";



        return $this->db->query($query)->result();
    }

    function selectworldprice()
    {
        $query = "SELECT World_Price FROM world_price WHERE Id = 1";

        return $this->db->query($query)->result();
    }

    function selectexp()
    {
        $query = "SELECT ProdPL_Id, ProdPL_Name, ProdPL_Cost, ProdPL_Weight_Per FROM pledge_stock
        WHERE ProdPL_Status = '1'";

        return $this->db->query($query)->result();
    }

    function addexp($prodid)
    {
        $query = "SELECT ProdPL_Id, ProdPL_Name, ProdPL_Cost, ProdPL_Weight_Per, Prot_Id FROM pledge_stock
        WHERE ProdPL_Id = '$prodid'";

        return $this->db->query($query)->result();
    }

    function age($cusid)
    {
        $query = "SELECT TIMESTAMPDIFF(YEAR, Cus_Bdate, CURDATE()) AS age FROM customer
        WHERE Cus_Id = '$cusid'";

        $result = $this->db->query($query)->result();

        foreach($result as $r){
            return $r->age;
        }
    }

    function maxrep()
    {
        $query = "SELECT max(Receipt_Id) as Id FROM receipt
                    WHERE Receipt_Status = '1'";

        $result = $this->db->query($query)->result();

        foreach($result as $r){
            return $r->Id;
        }
    }

    function receipt($repid, $payment, $date, $age, $alltotal, $empid, $cusid)
    {
        $query = "INSERT INTO receipt (Receipt_Id, Receipt_Payment, Receipt_Date, Receipt_Age, Receipt_Total, Receipt_Status, Emp_Id, Cus_Id)
                                VALUES ('$repid', '$payment', '$date', '$age', '$alltotal', '1', '$empid', '$cusid')";

        return $this->db->query($query);
    }

    function receipt_list($i, $type, $amount, $dis, $priceper, $totalper, $repid)
    {
        $query = "INSERT INTO receipt_list (Receipt_No, Receipt_Type, Receipt_Amount, Receipt_Discount, Receipt_Price_Per, Receipt_Price_Total, Receipt_Id)
                                VALUES('$i', '$type', '$amount', '$dis', '$priceper', '$totalper', '$repid')";

        return $this->db->query($query);
    }

    function receipt_list_product($repid, $i, $lotid, $prodid)
    {
        $query = "INSERT INTO receipt_list_product (Receipt_Id, Receipt_No, Lot_Id, Prod_Id)
                                VALUES ('$repid', '$i', '$lotid', '$prodid')";

        return $this->db->query($query);
    }

    function receipt_list_pledge($repid, $i, $expid)
    {
        $query = "INSERT INTO receipt_list_pledge (Receipt_Id, Receipt_No, ProdPL_Id)
                                VALUES ('$repid', '$i', '$expid')";

        return $this->db->query($query);
    }

    function updateproduct($lotid,$prodid,$left)
    {
        $query = "UPDATE sub_lot SET Amount = '$left' WHERE Lot_Id = '$lotid' and Prod_Id = '$prodid'";

        return $this->db->query($query);
    }

    function updatepledgestock($expid)
    {
        $query = "UPDATE pledge_stock SET ProdPL_Status = '0' WHERE ProdPL_Id = '$expid'";

        return $this->db->query($query);
    }
}
