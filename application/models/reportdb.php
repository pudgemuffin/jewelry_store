<?php
class reportdb extends CI_Model
{
    
    function reportamountbytimepro($dates,$daten)
    {
        $query = "SELECT
        product.Prod_Name,
        IFNULL(rec.amt,0) as amount
    FROM
    product LEFT JOIN
        (
        SELECT
            receipt.Receipt_Status,
            receipt_list_product.Prod_Id,
            SUM(receipt_list.Receipt_Amount) as 'amt'
        FROM
            receipt
            JOIN receipt_list ON receipt.Receipt_Id = receipt_list.Receipt_Id
         JOIN receipt_list_product ON ( receipt.Receipt_Id = receipt_list_product.Receipt_Id AND receipt_list.Receipt_No = receipt_list_product.Receipt_No )
         WHERE receipt.Receipt_Status = 1 AND (receipt.Receipt_Date BETWEEN '$dates' AND '$daten')
         GROUP BY receipt_list_product.Prod_Id
    )rec ON product.Prod_Id = rec.Prod_Id
        GROUP BY product.Prod_Id";

        return $this->db->query($query)->result();
    }

    function reportamountbytimeple($dates,$daten)
    {
        $query = "SELECT
        pledge_stock.ProdPL_Name,
        IFNULL(rec.amt,0) as amount
    FROM
    pledge_stock LEFT JOIN
        (
        SELECT
            receipt.Receipt_Status,
            receipt_list_pledge.ProdPL_Id,
            SUM(receipt_list.Receipt_Amount) as 'amt'
        FROM
            receipt
            JOIN receipt_list ON receipt.Receipt_Id = receipt_list.Receipt_Id
         JOIN receipt_list_pledge ON ( receipt.Receipt_Id = receipt_list_pledge.Receipt_Id AND receipt_list.Receipt_No = receipt_list_pledge.Receipt_No )
				 JOIN pledge_stock ON pledge_stock.ProdPL_Id = receipt_list_pledge.ProdPL_Id
         WHERE receipt.Receipt_Status = 1 AND pledge_stock.ProdPL_Status = 0 AND (receipt.Receipt_Date BETWEEN '$dates' AND '$daten')
         GROUP BY receipt_list_pledge.ProdPL_Id
    )rec ON pledge_stock.ProdPL_Id = rec.ProdPL_Id

        GROUP BY pledge_stock.ProdPL_Id";

        return $this->db->query($query)->result();
    }

    function reportcrosspro($y)
    {
        $query = "SELECT
        product.Prod_Id,
        product.Prod_Name,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-01' ) ),0) AS Jan,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-02' ) ),0) AS Feb,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-03' ) ),0) AS Mar,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-04' ) ),0) AS Apr,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-05' ) ),0) AS May,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-06' ) ),0) AS Jun,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-07' ) ),0) AS Jul,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-08' ) ),0) AS Aug,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-09' ) ),0) AS Sep,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-10' ) ),0) AS Oct,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-11' ) ),0) AS Nov,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-12' ) ),0) AS 'Dec'
    FROM 
            product
        LEFT JOIN
        (
        SELECT
        receipt_list_product.Prod_Id ,
        SUM( receipt_list.Receipt_Price_Per * receipt_list.Receipt_Amount ) AS price,
        SUBSTR( receipt.Receipt_Date, 1, 7 ) AS yymm 
    FROM
        receipt
        JOIN receipt_list ON receipt.Receipt_Id = receipt_list.Receipt_Id
        JOIN receipt_list_product ON ( receipt_list_product.Receipt_Id = receipt_list.Receipt_Id 
            AND receipt_list_product.Receipt_No = receipt_list.Receipt_No ) 
    WHERE
        YEAR ( receipt.Receipt_Date ) = '$y'
        GROUP BY receipt_list_product.Prod_Id
        )rep ON rep.Prod_Id = product.Prod_Id
        GROUP BY product.Prod_Id";

        return $this->db->query($query)->result();
    }

    function reportcrossple($y)
    {
        $query = "SELECT
        pledge_stock.ProdPL_Id,
        pledge_stock.ProdPL_Name,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-01' ) ),0) AS Jan,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-02' ) ),0) AS Feb,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-03' ) ),0) AS Mar,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-04' ) ),0) AS Apr,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-05' ) ),0) AS May,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-06' ) ),0) AS Jun,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-07' ) ),0) AS Jul,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-08' ) ),0) AS Aug,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-09' ) ),0) AS Sep,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-10' ) ),0) AS Oct,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-11' ) ),0) AS Nov,
        IFNULL(SUM( rep.price * ( rep.yymm = '2021-12' ) ),0) AS 'Dec'
    FROM 
            pledge_stock
        LEFT JOIN
        (
        SELECT
        receipt_list_pledge.ProdPL_Id ,
        SUM( receipt_list.Receipt_Price_Per * receipt_list.Receipt_Amount ) AS price,
        SUBSTR( receipt.Receipt_Date, 1, 7 ) AS yymm 
    FROM
        receipt
        JOIN receipt_list ON receipt.Receipt_Id = receipt_list.Receipt_Id
        JOIN receipt_list_pledge ON ( receipt_list_pledge.Receipt_Id = receipt_list.Receipt_Id 
            AND receipt_list_pledge.Receipt_No = receipt_list.Receipt_No ) 
            JOIN pledge_stock ON pledge_stock.ProdPL_Id = receipt_list_pledge.ProdPL_Id
    WHERE
        YEAR ( receipt.Receipt_Date ) = '$y'
        AND pledge_stock.ProdPL_Status = 0
        GROUP BY receipt_list_pledge.ProdPL_Id
        )rep ON rep.ProdPL_Id = pledge_stock.ProdPL_Id
        GROUP BY pledge_stock.ProdPL_Id";

        return $this->db->query($query)->result();
    }

    function reportpledgeover($dates,$daten)
    {
        $query = "SELECT
        pledge.Pledge_Id,
        pledge.Pledge_Over,
        ple.Pledge_Pro
    FROM
        pledge
        LEFT JOIN ( SELECT 
        pledge_list.Pledge_Pro, 
        pledge_list.Pledge_Id 
        FROM
        pledge_list 
        WHERE pledge_list.Pledge_Stat = 2 
        ) ple ON pledge.Pledge_Id = ple.Pledge_Id
        WHERE pledge.Pledge_Status = 2 AND pledge.Pledge_Over BETWEEN '$dates' AND '$daten'";

        return $this->db->query($query)->result();
    }

    function reportagepro($a1,$a2,$dates,$daten)
    {
        $query = "SELECT product.Prod_Id,product.Prod_Name,IFNULL(SUM(rec.AMOUNT),0) as Amount FROM product
        LEFT JOIN 
        (
        SELECT lot.Lot_Id,sub_lot.Prod_Id FROM lot
        JOIN sub_lot ON lot.Lot_Id = sub_lot.Lot_Id
        ) lt ON product.Prod_Id = lt.Prod_Id
        LEFT JOIN
        (
        SELECT
            receipt_list_product.Lot_Id,receipt_list_product.Prod_Id,SUM(receipt_list.Receipt_Amount) as AMOUNT
        FROM
            receipt
            JOIN receipt_list ON receipt.Receipt_Id = receipt_list.Receipt_Id
            JOIN receipt_list_product ON ( receipt_list.Receipt_Id = receipt_list_product.Receipt_Id AND receipt_list.Receipt_No = receipt_list_product.Receipt_No ) 
        WHERE
            (
                receipt.Receipt_Age BETWEEN $a1 
            AND $a2
            )
        AND receipt.Receipt_Status = '1'
        AND (receipt.Receipt_Date BETWEEN '$dates' AND '$daten')
        GROUP BY receipt_list_product.Lot_Id,receipt_list_product.Prod_Id
        )rec ON lt.Lot_Id =  rec.Lot_Id AND lt.Prod_Id = rec.Prod_Id
        GROUP BY product.Prod_Id";

        return $this->db->query($query)->result();
    }

    function reportageple($a1,$a2,$dates,$daten)
    {
        $query = "SELECT
        pledge_stock.ProdPL_Name,
        IFNULL( SUM( rec.AMOUNT ), 0 ) AS Amount 
    FROM
        pledge_stock
        LEFT JOIN (
        SELECT
            receipt_list_pledge.ProdPL_Id,
            SUM( receipt_list.Receipt_Amount ) AS AMOUNT 
        FROM
            receipt
            JOIN receipt_list ON receipt.Receipt_Id = receipt_list.Receipt_Id
            JOIN receipt_list_pledge ON ( receipt_list.Receipt_Id = receipt_list_pledge.Receipt_Id AND receipt_list.Receipt_No = receipt_list_pledge.Receipt_No )
            JOIN pledge_stock ON pledge_stock.ProdPL_Id = receipt_list_pledge.ProdPL_Id 
        WHERE
            ( receipt.Receipt_Age BETWEEN $a1 AND $a2 ) 
            AND receipt.Receipt_Status = '1' AND pledge_stock.ProdPL_Status = 0 
            AND (receipt.Receipt_Date BETWEEN '$dates' AND '$daten')
        GROUP BY
            receipt_list_pledge.ProdPL_Id 
        ) rec ON pledge_stock.ProdPL_Id = rec.ProdPL_Id 
    GROUP BY
        pledge_stock.ProdPL_Id";

        return $this->db->query($query)->result();
    }

    function reportproductprofit($dates,$daten)
    {
        $query = "SELECT product.Prod_Id,
        product.Prod_Name, 
        IFNULL(SUM(profits.profit),0) as Total
        FROM product
        LEFT JOIN
        (
        SELECT sub_lot.Lot_Id, receipt_list_product.Receipt_Id , receipt_list_product.Receipt_No,sub_lot.Prod_Id,  sub_lot.Price_Per, receipt_list.Receipt_Amount,receipt_list.Receipt_Price_Total,
        (sub_lot.Price_Per*receipt_list.Receipt_Amount) as cost,
        (receipt_list.Receipt_Price_Total - (sub_lot.Price_Per*receipt_list.Receipt_Amount)) as profit
        FROM sub_lot
        JOIN receipt_list_product ON (sub_lot.Lot_Id = receipt_list_product.Lot_Id AND sub_lot.Prod_Id = receipt_list_product.Prod_Id)
        JOIN receipt_list ON (receipt_list.Receipt_Id = receipt_list_product.Receipt_Id AND receipt_list.Receipt_No = receipt_list_product.Receipt_No)
        JOIN receipt ON receipt.Receipt_Id = receipt_list.Receipt_Id
        WHERE receipt.Receipt_Date BETWEEN '$dates' AND '$daten'
        ) as profits ON profits.Prod_Id = product.Prod_Id
        GROUP BY product.Prod_Id";

        return $this->db->query($query)->result();
    }

    function reportpledgeprofit($dates,$daten)
    {
        $query = "SELECT pledge_stock.ProdPL_Id,pledge_stock.ProdPL_Name,pledge_stock.ProdPL_Cost,receipt_list.Receipt_Amount,receipt_list.Receipt_Price_Total,
        pledge_stock.ProdPL_Status,receipt.Receipt_Id,
        (receipt_list.Receipt_Price_Total - pledge_stock.ProdPL_Cost) as profit
        FROM pledge_stock
        JOIN receipt_list_pledge ON (pledge_stock.ProdPL_Id = receipt_list_pledge.ProdPL_Id)
        JOIN receipt_list ON (receipt_list.Receipt_Id = receipt_list_pledge.Receipt_Id AND receipt_list.Receipt_No = receipt_list_pledge.Receipt_No)
        JOIN receipt ON receipt.Receipt_Id = receipt_list.Receipt_Id
        WHERE pledge_stock.ProdPL_Status = 0 AND receipt.Receipt_Date BETWEEN '$dates' AND '$daten'";

        return $this->db->query($query)->result();
    }

}
