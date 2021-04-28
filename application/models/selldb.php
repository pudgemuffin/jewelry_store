<?php
class selldb extends CI_Model
{

    function receiptview($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By receipt.Receipt_Id )as row ,receipt.Receipt_Id,receipt.Receipt_Date,receipt.Receipt_Total ,employee.Firstname
                    FROM receipt
                        JOIN employee ON employee.Id = receipt.Emp_Id
                            WHERE receipt.Receipt_Status = '1' $search )AA
                                where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }

    function count_receipt($search)
    {
        $query = "SELECT COUNT(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By receipt.Receipt_Id )as row ,receipt.Receipt_Id,receipt.Receipt_Date,receipt.Receipt_Total ,employee.Firstname
        FROM receipt
            JOIN employee ON employee.Id = receipt.Emp_Id
                WHERE receipt.Receipt_Status = '1' $search )AA";

        return $this->db->query($query)->result();
    }

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
        IFNULL(sub_lot.Amount,0) as Amount, Weight.Weight_Cal, sub_lot.Lot_Id, promo.Prom_Discount, promo.Prom_Name, promo.Prom_Status from product
        LEFT JOIN sub_lot on sub_lot.Prod_Id = product.Prod_Id
        LEFT JOIN weight on weight.Weight_Id = product.Prod_Weight
        LEFT JOIN rings on rings.Prod_Id = product.Prod_Id
        LEFT JOIN size on size.Id = rings.Size
      LEFT JOIN protype on protype.Prot_Id = product.Prod_Type
		LEFT JOIN (SELECT sub_promotion.Prod_Id, sub_promotion.Prom_Id, promotion.Prom_Discount, promotion.Prom_Name, promotion.Prom_Status from sub_promotion
		LEFT JOIN promotion on promotion.Promotion_Id = sub_promotion.Prom_Id
		WHERE promotion.Prom_Status != 0) promo 
		on promo.Prod_Id = product.Prod_Id
		WHERE sub_lot.Amount != 0
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
        $query = "SELECT product.Prod_Img, product.Prod_Id, protype.Prot_Name, product.Prod_Name, product.Fee, weight.Weight_Name, size.Size, 
        IFNULL(sub_lot.Amount,0) as Amount, Weight.Weight_Cal, sub_lot.Lot_Id, promo.Prom_Discount, promo.Prom_Name, promo.Prom_Status from product
        LEFT JOIN sub_lot on sub_lot.Prod_Id = product.Prod_Id
        LEFT JOIN weight on weight.Weight_Id = product.Prod_Weight
        LEFT JOIN rings on rings.Prod_Id = product.Prod_Id
        LEFT JOIN size on size.Id = rings.Size
      LEFT JOIN protype on protype.Prot_Id = product.Prod_Type
		LEFT JOIN (SELECT sub_promotion.Prod_Id, sub_promotion.Prom_Id, promotion.Prom_Discount, promotion.Prom_Name, promotion.Prom_Status from sub_promotion
		LEFT JOIN promotion on promotion.Promotion_Id = sub_promotion.Prom_Id
		WHERE promotion.Prom_Status != 0) promo 
		on promo.Prod_Id = product.Prod_Id
		WHERE sub_lot.Amount != 0 AND product.Prod_Id = '$prodid' AND sub_lot.Lot_Id = '$lotid'
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
        $query = "SELECT ProdPL_Id, ProdPL_Name, ProdPL_Cost, ProdPL_Weight_Per FROM pledge_stock
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
        $query = "SELECT max(Receipt_Id) as Id FROM receipt";

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

    function updateproduct($lotid,$prodid,$amount)
    {
        $query = "UPDATE sub_lot SET Amount = Amount - $amount WHERE Lot_Id = '$lotid' and Prod_Id = '$prodid'";

        return $this->db->query($query);
    }

    function updatepledgestock($expid)
    {
        $query = "UPDATE pledge_stock SET ProdPL_Status = '0' WHERE ProdPL_Id = '$expid'";

        return $this->db->query($query);
    }

    function receipthead($repid)
    {
        $query = "SELECT Receipt_Id, Receipt_Date, employee.Firstname, customer.Cus_fname, Receipt_Total, Receipt_Payment FROM receipt
        JOIN employee ON employee.Id = receipt.Emp_Id
        JOIN customer ON customer.Cus_Id = receipt.Cus_Id
        WHERE Receipt_Id = '$repid'";

        return $this->db->query($query)->result();
    }

    function receipt_list_pro($repid)
    {
        $query = "SELECT product.Prod_Name,receipt_list.Receipt_Amount,receipt_list.Receipt_Price_Per,receipt_list.Receipt_Price_Total from receipt_list_product
        JOIN receipt_list ON receipt_list_product.Receipt_Id = receipt_list.Receipt_Id
        JOIN product ON product.Prod_Id = receipt_list_product.Prod_Id
        WHERE receipt_list.Receipt_Id = '$repid' and receipt_list.Receipt_Type = '1'";

        return $this->db->query($query)->result();
    }

    function receipt_pro_count($repid)
    {
        $query = "SELECT Count(receipt_list_product.Prod_Id) as Count from receipt_list_product
        JOIN receipt_list ON receipt_list_product.Receipt_Id = receipt_list.Receipt_Id
        JOIN product ON product.Prod_Id = receipt_list_product.Prod_Id
        WHERE receipt_list.Receipt_Id = '$repid' and receipt_list.Receipt_Type = '1'";

        return $this->db->query($query)->result();
    }

    function receipt_list_ple($repid)
    {
        $query = "SELECT pledge_stock.ProdPL_Name,receipt_list.Receipt_Amount,receipt_list.Receipt_Price_Per,receipt_list.Receipt_Price_Total FROM receipt_list_pledge
        JOIN receipt_list ON receipt_list_pledge.Receipt_Id = receipt_list.Receipt_Id
        JOIN pledge_stock ON pledge_stock.ProdPL_Id = receipt_list_pledge.ProdPL_Id
        WHERE receipt_list.Receipt_Id = '$repid' and receipt_list.Receipt_Type = '0'";

        return $this->db->query($query)->result();
    }

    function receipt_ple_count($repid)
    {
        $query = "SELECT COUNT(receipt_list_pledge.ProdPL_Id) as Count FROM receipt_list_pledge
        JOIN receipt_list ON receipt_list_pledge.Receipt_Id = receipt_list.Receipt_Id
        JOIN pledge_stock ON pledge_stock.ProdPL_Id = receipt_list_pledge.ProdPL_Id
        WHERE receipt_list.Receipt_Id = '$repid' and receipt_list.Receipt_Type = '0'";

        return $this->db->query($query)->result();
    }

    function changestatrep($repid)
    {
        $query = "UPDATE receipt SET Receipt_Status = '0'
                    WHERE Receipt_Id = '$repid'";
        return $this->db->query($query);            
    }

    function getamountpro($repid)
    {
        $query = "SELECT receipt_list.Receipt_Amount,receipt_list.Receipt_Id,receipt_list_product.Prod_Id,receipt_list_product.Lot_Id, receipt_list.Receipt_Type,receipt_list_pledge.ProdPL_Id FROM receipt_list
                LEFT JOIN receipt_list_product ON receipt_list_product.Receipt_Id = receipt_list.Receipt_Id
                LEFT JOIN receipt_list_pledge ON receipt_list.Receipt_Id = receipt_list_pledge.Receipt_Id
                WHERE receipt_list.Receipt_Id = '$repid' ";

        return $this->db->query($query)->result();
    }

    function updateprostock($amount,$prodid,$lotid)
    {
        $query = "UPDATE sub_lot SET Amount = Amount + $amount
                        WHERE Prod_Id = '$prodid' AND Lot_Id = '$lotid'";

        return $this->db->query($query);
    }

    function updateplestock($expid)
    {
        $query = "UPDATE pledge_stock SET ProdPL_Status = 1
                    WHERE ProdPL_Id = '$expid'";

        return $this->db->query($query);
    }

    function receiptdetailv2($repid)
    {
        $query = "SELECT receipt_list.Receipt_Type, receipt_list.Receipt_Amount,product.Prod_Name,pledge_stock.ProdPL_Name,receipt_list.Receipt_Price_Total FROM receipt_list
        LEFT JOIN receipt_list_product ON (receipt_list.Receipt_Id = receipt_list_product.Receipt_Id AND receipt_list.Receipt_No = receipt_list_product.Receipt_No)
        LEFT JOIN receipt_list_pledge ON (receipt_list.Receipt_Id = receipt_list_pledge.Receipt_Id AND receipt_list.Receipt_No = receipt_list_pledge.Receipt_No)
        JOIN receipt ON receipt.Receipt_Id = receipt_list.Receipt_Id
        LEFT JOIN product ON receipt_list_product.Prod_Id = product.Prod_Id
        LEFT JOIN pledge_stock ON receipt_list_pledge.ProdPL_Id = pledge_stock.ProdPL_Id
        WHERE receipt.Receipt_Id = '$repid'";

        return $this->db->query($query)->result();
    }

    function worldprice()
    {
        $query = "SELECT Id,World_Price FROM world_price";

        return $this->db->query($query)->result();
    }

    function updateworldsell($sell)
    {
        $query = "UPDATE world_price SET World_Price = '$sell' WHERE Id = 1 ";

        return $this->db->query($query);
    }

    function updateworldbuy($buy)
    {
        $query = "UPDATE world_price SET World_Price = '$buy' WHERE Id = 2 ";

        return $this->db->query($query);
    }
}
