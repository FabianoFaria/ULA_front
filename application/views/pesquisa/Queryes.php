city varchar(50)

state varchar(2)

city_adicional

city_adicional2

state_adicional

state_adicional2



 if($conteudoPassado['veiculos'][$i]->state_adicional != ''){
                                  foreach ($estados as $estado): {
                                    // $arrayE[] = $estado->nome;
                                    if($estado->id_estado == $conteudoPassado['veiculos'][$i]->state_adicional)
                                    { 
                                      $procedenciaEstAdd = " ".$estado->uf;
                                    }
                                  }
                              }else{
                                $procedenciaEstAdd = " ";
                              }

                              if($conteudoPassado['veiculos'][$i]->city_adicional != ''){
                                  foreach ($cidades as $cidade): {
                                    // $arrayE[] = $estado->nome;
                                    if($cidade->id == $conteudoPassado['veiculos'][$i]->city_adicional)
                                    { 
                                      $procedenciaCityAdd = " de ".$cidade->nome;
                                    }
                                  }
                              }else{
                                $procedenciaCityAdd = " ";
                              }


SELECT * FROM `tbl_main` WHERE CHILD_ID = 628 and CHILD_TBL = 'tbl_addr' 

SELECT * FROM `tbl_main` WHERE parent_id = 412 

SELECT * FROM tbl_addr 
JOIN tbl_main ON tbl_main.CHILD_ID = tbl_addr.ID_addr
JOIN tbl_doct ON tbl_doct.ROW_ID = tbl_main.parent_id
WHERE tbl_doct.ROW_ID = 412 and tbl_main.CHILD_TBL = 'tbl_addr'


SELECT * 
FROM tbl_addr 
JOIN tbl_main ON tbl_main.CHILD_ID = tbl_addr.ID_addr 
JOIN tbl_doct ON tbl_doct.ROW_ID = tbl_main.parent_id 
WHERE tbl_doct.ROW_ID = 412 
and tbl_main.CHILD_TBL = 'tbl_addr' 

SELECT * 
FROM tbl_addr 
/* JOIN tbl_main ON tbl_main.CHILD_ID = tbl_addr.ID_addr */
JOIN tbl_doct ON tbl_doct.ROW_ID = tbl_main.parent_id 
WHERE tbl_doct.ROW_ID = 412 
and tbl_main.CHILD_TBL = 'tbl_addr'



SELECT * 
FROM tbl_addr 
JOIN tbl_wrs_addr ON tbl_wrs_addr.id_addr = tbl_addr.ID_addr 
JOIN tbl_wrs ON tbl_wrs.ID_wrs = tbl_wrs_addr.id_wrs 
JOIN tbl_main ON tbl_main.CHILD_id = tbl_wrs.ID_wrs
WHERE tbl_main.CHILD_TBL = 'tbl_wrs'
AND tbl_main.parent_id = ?
AND tbl_wrs.deletado = 0






 //$this->db->join('tbl_main', 'tbl_main.parent_id = tbl_addr.ROW_ID');
 $this->db->join('tbl_wrs_addr', 'tbl_wrs_addr.id_addr = tbl_addr.ID_addr');
        $this->db->join('tbl_wrs','tbl_wrs.ID_wrs = tbl_wrs_addr.id_wrs');
        $this->db->where('tbl_wrs.deletado', 0);
        
        $this->db->join('tbl_main','tbl_main.CHILD_ID = tbl_wrs.ID_wrs');
        $this->db->where('tbl_main.parent_id', $idRow);
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_wrs');
        //$this->db->where('tbl_addr.ROW_ID', $idRow);
        $queryDoct = $this->db->get('tbl_addr');
        return $queryDoct->result();


__________________________________________________________________________
        $this->db->where('tbl_wrs.deletado', 0);
        
        $this->db->join('tbl_main','tbl_main.CHILD_ID = tbl_wrs.ID_wrs');
        $this->db->where('tbl_main.parent_id', $idRow);
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_wrs');
        //$this->db->where('tbl_addr.ROW_ID', $idRow);
        $queryDoct = $this->db->get('tbl_addr');
        return $queryDoct->result();



        SELECT count(tbl_vehicle.ID_vehicle) as totalVei 
FROM tbl_doct 
JOIN tbl_main ON tbl_doct.ROW_ID = tbl_main.parent_id
JOIN tbl_vehicle ON tbl_vehicle.ID_vehicle = tbl_main.CHILD_ID
WHERE tbl_main.CHILD_TBL = 'tbl_vehicle'
AND MONTH(tbl_doct.arrest_date) = 1
AND YEAR(tbl_doct.arrest_date) = 2015
AND tbl_doct.status_doct = 0



SELECT count(tbl_wrs.ID_wrs) as totalwrs
FROM tbl_doct
JOIN tbl_main ON tbl_doct.ROW_ID = tbl_main.parent_id
JOIN tbl_wrs ON tbl_wrs.ID_wrs = tbl_main.CHILD_ID
WHERE tbl_main.CHILD_TBL = 'tbl_wrs'
AND MONTH(tbl_doct.arrest_date) = 1
AND YEAR(tbl_doct.arrest_date) = 2015
AND tbl_doct.status_doct = 0


/* Presos que estão cadastrados */

 SELECT count(tbl_contact.ID_contact) as totalPreso 
 FROM tbl_doct 
 JOIN tbl_main ON tbl_doct.ROW_ID = tbl_main.parent_id
 JOIN tbl_contact ON tbl_contact.ID_contact = tbl_main.CHILD_ID
 WHERE tbl_main.CHILD_TBL = 'tbl_contact'
 AND MONTH(tbl_doct.arrest_date) = 1
 AND YEAR(tbl_doct.arrest_date) = 2015
 AND tbl_doct.status_doct = 0


SELECT COUNT(tbl_contact.ID_contact) as totalPreso
FROM tbl_doct 
JOIN tbl_main ON tbl_doct.ROW_ID = tbl_main.parent_id
JOIN tbl_contact ON tbl_contact.ID_contact = tbl_main.CHILD_ID
WHERE tbl_main.CHILD_TBL = 'tbl_contact'
AND tbl_doct.total_arrest = 0
AND MONTH(tbl_doct.arrest_date) = 3
AND YEAR(tbl_doct.arrest_date) = 2015
AND tbl_doct.status_doct = 0


SELECT COUNT(tbl_contact.ID_contact) as totalPreso 
FROM tbl_doct 
JOIN tbl_main ON tbl_doct.ROW_ID = tbl_main.parent_id 
JOIN tbl_contact ON tbl_contact.ID_contact = tbl_main.CHILD_ID 
WHERE tbl_main.CHILD_TBL = 'tbl_contact' 
AND MONTH(tbl_doct.arrest_date) = 3 
AND YEAR(tbl_doct.arrest_date) = 2015 
AND tbl_doct.status_doct = 0 

SELECT COUNT(tbl_contact.ID_contact) as totalPreso 
FROM tbl_doct 
JOIN tbl_main ON tbl_doct.ROW_ID = tbl_main.parent_id 
JOIN tbl_contact ON tbl_contact.ID_contact = tbl_main.CHILD_ID 
WHERE tbl_main.CHILD_TBL = 'tbl_contact' 
AND MONTH(tbl_doct.arrest_date) = 3 
AND YEAR(tbl_doct.arrest_date) = 2015 
AND tbl_doct.status_doct = 0 

SELECT SUM(tbl_doct.total_arrest) 
FROM tbl_doct 
WHERE MONTH(tbl_doct.arrest_date) = 3 
AND YEAR(tbl_doct.arrest_date) = 2015 
AND tbl_doct.status_doct = 0 


///Seleciona os presos onde há cadastro no campo

SELECT COUNT(tbl_contact.ID_contact) as totalPreso
FROM tbl_doct 
JOIN tbl_main ON tbl_doct.ROW_ID = tbl_main.parent_id
JOIN tbl_contact ON tbl_contact.ID_contact = tbl_main.CHILD_ID
WHERE tbl_main.CHILD_TBL = 'tbl_contact'
AND tbl_doct.total_arrest != 0
AND MONTH(tbl_doct.arrest_date) = 3
AND YEAR(tbl_doct.arrest_date) = 2015
AND tbl_doct.status_doct = 0

///Seleciona os presos normalmente 

SELECT COUNT(tbl_contact.ID_contact) as totalPreso
FROM tbl_doct 
JOIN tbl_main ON tbl_doct.ROW_ID = tbl_main.parent_id
JOIN tbl_contact ON tbl_contact.ID_contact = tbl_main.CHILD_ID
WHERE tbl_main.CHILD_TBL = 'tbl_contact'
AND tbl_doct.total_arrest = 0
AND MONTH(tbl_doct.arrest_date) = 3
AND YEAR(tbl_doct.arrest_date) = 2015
AND tbl_doct.status_doct = 0