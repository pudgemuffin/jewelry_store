<?php

class ergold extends CI_Model
{
    function allprotype($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By Prot_Id )as row ,Prot_Id,Prot_Name
        FROM protype 
        WHERE Prot_Id like '%%' $search
               )AA
               where row > $start AND row <=$pageend order by row";
        
        return $this->db->query($query)->result();
    }

    function count_protype( $search)
    {
        $query = "SELECT COUNT(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By Prot_Id )as row ,Prot_Id,Prot_Name
        FROM protype
        WHERE Prot_Id like '%%' $search )AA";

        return $this->db->query($query)->result();
        
    }

    function allproduct($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By p.Prod_Id )as row ,p.Prod_Id,p.Prod_Name,p.Prod_Gram,p.Fee,p.Prod_Img,t.Prot_Name as Type,w.Weight_Name as Weight
        FROM product p
            INNER JOIN protype t on p.Prod_Type = t.Prot_Id
			INNER JOIN weight w on p.Prod_Weight = w.Weight_Id
            WHERE p.Prod_Id like '%%' $search
            )AA
            where row > $start AND row <=$pageend order by row";
        
        return $this->db->query($query)->result();
    }

    function count_product( $search)
    {
        $query = "SELECT COUNT(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By p.Prod_Id )as row ,p.Prod_Id,p.Prod_Name,p.Prod_Gram,p.Fee,p.Prod_Img,t.Prot_Name as Type,w.Weight_Name as Weight
        FROM product p
            INNER JOIN protype t on p.Prod_Type = t.Prot_Id
			INNER JOIN weight w on p.Prod_Weight = w.Weight_Id
            WHERE p.Prod_Id like '%%' $search
            )AA";

        return $this->db->query($query)->result();
        
    }

    function maxtypeid()
    {
        $query = "SELECT max(Prot_Id) as Id FROM protype";
        $result = $this->db->query($query)->result();
        foreach($result as $r){
            return $r->Id;
        }
    }

    function maxprodid()
    {
        $query = "SELECT max(Prod_Id) as Id FROM product";
        $result = $this->db->query($query)->result();
        foreach($result as $r){
            return $r->Id;
        }
    }

    function checkinsert($typename)
    {
        $query = "SELECT COUNT(*) as COUNT
            from protype WHERE Prot_Name = '$typename'";

        return $this->db->query($query)->result();
    }

    function inserttype($typeid,$typename,$cat)
    {
        $query = "INSERT INTO protype (Prot_Id,Prot_Name,Category)
                  VALUES
                    ('$typeid','$typename','$cat')";

        return $this->db->query($query);  
    }

    function displaytype($Prot_Id)
    {
        $query = "SELECT Prot_Id,Prot_Name,Category FROM protype WHERE Prot_Id = '$Prot_Id'";
        return $this->db->query($query)->result();
    }

    function updatetype($typeid,$typename,$cat)
    {
        $query = "UPDATE protype SET Prot_Name = '$typename',Category = '$cat' WHERE Prot_Id = '$typeid'";

        return $this->db->query($query);
    }

    function deletetype($protid)
    {
        $query = "DELETE FROM protype WHERE Prot_Id = '$protid'";
        
        return $this->db->query($query);

    }

    function weight()
    {
        $query = "SELECT Weight_Id,Weight_Name,Weight_Grams FROM weight";
        return $this->db->query($query)->result();
    }

    function grams($prodweight)
    {
        $query = "SELECT Weight_Grams FROM weight WHERE Weight_Id like'%%' $prodweight";
        return $this->db->query($query)->result();
    }

    function checkinsertprod($prodname)
    {
        $query = "SELECT count(*) as COUNT
            from product where Prod_Name = '$prodname'";
        return $this->db->query($query)->result();
    }

    function prodbyid($prodid)
    {
        $query = "SELECT * from product where Prod_Id = '$prodid'";
        return $this->db->query($query)->result();
    }
    function ringbyid($prodid)
    {
        $query = "SELECT r.Prod_Id,r.Size as size,p.Prod_Name,p.Prod_Type as Type,p.Prod_Weight,p.Prod_Gram,p.Fee,Prod_Img from rings r 
        INNER JOIN product p on p.Prod_Id = r.Prod_Id
        Where r.Prod_Id = '$prodid'";
        return $this->db->query($query)->result();
    }

    function ring()
    {
        $query = "SELECT Prot_Id,Prot_Name FROM protype WHERE Category = '1'";
        return $this->db->query($query)->result();
    }

    function protype()
    {
        $query = "SELECT Prot_Id,Prot_Name FROM protype WHERE Category = '0'";
        return $this->db->query($query)->result();
    }

    function checkprodring($prodid)
    {
        $query = "SELECT count(*) as COUNT
            from rings where Prod_Id = '$prodid'";
        return $this->db->query($query)->result();
    }

    function size()
    {
        $query = "SELECT Id,Size FROM size";
        return $this->db->query($query)->result();
    }

    function insertprod($prodid,$prodtype,$prodname,$prodweight,$prodgram,$fee,$filename)
    {
        $query = "INSERT INTO product (Prod_Id,Prod_Type,Prod_Name,Prod_Weight,Prod_Gram,Fee,Prod_Img)
                    values
                    ('$prodid','$prodtype','$prodname','$prodweight','$prodgram','$fee','$filename')";
        return $this->db->query($query); 
    }

    function insertring($prodid,$size)
    {
        $query = "INSERT INTO rings (Prod_Id,Size)
                    values
                    ('$prodid','$size')";

        return $this->db->query($query);
    }

    function updatepronoimg($prodid,$prodtype,$prodname,$prodweight,$prodgram,$fee)
    {
        $query = "UPDATE product SET  Prod_Type = '$prodtype', Prod_Name = '$prodname', Prod_Weight = '$prodweight'
                  ,Prod_Gram = '$prodgram', Fee = '$fee' WHERE Prod_Id = '$prodid' ";
        return $this->db->query($query);
    }
    function updatepro($prodid,$prodtype,$prodname,$prodweight,$prodgram,$fee,$filename)
    {
        $query = "UPDATE product SET  Prod_Type = '$prodtype', Prod_Name = '$prodname', Prod_Weight = '$prodweight'
                  ,Prod_Gram = '$prodgram', Fee = '$fee',Prod_Img = '$filename' WHERE Prod_Id = '$prodid' ";
        return $this->db->query($query);
    }
    function ringdel($prodid)
    {
        $query = "DELETE FROM rings WHERE Prod_Id = '$prodid'";
        return $this->db->query($query);
    }
    function updatering($prodid,$size)
    {
        $query = "UPDATE rings SET Size = '$size' WHERE Prod_Id = '$prodid'";
        return $this->db->query($query);
    }
    function product()
    {
        $query = "SELECT Prod_Id,Prod_Name FROM product";

        return $this->db->query($query)->result();
    }

    function productcostbyid($partid)
    {
        $query = "SELECT p.Prod_Id,p.Prod_Name,c.Cost_Price as Price FROM product p
                    INNER JOIN cost c ON p.Prod_Id = c.Prod_Id
                    WHERE c.Part_Id = '$partid'";

        return $this->db->query($query)->result();
    }

    function maxpromid()
    {
        $query = "SELECT max(Promotion_Id) as PromId FROM promotion";
        $result = $this->db->query($query)->result();
        foreach ($result as $re) {
            return $re->PromId;
        }
    }

    function checksubpro($PromId,$prodid)
    {
        $query = "SELECT COUNT(*) as Count from sub_promotion where Prom_Id = '$PromId' and Prod_Id = '$prodid'";

        $result =  $this->db->query($query)->result();
       
        foreach($result as $re){
            return $re->Count;
        }
    }

    function insertsubpro($PromId,$pd)
    {
        $query = "INSERT INTO sub_promotion(Prom_Id,Prod_Id)
                    values
                    ('$PromId','$pd')";
        return $this->db->query($query);
    }

    function addpromotion($pmid,$pmname,$sdate,$edate,$discount)
    {
        $query = "INSERT INTO promotion(Promotion_Id,Prom_Name,Prom_Sdate,Prom_Ndate,Prom_Discount)
                    values
                    ('$pmid','$pmname','$sdate','$edate','$discount')";

        return $this->db->query($query);
    }
    function updatepromotion($pmid,$pmname,$sdate,$edate,$discount)
    {
        $query = "UPDATE promotion SET Prom_Name = '$pmname',Prom_Sdate = '$sdate',Prom_Ndate = '$edate',Prom_Discount = '$discount'
                    WHERE Promotion_Id = '$pmid'";
        return $this->db->query($query);
            
    }
    function prombyid($promid)
    {
        $query = "SELECT * from promotion where Promotion_Id = '$promid'";
        return $this->db->query($query)->result();
    }

    function subprombyid($promid)
    {
        $query = "SELECT Prod_Id from sub_promotion where Prom_Id = '$promid'";
        return $this->db->query($query)->result();
    }
    function subprodel($promid)
    {
        $query = "DELETE FROM sub_promotion WHERE Prom_Id = '$promid'";
        return $this->db->query($query);
    }

    function allpromotion($start,$pageend,$search)
    {
        $query = "SELECT * from( SELECT ROW_NUMBER()OVER ( ORDER By Promotion_Id )as row ,Promotion_Id,Prom_Name,Prom_Sdate,Prom_Ndate,Prom_Discount
                FROM promotion 
                WHERE Promotion_Id like '%%' $search
               )AA
               where row > $start AND row <=$pageend order by row";

        return $this->db->query($query)->result();
    }

    function count_promotion($search)
    {
        $query = "SELECT COUNT(*) as Count from( SELECT ROW_NUMBER()OVER ( ORDER By Promotion_Id )as row ,Promotion_Id,Prom_Name,Prom_Sdate,Prom_Ndate,Prom_Discount
        FROM promotion 
        WHERE Promotion_Id like '%%' $search
       )AA";

        return $this->db->query($query)->result();
        
    }
    
    function deletepromo($pmid)
    {
        $query = "DELETE FROM promotion WHERE Promotion_Id = '$pmid'";

        return $this->db->query($query);
    }
}


?>