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

    function inserttype($typeid,$typename)
    {
        $query = "INSERT INTO protype (Prot_Id,Prot_Name)
                  VALUES
                    ('$typeid','$typename')";

        return $this->db->query($query);  
    }

    function displaytype($Prot_Id)
    {
        $query = "SELECT Prot_Id,Prot_Name FROM protype WHERE Prot_Id = '$Prot_Id'";
        return $this->db->query($query)->result();
    }

    function updatetype($typeid,$typename)
    {
        $query = "UPDATE protype SET Prot_Name = '$typename' WHERE Prot_Id = '$typeid'";

        return $this->db->query($query);
    }

    function deletetype()
    {
        $query = "";
        
        return $this->db->query($query);

    }

    function protype()
    {
        $query = "SELECT Prot_Id,Prot_Name FROM protype WHERE Prot_Name not like '%แหวน%'";
        return $this->db->query($query)->result();
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
        $query = "SELECT Prot_Id,Prot_Name FROM protype WHERE Prot_Name like '%แหวน%'";
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

    
}


?>